import { AlpineComponent } from '@/components/alpine2'
import { normalizeDigits } from '@/utils/helpers'

export default class NumberInput extends AlpineComponent {
  declare $refs: {
    input?: HTMLInputElement
  }

  declare $props: {
    disabled: boolean
    readonly: boolean
  }

  value: number|null = null

  // Use getAttribute so that min/max work even with type="text"
  get min (): number {
    return Number(this.$refs.input?.getAttribute('min') ?? 0)
  }

  get max (): number {
    return Number(this.$refs.input?.getAttribute('max') ?? 0)
  }

  get step (): number {
    return Number(this.$refs.input?.getAttribute('step') ?? 1) || 1
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
    this.value = Number(normalizeDigits(this.$refs.input?.value ?? '')) || 0

    // Keep this.value in sync when the user types directly
    if (this.$refs.input) {
      this.$refs.input.addEventListener('input', () => {
        if (this.$refs.input) {
          this.value = Number(normalizeDigits(this.$refs.input.value)) || 0
        }
      })
    }
  }

  /**
   * Intercept beforeinput to convert Arabic-Indic / Persian digits to
   * ASCII before they are written to the input value (and picked up by
   * wire:model).  Handles both single keystrokes and paste events.
   */
  handleBeforeInput (event: InputEvent): void {
    if (!event.data) return

    const normalized = normalizeDigits(event.data)
    if (normalized === event.data) return

    event.preventDefault()

    const input = this.$refs.input!
    const start = input.selectionStart ?? 0
    const end = input.selectionEnd ?? 0

    input.value = input.value.slice(0, start) + normalized + input.value.slice(end)
    input.setSelectionRange(start + normalized.length, start + normalized.length)

    input.dispatchEvent(new Event('input', { bubbles: true }))
  }

  plus () {
    if (this.isDisabled || !this.$refs.input) return

    const current = Number(normalizeDigits(this.$refs.input.value)) || 0
    const newValue = current + this.step

    if (this.max && newValue > this.max) return

    this.value = newValue
    this.$refs.input.value = String(newValue)
    this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }))
  }

  minus () {
    if (this.isDisabled || !this.$refs.input) return

    const current = Number(normalizeDigits(this.$refs.input.value)) || 0
    const newValue = current - this.step

    if (this.min && newValue < this.min) return

    this.value = newValue
    this.$refs.input.value = String(newValue)
    this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }))
  }
}
