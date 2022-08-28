export type Refs = {
  input: HTMLInputElement
}

export interface InputNumber {
  $refs: Refs,
  min: string | null,
  max: string | null,
  value: string | null,
  disabled: boolean,
  readonly: boolean,

  init(): void
  plus(): void
  minus(): void
  get disablePlus(): boolean
  get disableMinus(): boolean
}

export default (params): InputNumber => ({
  $refs: {} as Refs,
  min: null,
  max: null,
  value: null,
  disabled: params.disabled,
  readonly: params.readonly,

  init () {
    this.min = this.$refs.input.min

    this.max = this.$refs.input.max

    this.value = this.$refs.input.value
  },
  plus () {
    if (this.disabled || this.readonly) return

    this.$refs.input.stepUp()

    this.value = this.$refs.input.value

    this.$refs.input.dispatchEvent(new Event('input'))
  },
  minus () {
    if (this.disabled || this.readonly) return

    this.$refs.input.stepDown()

    this.value = this.$refs.input.value

    this.$refs.input.dispatchEvent(new Event('input'))
  },
  get disablePlus () {
    if (this.disabled) return true

    return this.max ? Number(this.value) >= Number(this.max) : false
  },
  get disableMinus () {
    if (this.disabled) return true

    return this.min ? Number(this.value) <= Number(this.min) : false
  }
})
