import { AlpineComponent } from '@/components/alpine2'

export default class NumberInput extends AlpineComponent {
  declare $refs: {
    input: HTMLInputElement
  }

  declare $props: {
    disabled: boolean
    readonly: boolean
  }

  value: number|null = null

  get min (): number {
    return Number(this.$refs.input.min)
  }

  get max (): number {
    return Number(this.$refs.input.max)
  }

  get disablePlus () {
    if (this.$props.disabled) return true

    return this.max
      ? Number(this.value) >= this.max
      : false
  }

  get disableMinus () {
    if (this.$props.disabled) return true

    return this.min
      ? Number(this.value) <= this.min
      : false
  }

  init () {
    this.value = Number(this.$refs.input.value)
  }

  plus () {
    if (this.$props.disabled || this.$props.readonly) return

    this.$refs.input.stepUp()

    this.value = Number(this.$refs.input.value)

    this.$refs.input.dispatchEvent(new Event('input'))
  }

  minus () {
    if (this.$props.disabled || this.$props.readonly) return

    this.$refs.input.stepDown()

    this.value = Number(this.$refs.input.value)

    this.$refs.input.dispatchEvent(new Event('input'))
  }
}
