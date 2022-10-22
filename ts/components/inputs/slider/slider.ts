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
  stops: object[];
  sliderSize: number;
  range: boolean;
  disabled: boolean;
  showStops: boolean;
  hideTooltip: boolean;

  get barStart(): string;
  get barSize(): string;
  get barStyle(): object;
  get precision(): number;
  init(): void;
  stopStyle(stop: any): object;
  initStops(): void;
  resetSize(): void;
  inputChange(): void;
  emitChange(input: string, value: number): void;
  setPosition(position: number): void;
  sliderClick(event: any): void;
}

export default (params): InputRange => ({
  $refs: {} as Refs,
  min: 0,
  max: 100,
  step: 1,
  value: null,
  stops: [],
  sliderSize: 1,
  range: params.range,
  disabled: params.disabled,
  showStops: params.showStops,
  hideTooltip: params.hideTooltip,

  get barStart () {
    return '0%'
  },
  get barSize () {
    const value = Number(this.value)
    const showValue = value < this.min ? this.min : value > this.max ? this.max : value

    return `${(showValue - this.min) / (this.max - this.min) * 100}%`
  },
  get barStyle () {
    return { width: this.barSize, left: this.barStart }
  },
  get precision () {
    const precisions = [this.min, this.max, this.step].map((item) => {
      const decimal = `${  item}`.split('.')[1]

      return decimal ? decimal.length : 0
    })

    return Math.max.apply(null, precisions)
  },
  init () {
    const value = this.$refs.input.value

    this.min = Number(this.$refs.input.min)

    this.max = Number(this.$refs.input.max)

    this.step = Number(this.$refs.input.step)

    this.value = Number(value ? value : this.min)

    if (this.showStops) this.initStops()
  },
  stopStyle (stop) {
    const stepWidth = 100 * (stop.value - this.min) / (this.max - this.min)

    return stop.value <= Number(this.value)
      ? { left: `${stepWidth}%`, display: 'none' }
      : { left: `${stepWidth}%` }
  },
  initStops () {
    for (let i = this.min + this.step; i < this.max; i += this.step) {
      this.stops.push({ value: i })
    }
  },
  resetSize () {
    if (this.$refs.slider) {
      this.sliderSize = this.$refs.slider['clientWidth']
    }
  },
  inputChange () {
    if (this.disabled) return

    this.value = Number(this.$refs.input.value)

    window.Alpine.evaluate(this.$refs['button'].firstElementChild, `setValue = ${this.value}`)
  },
  emitChange (input, value) {
    if (this.disabled) return

    if (isNaN(value) || value === null) return

    this.value = value

    this.$refs[input].value = this.value.toString()

    this.$refs[input].dispatchEvent(new Event('input'))
  },
  setPosition (newPosition) {
    window.Alpine.evaluate(this.$refs['button'].firstElementChild, `setPosition('${newPosition}')`)
  },
  sliderClick (event) {
    if (this.disabled) return

    this.resetSize()

    const sliderOffsetLeft = this.$refs.slider.getBoundingClientRect().left

    const newPosition = (event.clientX - sliderOffsetLeft) / this.sliderSize * 100

    this.setPosition(newPosition)
  }
})
