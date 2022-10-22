// eslint-disable-next-line import/named
import tippy, { Instance } from 'tippy.js'

export type Refs = {
  input: HTMLInputElement;
  sliderComponent: HTMLDivElement;
};

export interface InputRange {
  $refs: Refs;
  input: string;
  button: string;
  value: number | null;
  hovering: boolean;
  dragging: boolean;
  isClick: boolean;
  startX: number;
  currentX: number;
  startY: number;
  currentY: number;
  startPosition: number;
  newPosition: number | null;
  instance: Instance;

  set setValue(value: number);
  get max(): number;
  get min(): number;
  get step(): number;
  get range(): boolean;
  get disabled(): boolean;
  get precision(): number;
  get sliderSize(): number;
  get hideTooltipParent(): boolean;
  get currentPosition(): string;
  get wrapperStyle(): object;
  get buttonStyle(): object;
  init(): void;
  resetSize(): void;
  emitChange(): void;
  setDataValueOrder(): void;
  showTooltip(): void;
  hideTooltip(): void;
  buttonEnter(): void;
  buttonLeave(): void;
  buttonDown(event: any): void;
  onDragStart(event: any): void;
  onDragging(event: any): void;
  onDragEnd(): void;
  setPosition(position: number): void;
}

export default (params): InputRange => ({
  $refs: {} as Refs,
  input: params.input,
  button: params.button,
  value: null,
  hovering: false,
  dragging: false,
  isClick: false,
  startX: 0,
  currentX: 0,
  startY: 0,
  currentY: 0,
  startPosition: 0,
  newPosition: null,
  instance: {} as Instance,

  set setValue (value) {
    this.value = value
  },
  get max () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'max')
  },
  get min () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'min')
  },
  get step () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'step')
  },
  get range () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'range')
  },
  get disabled () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'disabled')
  },
  get precision () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'precision')
  },
  get sliderSize () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'sliderSize')
  },
  get hideTooltipParent () {
    return window.Alpine.evaluate(this.$refs.sliderComponent, 'hideTooltip')
  },
  get currentPosition () {
    return `${
      (this.value ?? this.min - this.min) / (this.max - this.min) * 100
    }%`
  },
  get wrapperStyle () {
    return { left: this.currentPosition }
  },
  get buttonStyle () {
    return this.dragging ? { cursor: 'grabbing', transform: 'scale(1.2)' } : {}
  },
  init () {
    this.value = Number(this.$refs[this.input].value)

    if (!this.hideTooltipParent) {
      const button = this.input.replace('input', 'button')

      const tooltip = this.$refs[button].firstElementChild.firstElementChild as Element

      this.instance = tippy(tooltip, { content: `${this.value}` })
    }
  },
  resetSize () {
    window.Alpine.evaluate(this.$refs.sliderComponent, 'resetSize()')
  },
  emitChange () {
    window.Alpine.evaluate(
      this.$refs.sliderComponent,
      `emitChange('${this.input}', '${this.value}')`
    )
  },
  setDataValueOrder () {
    if (this.range) {
      window.Alpine.evaluate(this.$refs.sliderComponent, 'setDataValueOrder()')
    }
  },
  showTooltip () {
    if (this.hideTooltipParent) return

    this.instance.setContent(`${this.value}`)

    this.instance.show()
  },
  hideTooltip () {
    if (this.hideTooltipParent) return

    this.instance.hide()
  },
  buttonEnter () {
    this.hovering = true

    this.showTooltip()
  },
  buttonLeave () {
    this.hovering = false

    this.hideTooltip()
  },
  buttonDown (event) {
    if (this.disabled) return

    event.preventDefault()

    this.onDragStart(event)
  },
  onDragStart (event) {
    this.dragging = true
    this.isClick = true

    if (event.type === 'touchstart') {
      event.clientY = event.touches[0].clientY
      event.clientX = event.touches[0].clientX
    }

    this.startX = event.clientX

    this.startPosition = parseFloat(this.currentPosition)

    this.newPosition = this.startPosition
  },
  onDragging (event) {
    if (this.dragging) {
      this.isClick = false

      this.showTooltip()

      this.resetSize()

      let diff = 0

      if (event.type === 'touchmove') {
        event.clientY = event.touches[0].clientY
        event.clientX = event.touches[0].clientX
      }

      this.currentX = event.clientX

      diff = (this.currentX - this.startX) / this.sliderSize * 100

      this.newPosition = this.startPosition + diff

      this.setPosition(this.newPosition)
    }
  },
  onDragEnd () {
    if (this.dragging) {
      this.dragging = false

      this.hideTooltip()

      if (!this.isClick) {
        this.setPosition(Number(this.newPosition))

        this.setDataValueOrder()
      }
    }
  },
  setPosition (newPosition) {
    if (this.disabled) return

    if (newPosition === null || isNaN(newPosition)) return

    newPosition = newPosition < 0 ? 0 : newPosition

    newPosition = newPosition > 100 ? 100 : newPosition

    const lengthPerStep = 100 / ((this.max - this.min) / this.step)

    const steps = Math.round(newPosition / lengthPerStep)

    const value = steps * lengthPerStep * (this.max - this.min) * 0.01 + this.min

    this.value = parseFloat(value.toFixed(this.precision))

    this.emitChange()
  }
})
