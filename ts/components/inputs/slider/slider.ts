export type Refs = {
  slider: HTMLDivElement;
  tooltip: HTMLDivElement;
  input: HTMLInputElement;
  button: HTMLButtonElement;
};

export interface InputRange {
  $refs: Refs;
  min: number;
  max: number;
  step: number;
  value: number | null;
  sliderSize: number;
  range: boolean;
  disabled: boolean;
  hideTooltip: boolean;

  get barStart(): string;
  get barSize(): string;
  get barStyle(): object;
  get precision(): number;
  init(): void;
  resetSize(): void;
  inputChange(): void;
  emitChange(input: string, value: number): void;
  setPosition(position: number): void;
  sliderClick(event: any): void;
}

export default (params): InputRange => ({
  $refs: {} as Refs,
  min: 1,
  max: 100,
  step: 1,
  value: null,
  sliderSize: 1,
  range: params.range,
  disabled: params.disabled,
  hideTooltip: params.hideTooltip,

  get barStart() {
    return "0%";
  },
  get barSize() {
    return `${((this.value ?? this.min - this.min) / (this.max - this.min)) * 100}%`;
  },
  get barStyle() {
    return { width: this.barSize, left: this.barStart };
  },
  get precision() {
    let precisions = [this.min, this.max, this.step].map((item) => {
      let decimal = ("" + item).split(".")[1];
      return decimal ? decimal.length : 0;
    });

    return Math.max.apply(null, precisions);
  },
  init() {
    this.min = Number(this.$refs.input.min);

    this.max = Number(this.$refs.input.max);

    this.step = Number(this.$refs.input.step);

    this.value = Number(this.$refs.input.value);
  },
  resetSize() {
    if (this.$refs.slider) {
      this.sliderSize = this.$refs.slider["clientWidth"];
    }
  },
  inputChange() {
    if (this.disabled) return;

    this.value = Number(this.$refs.input.value);

    window.Alpine.evaluate(this.$refs['button'].firstElementChild, `setValue = ${this.value}`);
  },
  emitChange(input, value) {
    if (this.disabled) return;

    if (isNaN(value) || value === null) return;

    this.value = value;

    this.$refs[input].value = this.value.toString();

    this.$refs[input].dispatchEvent(new Event("input"));
  },
  setPosition(newPosition) {
    window.Alpine.evaluate(this.$refs['button'].firstElementChild, `setPosition('${newPosition}')`);
  },
  sliderClick(event) {
    if (this.disabled) return;

    this.resetSize();

    const sliderOffsetLeft = this.$refs.slider.getBoundingClientRect().left;

    const newPosition = ((event.clientX - sliderOffsetLeft) / this.sliderSize) * 100;

    this.setPosition(newPosition);
  }
});
