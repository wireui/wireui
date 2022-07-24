import { parseConfirmation, parseDialog } from "../dialog/parses";
import { Style } from "../dialog/options";
import { Dialog, DialogOptions } from "../dialog";
import { timer } from "../notifications/timer";
import { Icon } from "../dialog/icons";
import { Action, ButtonOptions } from "../dialog/actions";

export interface InitOptions {
  id: string;
}

export interface Options extends DialogOptions {
  accept?: Action;
  reject?: Action;
}

export interface ParsedDialog extends Dialog {
  accept?: Action;
  reject?: Action;
}

export interface ParseOptions {
  options: Options;
  componentId: string;
}

export interface DialogComponent {
  [index: string]: any;

  show: boolean;
  style: Style | null;
  dialog: ParsedDialog | null;

  init(): void;
  dismiss(): void;
  close(): void;
  open(): void;
  processDialog(options: ParsedDialog): void;
  showDialog(data: ParseOptions): void;
  confirmDialog(data: ParseOptions): void;
  fillIconBackground(icon: Icon | null): void;
  fillDialogIcon(icon: Icon | null): void;
  createButton(options: ButtonOptions, action: string): void;
  parseHtmlString(html: string): Element | null;
  startCloseTimeout(): void;
  accept(): void;
  reject(): void;
  handleEscape(): void;
  pauseTimeout(): void;
  resumeTimeout(): void;
}

export default (options: InitOptions): DialogComponent => ({
  show: false,
  style: null,
  dialog: null,

  init() {
    this.$nextTick(() => {
      window.Wireui.dispatchHook(`${options.id}:load`);
    });
  },
  dismiss() {
    this.close();
    this.dialog?.onDismiss();
  },
  close() {
    this.show = false;
    this.dialog?.timer?.pause();
    this.dialog?.onClose();
  },
  open() {
    this.show = true;
  },
  processDialog(options) {
    this.dialog = options;
    this.style = options.style;

    if (this.$refs.title) {
      this.$refs.title.innerHTML = null;
    }
    if (this.$refs.description) {
      this.$refs.description.innerHTML = null;
    }

    if (options.icon) {
      this.fillIconBackground(options.icon);
      this.fillDialogIcon(options.icon);
    }

    if (options.accept) {
      this.createButton(options.accept, "accept");
    }

    if (options.reject) {
      this.createButton(options.reject, "reject");
    }

    if (options.close) {
      this.createButton(options.close, "close");
    }

    if (options.title) {
      this.$refs.title.innerHTML = options.title;
    }

    if (options.description) {
      this.$refs.description.innerHTML = options.description;
    }

    this.$nextTick(() => this.open());

    if (this.dialog?.timeout) {
      this.startCloseTimeout();
    }
  },
  showDialog({ options, componentId }) {
    this.processDialog(parseDialog(options, componentId));
  },
  confirmDialog({ options, componentId }) {
    this.processDialog(parseConfirmation(options, componentId));
  },
  fillIconBackground(icon) {
    this.$refs.iconContainer.className = icon?.background ?? "";
  },
  fillDialogIcon(icon) {
    if (!icon?.name) return;

    const classes = ["w-10", "h-10"];

    if (icon?.color) {
      classes.push(...icon.color.split(" "));
    }

    if (this.style === "inline") {
      classes.push("sm:w-6", "sm:h-6");
    }

    fetch(
      `${window.$wireui.config.basePath}/wireui/icons/${
        icon.style ?? "outline"
      }/${icon.name}`,
      {
        headers: {
          Accept: "application/json",
        },
      }
    )
      .then((response) => response.text())
      .then((text) => {
        const svg = new DOMParser().parseFromString(
          text,
          "image/svg+xml"
        ).documentElement;
        svg.classList.add(...classes);
        this.$refs.iconContainer.replaceChildren(svg);
      });
  },
  createButton(options, action) {
    const params = new URLSearchParams(options as string);

    params.delete("execute");

    fetch(`${window.$wireui.config.basePath}/wireui/button?${params}`, {
      headers: {
        Accept: "application/json",
      },
    })
      .then((response) => response.text())
      .then((html) => {
        const button = this.parseHtmlString(html);

        if (!button) return;

        button.setAttribute("x-on:click", action);
        button.classList.add(
          "w-full",
          "dark:border-0",
          "dark:hover:bg-secondary-700"
        );

        this.$refs[action].replaceChildren(button);
      });
  },
  parseHtmlString(html) {
    const div = document.createElement("div");
    div.innerHTML = html;

    return div.firstElementChild;
  },
  startCloseTimeout() {
    if (!this.dialog) return;

    this.dialog.timer = timer(
      this.dialog?.timeout ?? 0,
      () => {
        this.close();
        this.dialog?.onTimeout();
      },
      (percentage) => {
        this.$refs.progressbar.style.width = `${percentage}%`;
      }
    );
  },
  accept() {
    this.close();
    this.dialog?.accept?.execute();
  },
  reject() {
    this.close();
    this.dialog?.reject?.execute();
  },
  handleEscape() {
    if (this.show) this.dismiss();
  },
  pauseTimeout() {
    this.dialog?.timer?.pause();
  },
  resumeTimeout() {
    this.dialog?.timer?.resume();
  },
});
