import { parseConfirmation, parseDialog } from '../dialog/parses';
import { timer } from '../notifications/timer';
export default (options) => ({
    show: false,
    style: null,
    dialog: null,
    init() {
        window.Wireui.dispatchHook(`${options.id}:load`);
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
            this.createButton(options.accept, 'accept');
        }
        if (options.reject) {
            this.createButton(options.reject, 'reject');
        }
        if (options.close) {
            this.createButton(options.close, 'close');
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
        this.$refs.iconContainer.className = icon?.background ?? '';
    },
    fillDialogIcon(icon) {
        if (!icon?.name)
            return;
        const classes = ['w-10', 'h-10'];
        if (icon?.color) {
            classes.push(...icon.color.split(' '));
        }
        if (this.style === 'inline') {
            classes.push('sm:w-6', 'sm:h-6');
        }
        fetch(`/wireui/icons/${icon.style ?? 'outline'}/${icon.name}`)
            .then(response => response.text())
            .then(text => {
            const svg = new DOMParser().parseFromString(text, 'image/svg+xml').documentElement;
            svg.classList.add(...classes);
            this.$refs.iconContainer.replaceChildren(svg);
        });
    },
    createButton(options, action) {
        fetch(`/wireui/button?${new URLSearchParams(options)}`)
            .then(response => response.text())
            .then(html => {
            const button = this.parseHtmlString(html);
            if (!button)
                return;
            button.setAttribute('x-on:click', action);
            button.classList.add('w-full', 'dark:border-0', 'dark:hover:bg-secondary-700');
            this.$refs[action].replaceChildren(button);
        });
    },
    parseHtmlString(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        return div.firstElementChild;
    },
    startCloseTimeout() {
        if (!this.dialog)
            return;
        this.dialog.timer = timer(this.dialog?.timeout ?? 0, () => {
            this.close();
            this.dialog?.onTimeout();
        }, (percentage) => {
            this.$refs.progressbar.style.width = `${percentage}%`;
        });
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
        if (this.show)
            this.dismiss();
    },
    pauseTimeout() { this.dialog?.timer?.pause(); },
    resumeTimeout() { this.dialog?.timer?.resume(); }
});
//# sourceMappingURL=dialog.js.map