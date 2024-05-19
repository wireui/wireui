import { Entangleable, SupportsLivewire } from '@/alpine/modules/entangleable'
import Positionable from '@/alpine/modules/Positionable'
import { AlpineComponent } from '@/components/alpine2'
import { toMilitaryFormat } from '@/components/TimeSelector/helpers'
import { WireModel } from '@/livewire'
import FluentDate from '@/utils/date'
import { onlyNumbers } from '@/utils/helpers'
import { applyMask } from '@/utils/masker'

export default class TimePicker extends AlpineComponent {
  declare $refs: {
    popover: HTMLElement
    input: HTMLInputElement
    container: HTMLDivElement
    optionsContainer: HTMLDivElement
  }

  declare $props: {
    wireModel: WireModel
    militaryTime: boolean
    withoutSeconds: boolean
    disabled: boolean
    readonly: boolean
  }

  private date = new FluentDate(new Date())

  entangleable: Entangleable = new Entangleable()

  positionable: Positionable = new Positionable()

  input: string|null = null

  value: string|null = null

  init () {
    this.positionable
      .start(this, this.$refs.container, this.$refs.popover)
      .position('bottom')

    if (!this.input && this.$refs.input.value) {
      this.input = this.$refs.input.value
    }

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    // new SupportsAlpine(this.entangleable, this.$refs.input)

    this.$safeWatch('input', (input: string|null) => {
      this.input = this.maskInput(input)

      this.$skipNextWatcher('value', () => {
        const [hours, minutes, seconds] = this.input?.split(':') ?? []

        this.date
          .setHours(
            this.$props.militaryTime
              ? Number(hours) || 0
              : toMilitaryFormat(this.input?.includes('PM') ? 'PM' : 'AM', Number(hours) || 0)
          )
          .setMinutes(Number(minutes) || 0)
          .setSeconds(Number(onlyNumbers(seconds)) || 0)

        this.value = this.date.format('H:mm:ss')
      })
    })

    this.$safeWatch('value', (value: string|null) => {
      const [hours, minutes, seconds] = value?.split(':') ?? []

      this.date
        .setHours(Number(hours) || 0)
        .setMinutes(Number(minutes) || 0)
        .setSeconds(Number(seconds) || 0)

      let format = this.$props.militaryTime ? 'H:mm:ss' : 'h:mm:ss A'

      if (this.$props.withoutSeconds) {
        format = format.replace(':ss', '')
      }

      this.$skipNextWatcher('input', () => {
        this.input = this.date.format(format)
      })
    })
  }

  private maskInput (value?: string|null) {
    let mask = this.$props.militaryTime ? 'H:m:s' : 'h:m:s P'

    if (this.$props.withoutSeconds) {
      mask = this.$props.militaryTime ? 'H:m' : 'h:m P'
    }

    return applyMask(mask, value || null)
  }

  clear (): void {
    this.input = null
  }

  onBlur (): void {
    this.ensureDefaultValue()

    this.entangleable.set(this.input, { force:true, triggerBlur: true })
  }

  private ensureDefaultValue (): void {
    if (!this.input) return

    let input = this.input

    const hasMinutes = /^\d{1,2}:\d{1,2}$/g.test(input)
    const hasSeconds = /^\d{1,2}:\d{1,2}:\d{1,2}$/g.test(input)

    if (!hasMinutes) {
      input += ':00'
    }

    if (!hasSeconds && !this.$props.withoutSeconds) {
      input += ':00'
    }

    if (!this.$props.militaryTime && (!input.endsWith('AM') || !input.endsWith('PM'))) {
      input += ' AM'
    }

    this.input = input
  }
}
