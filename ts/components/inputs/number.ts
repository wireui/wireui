import { AlpineComponent } from '@/components/alpine2'

export default class NumberInput extends AlpineComponent {
  declare $refs: {
    input?: HTMLInputElement
  }

  declare $props: {
    disabled: boolean
    readonly: boolean
  }

  value: number|null = null

  get min (): number {
    return Number(this.$refs.input?.min ?? 0)
  }

  get max (): number {
    return Number(this.$refs.input?.max ?? 0)
  }

  get disablePlus (): boolean {
    if (this.$props.disabled) return true

    return this.max
      ? Number(this.value) >= this.max
      : false
  }

  get disableMinus (): boolean {
    if (this.$props.disabled) return true

    return this.min
      ? Number(this.value) <= this.min
      : false
  }

  get isDisabled (): boolean {
    return this.$props.disabled || this.$props.readonly
  }

  init () {
    this.value = Number(this.$refs.input?.value ?? 0)
  }

  plus () {
    if (this.isDisabled || !this.$refs.input) return

    this.$refs.input.stepUp()

    this.value = Number(this.$refs.input.value)

    this.$refs.input.dispatchEvent(new Event('input'))
  }

  minus () {
    if (this.isDisabled || !this.$refs.input) return

    this.$refs.input.stepDown()

    this.value = Number(this.$refs.input.value)

    this.$refs.input.dispatchEvent(new Event('input'))
  }
}
