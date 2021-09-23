import { applyMask } from '../utils/masker'
import { Entangle } from './alpine'

export interface InitOptions {
  model: Entangle
  config: {
    isLazy: boolean
    interval: number
    format: string
    is12H: boolean
    readonly: boolean
    disabled: boolean
  },
}

export interface TimePicker {
  [index: string]: any
}

export default (options: InitOptions): TimePicker => ({
  model: options.model,
  input: null,
  config: options.config,
  search: '',
  showPicker: false,
  times: [],
  filteredTimes: [],

  init () {
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
  openPicker () {
    if (this.config.readonly || this.config.disabled) return

    this.fillTimes()
    this.showPicker = true
    this.search = ''
    this.filteredTimes = this.times

    if (window.innerWidth >= 1000) {
      this.$nextTick(() => {
        this.$refs.search.focus()
      })
    }
  },
  closePicker () {
    this.showPicker = false
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
    if (this.times.length > 0) return

    const times: string[] = []
    let startTime = 0
    const timePeriods = ['AM', 'PM']

    for (let i = 0; startTime < 24 * 60; i++) {
      const hour = Math.floor(startTime / 60)
      let formatedHour = this.config.is12H ? Number(hour % 12) : hour.toString().padStart(2, '0')
      const minutes = Number(startTime % 60).toString().padStart(2, '0')
      const timePeriod = timePeriods[Math.floor(hour / 12)]

      if (this.config.is12H && formatedHour === 0) { formatedHour = 12 }

      let time = `${formatedHour}:${minutes}`

      if (this.config.is12H) time += ` ${timePeriod}`

      times.push(time)

      startTime += this.config.interval
    }

    this.times = times
  },
  selectTime (time) {
    this.input = time
    this.closePicker()
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
    this.filteredTimes = this.times.filter(time => time.includes(this.search))

    if (this.filteredTimes.length === 0) {
      if (!this.config.is12H) {
        return this.filteredTimes.push(this.search)
      }

      this.filteredTimes.push(`${this.search} AM`)
      this.filteredTimes.push(`${this.search} PM`)
    }
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

    return this.config.is12H
      ? this.convertTo12Hours(time)
      : time
  },
  hasDate (value) { return /\d{4}-\d{2}-\d{2}/.test(value) },
  hasTime (value) { return /\d{2}:\d{2}/.test(value) },
  getTimeFromDate (dateTime) {
    if (!dateTime) return

    const separator = dateTime?.includes('T') ? 'T' : ' '
    const time = dateTime.split(separator).pop()

    if (this.hasDate(time)) { return '' }

    return time.slice(0, 5)
  },
  getFocusables () { return [...this.$el.querySelectorAll('li, input')] },
  getFirstFocusable () { return this.getFocusables().shift() },
  getLastFocusable () { return this.getFocusables().pop() },
  getNextFocusable () { return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable() },
  getPrevFocusable () { return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable() },
  getNextFocusableIndex () { return (this.getFocusables().indexOf(document.activeElement) + 1) % (this.getFocusables().length + 1) },
  getPrevFocusableIndex () { return Math.max(0, this.getFocusables().indexOf(document.activeElement)) - 1 }
})
