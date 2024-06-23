import Feature from '@/components/date-picker/features/Feature'
import FluentDate from '@/utils/date'
import { SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { isNotEmpty } from '@/utils/helpers'

export default class Watchers extends Feature {
  init (): void {
    this.component.$watch('time', (time: string|null) => {
      this.component.selected?.setTime(time ?? '00:00:00')

      this.component.entangleable.runSetCallbacks()
    })

    this.component.entangleable.watch(date => {
      if (this.component.$props.timePicker.enabled && this.component.selected) {
        this.component.time = this.component.selected?.getTime() ?? null
      }

      if (!date) {
        const emptyValue = this.component.$props.calendar.multiple.enabled ? [] : null

        return this.$events.dispatch('clear', emptyValue)
      }

      this.component.calendar.dates.forEach(day => {
        day.isSelected = this.component.isSelected(new FluentDate(day.date))
      })

      if (isNotEmpty(date)) {
        const selected = date instanceof FluentDate ? date : date[0]

        this.component.calendar.month = selected.getMonth()
        this.component.calendar.year = selected.getYear()

        this.$events.dispatch(
          'selected::month',
          this.component.calendar.year,
          this.component.calendar.month,
        )
      }
    })

    const preventInitialFill = true

    if (this.component.$props.wireModel.exists) {
      new SupportsLivewire(this.component.entangleable, this.component.$props.wireModel, preventInitialFill)
        .toLivewire((value: FluentDate|FluentDate[]|null) => this.fromComponent(value))
        .fromLivewire((value: string|string[]|null) => this.toComponent(value))
        .fillValueFromLivewire()
    }

    if (this.component.$props.alpineModel.exists) {
      new SupportsAlpine(this.component.$root, this.component.entangleable, this.component.$props.alpineModel, preventInitialFill)
        .toAlpine((value: FluentDate|FluentDate[]|null) => this.fromComponent(value))
        .fromAlpine((value: string|string[]|null) => this.toComponent(value))
        .fillValueFromAlpine()
    }

    this.fillFromRawInput()
  }

  private fillFromRawInput (): void {
    const value = this.component.$refs.rawInput.value

    if (isNotEmpty(value)) {
      const date = this.toComponent(value)
      this.component.entangleable.set(date)
    }
  }

  toComponent (value: string|string[]|null): FluentDate|FluentDate[]|null {
    if (this.component.$props.calendar.multiple.enabled) {
      return Array.isArray(value)
        ? value.map(date => new FluentDate(date, this.component.localTimezone, this.component.dateFormat))
        : []
    }

    if (this.component.$props.timezone.enabled) {
      if (isNotEmpty(value) && typeof value === 'string') {
        return new FluentDate(value, this.component.$props.timezone.server, this.component.dateFormat)
          .setTimezone(this.component.localTimezone)
      }

      return null
    }

    return isNotEmpty(value) && typeof value === 'string'
      ? new FluentDate(value, this.component.localTimezone, this.component.dateFormat)
      : null
  }

  fromComponent (value: FluentDate|FluentDate[]|null): string|string[]|null {
    if (this.component.$props.calendar.multiple.enabled) {
      return Array.isArray(value)
        ? value.map(date => date.format(this.component.dateFormat))
        : []
    }

    if (this.component.$props.timezone.enabled) {
      return value instanceof FluentDate
        ? value.format(this.component.dateFormat, this.component.$props.timezone.server)
        : null
    }

    return value instanceof FluentDate
      ? value.format(this.component.dateFormat)
      : null
  }
}
