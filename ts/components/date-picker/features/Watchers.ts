import Feature from '@/components/date-picker/features/Feature'
import FluentDate from '@/utils/date'
import { SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'

export default class Watchers extends Feature {
  init (): void {
    this.component.$watch('time', (time: string|null) => {
      this.component.entangleable.get()?.setTime(time ?? '00:00:00')

      this.component.entangleable.runSetCallbacks()
    })

    this.component.entangleable.watch((date: FluentDate|null) => {
      if (this.component.$props.timePicker.enabled) {
        this.component.time = date?.getTime() ?? null
      }

      if (!date) {
        return this.$events.dispatch('clear', null)
      }

      this.component.calendar.dates.forEach(day => {
        day.isSelected = this.component.isSelected(new FluentDate(day.date))
      })

      // if (date) {
      //   this.calendar.month = date.getMonth()
      //   this.calendar.year = date.getYear()
      //
      //   this.$events.dispatch(
      //     'selected::month',
      //     this.calendar.year,
      //     this.calendar.month,
      //   )
      // }
    })

    if (this.component.$props.wireModel.exists) {
      new SupportsLivewire(this.component.entangleable, this.component.$props.wireModel)
        .toLivewire((value: FluentDate|null) => this.fromComponent(value))
        .fromLivewire((value: string|null) => this.toComponent(value))
    }

    if (this.component.$props.alpineModel.exists) {
      new SupportsAlpine(this.component.$root, this.component.entangleable, this.component.$props.alpineModel)
        .toAlpine((value: FluentDate|null) => this.fromComponent(value))
        .fromAlpine((value: string|null) => this.toComponent(value))
    }
  }

  toComponent (value: string|null): FluentDate|null {
    if (this.component.$props.timezone.enabled) {
      const format = this.component.$props.input.parseFormat
        ? this.component.$props.input.parseFormat
        : this.component.$props.timePicker.enabled
          ? 'YYYY-MM-DDTHH:mm:ss'
          : 'YYYY-MM-DD'

      return value
        ? new FluentDate(value, this.component.$props.timezone.server, format).setTimezone(this.component.localTimezone)
        : null
    }

    // console.log('toComponent', value, new FluentDate(value).toIsoString())

    const format = this.component.$props.input.parseFormat
      ? this.component.$props.input.parseFormat
      : this.component.$props.timePicker.enabled
        ? 'YYYY-MM-DDTHH:mm:ss'
        : 'YYYY-MM-DD'

    return value
      ? new FluentDate(value, this.component.localTimezone, format)
      : null
  }

  fromComponent (value: FluentDate|null): string|null {
    if (this.component.$props.timezone.enabled) {
      const format = this.component.$props.input.parseFormat
        ? this.component.$props.input.parseFormat
        : this.component.$props.timePicker.enabled
          ? 'YYYY-MM-DDTHH:mm:ss'
          : 'YYYY-MM-DD'

      return value
        ? value.format(format, this.component.$props.timezone.server)
        : null
    }

    return value
      ? value.toIsoString()
      : null
  }
}

/*
    this.$watch('time', (time: string|null) => {
      this.entangleable.get()?.setTime(time ?? '00:00:00')

      this.entangleable.runSetCallbacks()
    })

    this.entangleable.watch((date: FluentDate|null) => {
      this.time = date?.getTime() ?? null

      if (!date) {
        return this.$events.dispatch('clear', null)
      }

      this.calendar.dates.forEach(day => {
        day.isSelected = this.isSelected(new FluentDate(day.date))
      })

      // if (date) {
      //   this.calendar.month = date.getMonth()
      //   this.calendar.year = date.getYear()
      //
      //   this.$events.dispatch(
      //     'selected::month',
      //     this.calendar.year,
      //     this.calendar.month,
      //   )
      // }
    })

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
        .toLivewire((value: FluentDate|null) => {
          return value
            ? value.toISOString(this.$props.timezone.server)
            : null
        })
        .fromLivewire((value: string|null) => {
          return value
            ? new FluentDate(value, this.$props.timezone.server).setTimezone(this.localTimezone)
            : null
        })
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$root, this.entangleable, this.$props.alpineModel)
        .fromAlpine((value: FluentDate|null) => {
          return value
            ? value.toISOString(this.$props.timezone.server)
            : null
        })
        .fromAlpine((value: string|null) => {
          return value
            ? new FluentDate(value, this.$props.timezone.server).setTimezone(this.localTimezone)
            : null
        })
    }
 */
