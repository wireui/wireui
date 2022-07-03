import { applyMask } from '@/utils/masker'
import { convertStandardTimeToMilitary } from '@/utils/time'
import { positioning } from '@/components/modules/positioning'
import { InitOptions, TimePicker, Refs } from './interfaces'
import { focusables } from '@/components/modules/focusables'
import { makeTimes, Time } from '@/components/datetime-picker/makeTimes'

export default (options: InitOptions): TimePicker => ({
  ...positioning,
  ...focusables,
  focusableSelector: 'li, input',
  $refs: {} as Refs,
  model: options.model,
  input: null,
  config: options.config,
  search: '',
  times: [],
  filteredTimes: [],

  init () {
    this.initPositioningSystem()

    this.input = this.convertModelTime(this.model)

    this.$watch('model', value => {
      const time = this.getTimeFromDate(value)
      const input = this.config.is12H ? this.convertTo24Hours(this.input) : this.input

      if (time !== input) {
        this.input = this.maskInput(time)
      }
    })
  },
  maskInput (value) {
    const mask = this.config.is12H ? 'h:m AA' : 'H:m'

    return applyMask(mask, value)
  },
  toggle () {
    this.popover = !this.popover

    if (!this.popover || this.config.readonly || this.config.disabled) return

    if (this.times.length === 0) {
      this.fillTimes()
    }

    this.search = ''
    this.filteredTimes = this.times

    if (window.innerWidth >= 1024) {
      this.$nextTick(() => {
        this.$refs.search.focus()
      })
    }
  },
  clearInput () {
    this.input = null
    let dateTime = null

    if (this.hasDate(this.model)) {
      dateTime = this.model.slice(0, 10)
    }

    this.model = dateTime
  },
  fillTimes () {
    this.times = makeTimes({
      time12H: this.config.is12H,
      interval: this.config.interval
    })
  },
  selectTime (time) {
    this.input = this.config.is12H ? time.label : time.value
    this.close()
    this.emitInput()
  },
  onInput (value) {
    if (this.config.is12H) {
      const timePeriod = value?.replace(/[^a-zA-Z]+/g, '')?.toLocaleUpperCase()

      if (timePeriod && !'AMPM'.includes(timePeriod)) {
        const index = 'AP'.includes(timePeriod[0]) ? 7 : 6

        this.input = value.slice(0, index)

        return
      }
    }

    this.input = this.maskInput(value)

    if (!this.config.isLazy) {
      this.emitInput()
    }
  },
  onSearch (search) {
    const mask = this.config.is12H ? 'h:m' : 'H:m'
    this.search = applyMask(mask, search) ?? ''
    this.filteredTimes = this.times.filter(time => time.label.includes(this.search))

    if (this.filteredTimes.length > 0) return

    this.filteredTimes = this.makeSearchTimes(this.search)
  },
  makeSearchTimes (search) {
    const times: Time[] = []

    if (!this.config.is12H) {
      times.push({
        value: search.padEnd(5, '0'),
        label: search.padEnd(5, '0')
      })

      return times
    }

    times.push({
      value: convertStandardTimeToMilitary(`${search} AM`),
      label: `${search} AM`
    })

    times.push({
      value: convertStandardTimeToMilitary(`${search} PM`),
      label: `${search} PM`
    })

    return times
  },
  emitInput () {
    let date = ''
    let time = this.input ?? ''

    if (this.hasDate(this.model)) {
      date = this.model.slice(0, 10)
    }

    if (this.config.is12H) {
      time = this.convertTo24Hours(time)
    }

    this.model = `${date} ${time}`.trim()
  },
  convertTo24Hours (time12h) {
    if (!time12h) return ''

    const [time = '00', period = 'AM'] = time12h.split(' ')
    let [hours = '00', minutes = '00'] = time.split(':')

    if (hours === '12') {
      hours = '00'
    }

    if (period === 'PM') {
      hours = (parseInt(hours, 10) + 12).toString()
    }

    hours = hours.padStart(2, '0')
    minutes = minutes.padEnd(2, '0')

    return `${hours}:${minutes}`
  },
  convertTo12Hours (time24) {
    if (!time24) return ''

    const [hours24 = '12', minutes = '00'] = time24.split(':')
    const period = Number(hours24) < 12 ? 'AM' : 'PM'
    const hours = Number(hours24) % 12 || 12

    return `${hours}:${minutes.padEnd(2, '0')} ${period}`
  },
  convertModelTime (dateTime) {
    if (!dateTime) return ''

    const time = this.getTimeFromDate(dateTime)

    if (!time) return ''

    return this.config.is12H
      ? this.convertTo12Hours(time)
      : time
  },
  hasDate (value) { return /\d{4}-\d{2}-\d{2}/.test(value) },
  hasTime (value) { return /\d{2}:\d{2}/.test(value) },
  getTimeFromDate (dateTime) {
    if (!dateTime) return ''

    const separator = dateTime?.includes('T') ? 'T' : ' '
    const time = dateTime.split(separator).pop()

    if (!time) return ''

    if (this.hasDate(time)) return ''

    return time.slice(0, 5)
  }
})
