import { AlpineComponent } from '@/alpine/components/alpine'

type Refs = {
  input: HTMLInputElement
}

type Props = {
  disabled: boolean
  readonly: boolean
}

export default class InputNumber extends AlpineComponent {
  declare $refs: Refs

  $props!: Props

  min: number|null = null

  max: number|null = null

  value: number|null = null

  init () {
    this.min = Number(this.$refs.input.min) || null
    this.max = Number(this.$refs.input.max) || null
    this.value = Number(this.$refs.input.value) || null
  }

  plus (): void {
    if (this.$props.disabled || this.$props.readonly) return

    this.$refs.input.stepUp()

    this.value = Number(this.$refs.input.value) || null

    this.$refs.input.dispatchEvent(new Event('input'))
  }

  minus (): void {
    if (this.$props.disabled || this.$props.readonly) return

    this.$refs.input.stepDown()

    this.value = Number(this.$refs.input.value) || null

    this.$refs.input.dispatchEvent(new Event('input'))
  }

  get disablePlus (): boolean {
    if (this.$props.disabled) return true

    return this.max
      ? Number(this.value) >= Number(this.max)
      : false
  }

  get disableMinus (): boolean {
    if (this.$props.disabled) return true

    return this.min
      ? Number(this.value) <= Number(this.min)
      : false
  }
}
