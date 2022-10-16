export type Refs = {
  slider: HTMLDivElement;
  tooltip: HTMLDivElement;
  input1: HTMLInputElement;
  input2: HTMLInputElement;
  button1: HTMLButtonElement;
  button2: HTMLButtonElement;
};

export interface InputRange {
  $refs: Refs;
  min: number;
  max: number;
  step: number;
  stops: object[];
  firstValue: number | null;
  secondValue: number | null;
  sliderSize: number;
  range: boolean;
  disabled: boolean;
  showStops: boolean;
  hideTooltip: boolean;

  get minValue(): number;
  get maxValue(): number;
  get barStart(): string;
  get barSize(): string;
  get barStyle(): object;
  get precision(): number;
  init(): void;
  stopStyle(stop: any): object;
  initStops(): void;
  resetSize(): void;
  inputChange(event: any): void;
  setDataValueOrder(): void;
  setMinValue(value: number): void;
  setMaxValue(value: number): void;
  emitChange(input: string, value: number): void;
  setPosition(position: number): void;
  sliderClick(event: any): void;
}

export default (params): InputRange => ({
  $refs: {} as Refs,
  min: 0,
  max: 100,
  step: 1,
  stops: [],
  firstValue: null,
  secondValue: null,
  sliderSize: 1,
  range: params.range,
  disabled: params.disabled,
  showStops: params.showStops,
  hideTooltip: params.hideTooltip,

  get minValue () {
    return Math.min(Number(this.firstValue), Number(this.secondValue))
  },
  get maxValue () {
    return Math.max(Number(this.firstValue), Number(this.secondValue))
  },
  get barStart () {
    const minValue = this.minValue < this.min ? this.min : this.minValue

    return `${ 100 * (minValue - this.min) / (this.max - this.min) }%`
  },
  get barSize () {
    const minValue = this.minValue < this.min ? this.min : this.minValue
    const maxValue = this.maxValue > this.max ? this.max : this.maxValue

    return `${ 100 * (maxValue - minValue) / (this.max - this.min) }%`
  },
  get barStyle () {
    return { width: this.barSize, left: this.barStart }
  },
  get precision () {
    const precisions = [this.min, this.max, this.step].map((item) => {
      const decimal = ('' + item).split('.')[1]

      return decimal ? decimal.length : 0
    })

    return Math.max.apply(null, precisions)
  },
  init () {
    const firstValue = this.$refs.input1.value;

    const secondValue = this.$refs.input2.value;

    this.min = Number(this.$refs.input1.min)

    this.max = Number(this.$refs.input1.max)

    this.step = Number(this.$refs.input1.step)

    this.firstValue = Number(firstValue ? firstValue : this.min)

    this.secondValue = Number(secondValue ? secondValue : this.min)

    if (this.showStops) this.initStops()

    this.setDataValueOrder()
  },
  stopStyle(stop){
    const stepWidth = 100 * (stop.value - this.min) / (this.max - this.min);

    return stop.value >= Number(this.minValue) && stop.value <= Number(this.maxValue)
      ? { left: `${stepWidth}%`, display: 'none' }
      : { left: `${stepWidth}%` }
  },
  initStops(){
    for (let i = this.min + this.step; i < this.max; i += this.step) {
      this.stops.push({ value: i })
    }
  },
  resetSize () {
    if (this.$refs.slider) {
      this.sliderSize = this.$refs.slider['clientWidth']
    }
  },
  inputChange (event) {
    if (this.disabled) return

    const input = event.target.getAttribute('x-ref')

    if (input === 'input1') {
      this.firstValue = Number(this.$refs[input].value)
    }

    if (input === 'input2') {
      this.secondValue = Number(this.$refs[input].value)
    }

    this.setDataValueOrder()
  },
  setDataValueOrder () {
    const min = this.minValue
    const max = this.maxValue

    this.setMinValue(min)
    this.setMaxValue(max)

    window.Alpine.evaluate(this.$refs['button1'].firstElementChild, `setValue = ${this.firstValue}`)
    window.Alpine.evaluate(this.$refs['button2'].firstElementChild, `setValue = ${this.secondValue}`)
  },
  setMinValue (value) {
    this.firstValue = value

    this.$refs.input1.value = this.firstValue.toString()

    this.$refs.input1.dispatchEvent(new Event('input'))
  },
  setMaxValue (value) {
    this.secondValue = value

    this.$refs.input2.value = this.secondValue.toString()

    this.$refs.input2.dispatchEvent(new Event('input'))
  },
  emitChange (input, value) {
    if (this.disabled) return

    if (isNaN(value) || value === null) return

    if (input === 'input1') {
      this.setMinValue(value)
    }

    if (input === 'input2') {
      this.setMaxValue(value)
    }
  },
  setPosition (newPosition) {
    var button

    const targetValue = this.min + newPosition * (this.max - this.min) / 100

    if (Math.abs(this.minValue - targetValue) < Math.abs(this.maxValue - targetValue)) {
      button = Number(this.firstValue) < Number(this.secondValue) ? 'button1' : 'button2'
    } else {
      button = Number(this.firstValue) > Number(this.secondValue) ? 'button1' : 'button2'
    }

    window.Alpine.evaluate(this.$refs[button].firstElementChild, `setPosition('${newPosition}')`)
  },
  sliderClick (event) {
    if (this.disabled) return

    this.resetSize()

    const sliderOffsetLeft = this.$refs.slider.getBoundingClientRect().left

    const newPosition = (event.clientX - sliderOffsetLeft) / this.sliderSize * 100

    this.setPosition(newPosition)
  }
})
