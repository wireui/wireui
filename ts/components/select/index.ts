import { focusables } from '../modules/focusables'
import { Select } from './interfaces'
import { templates } from './templates'
import { InitOptions, Option, Options, Refs } from './types'
import baseTemplate from './templates/baseTemplate'
import dataGet from '../../utils/dataGet'
import { notify } from '../../notifications'

export default (initOptions: InitOptions): Select => ({
  ...focusables,
  focusableSelector: 'li[tabindex="0"], input',
  $refs: {} as Refs,
  asyncData: {
    api: initOptions.asyncData,
    fetching: false
  },
  config: {
    hasSlot: initOptions.hasSlot,
    searchable: initOptions.searchable,
    multiselect: initOptions.multiselect,
    readonly: initOptions.readonly,
    disabled: initOptions.disabled,
    optionValue: initOptions.optionValue,
    optionLabel: initOptions.optionLabel,
    optionDescription: initOptions.optionDescription,
    template: templates[initOptions.template?.name ?? 'default'](initOptions.template?.config ?? {})
  },
  placeholder: initOptions.placeholder,
  popover: false,
  search: '',
  wireModel: initOptions.wireModel,
  selected: undefined,
  selectedOptions: [],
  options: [],
  displayOptions: [],
  get hasWireModel () {
    return this.wireModel !== undefined
  },
  init () {
    this.initWatchers()

    if (!this.asyncData.api) {
      this.config.hasSlot
        ? this.initSlotObserver()
        : this.initOptionsObserver()
    }

    this.hasWireModel
      ? this.initWireModel()
      : this.fillSelectedFromInputValue()
  },
  initWatchers () {
    this.$watch('popover', (state: boolean) => {
      if (state) {
        if (this.asyncData.api && this.options.length === 0) {
          this.fetchOptions()
        }

        this.$nextTick(() => {
          setTimeout(() => this.$refs.search?.focus(), 100)
        })
      }

      this.$refs.input.dispatchEvent(new Event(state ? 'open' : 'close'))
    })

    this.$watch('search', (search: string) => {
      this.$refs.optionsContainer?.scroll({ top: 0, left: 0, behavior: 'smooth' })

      if (this.asyncData.api) {
        return this.fetchOptions()
      }

      this.displayOptions = this.searchOptions(search.toLocaleLowerCase())
    })

    this.$watch('options', (options: Options) => {
      this.displayOptions = options
    })
  },
  initWireModel () {
    this.syncSelectedFromWireModel()

    if (this.hasWireModel && this.config.multiselect) {
      this.$watch('selectedOptions', (options: Options) => {
        if (this.mustSyncWireModel()) {
          this.wireModel = options.map((option: Option) => option.value)
        }
      })

      this.$watch('wireModel', (options: any[]) => {
        if (!Array.isArray(options)) {
          throw new Error('The wire:model value must be an array to use the select as multiselect')
        }

        if (this.mustSyncWireModel()) {
          this.asyncData.api
            ? this.fetchSelected()
            : this.syncSelectedFromWireModel()
        }
      })
    }

    if (this.hasWireModel && !this.config.multiselect) {
      this.$watch('selected', (option: Option | undefined) => {
        this.wireModel = option?.value ?? null
      })

      this.$watch('wireModel', value => {
        if (value === null || value === '') {
          return (this.selected = undefined)
        }

        const selected = this.options.find(option => option.value === value)

        if (value && selected) {
          this.selected = selected
        } else if (value && !selected && this.asyncData.api) {
          this.fetchSelected()
        }
      })
    }

    if (this.wireModel && this.asyncData.api) {
      this.fetchSelected()
    }
  },
  initOptionsObserver () {
    const element = this.$refs.json
    this.options = JSON.parse(element.innerText)

    const observer = new MutationObserver(mutations => {
      const textContent = mutations[0]?.target?.textContent ?? '[]'

      this.options = JSON.parse(textContent)
    })

    observer.observe(element, {
      subtree: true,
      characterData: true
    })
  },
  initSlotObserver () {
    this.syncSlotOptions()

    const element = this.$refs.slot
    const observer = new MutationObserver(this.syncSlotOptions.bind(this))

    observer.observe(element, {
      characterData: true,
      childList: true,
      subtree: true
    })
  },
  syncSlotOptions () {
    const elements = this.$refs.slot.querySelectorAll('[name="wireui.select.option"]')

    this.options = Array.from(elements).flatMap(element => {
      const json = element.querySelector('[name="wireui.select.json"]')?.textContent

      if (!json) return []

      const option: Option = JSON.parse(json)
      option.html = element.querySelector('[name="wireui.select.slot"]')?.innerHTML

      return option
    })
  },
  fetchOptions () {
    if (!this.asyncData.api) return

    this.asyncData.fetching = true

    const request = new Request(`${this.asyncData.api}?search=${this.search}`, {
      method: 'GET',
      headers: new Headers({
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      })
    })

    fetch(request)
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw new Error(data.message ?? 'Failed to fetch options')
          })
        }

        return response.json()
      })
      .then((rawOptions: any[]) => {
        if (!Array.isArray(rawOptions)) return

        this.options = rawOptions.map(rawOption => this.mapOption(rawOption))
      }).catch((message: Error) => {
        notify({
          title: String(message.message),
          description: 'Try to reload the page',
          icon: 'error',
          timeout: 2500
        })
      }).finally(() => {
        this.asyncData.fetching = false
      })
  },
  fetchSelected () {
    const queryParams = this.config.multiselect
      ? this.wireModel.map(id => `selected[]=${id}`).join('&')
      : `selected[]=${this.wireModel}`

    fetch(`${this.asyncData.api}?${queryParams}`)
      .then(response => response.json())
      .then(rawOptions => {
        if (!Array.isArray(rawOptions)) return

        if (this.config.multiselect) {
          return (this.selectedOptions = rawOptions.map(rawOption => this.mapOption(rawOption)))
        }

        this.selected = this.mapOption(rawOptions[0])
      }).catch(error => {
        reportError(error)
      })
  },
  mapOption (rawOption) {
    const option: Option = {
      ...rawOption,
      label: dataGet(rawOption, this.config.optionLabel),
      value: dataGet(rawOption, this.config.optionValue),
      description: dataGet(rawOption, 'description'),
      template: rawOption.template,
      disabled: rawOption.disabled,
      readonly: rawOption.readonly || rawOption.disabled
    }

    if (this.config.optionDescription) {
      option.description = dataGet(rawOption, this.config.optionDescription)
    }

    return option
  },
  fillSelectedFromInputValue () {
    const inputValue = this.$refs.input.value

    if (!this.config.multiselect) {
      // eslint-disable-next-line eqeqeq
      this.selected = this.options.find(option => option.value == inputValue)

      return
    }

    try {
      this.selectedOptions = JSON.parse(inputValue).map(value => {
        // eslint-disable-next-line eqeqeq
        return this.options.find(option => option.value == value)
      })
    } catch (error) {
      // eslint-disable-next-line no-console
      console.error(error)
    }
  },
  syncSelectedFromWireModel () {
    if (this.config.multiselect) {
      this.selectedOptions = this.wireModel
        .map(value => {
          return this.options.find(option => option.value === value)
        })
        .filter((option?: Option) => {
          return option !== undefined
        })

      return
    }

    this.selected = this.options.find(option => option.value === this.wireModel)
  },
  mustSyncWireModel () {
    return this.wireModel?.toString() !== this.selectedOptions.map(option => option.value).toString()
  },
  searchOptions (search) {
    return this.options.filter(option => {
      const label = option.label.toLocaleLowerCase()

      return label.includes(search)
    })
  },
  togglePopover () {
    if (this.config.readonly) return

    this.popover = !this.popover

    this.$refs.input.focus()
  },
  closePopover () {
    this.popover = false
  },
  getSelectedValue () {
    if (this.config.multiselect) {
      if (this.selectedOptions.length === 0) return null

      return JSON.stringify(this.selectedOptions.map(option => option.value))
    }

    return this.selected?.value ?? ''
  },
  getSelectedDysplayText () {
    if (!this.selected || this.config.multiselect) return ''
    if (this.selected.html) return this.selected.html
    if (this.selected.template) {
      const config = initOptions.template?.config ?? {}
      const template = templates[this.selected.template](config)

      if (template.renderSelected) {
        return template.renderSelected(this.selected)
      }
    }
    if (this.config.template.renderSelected) {
      return this.config.template.renderSelected(this.selected)
    }

    return this.selected.label ?? ''
  },
  getPlaceholder () {
    if (this.config.multiselect && this.selectedOptions.length > 0) return ''

    return this.placeholder ?? ''
  },
  isSelected (option) {
    if (this.config.multiselect) {
      return this.selectedOptions.some(({ value }) => value === option.value)
    }

    return option.value === this.selected?.value
  },
  select (option) {
    if (this.config.readonly) return

    this.search = ''

    if (this.config.multiselect) {
      const exists = this.selectedOptions.some(({ value }) => value === option.value)

      if (exists) return this.unSelect(option)

      this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: option }))

      return this.selectedOptions.push(option)
    }

    this.selected = option.value === this.selected?.value ? undefined : option

    this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: option }))

    this.closePopover()
  },
  unSelect (option) {
    if (this.config.readonly) return

    if (this.config.multiselect) {
      const index = this.selectedOptions.findIndex(({ value }) => value === option.value)
      this.selectedOptions.splice(index, 1)
    }

    this.$refs.input.dispatchEvent(new CustomEvent('un-selected', { detail: option }))
  },
  clear () {
    this.search = ''
    this.config.multiselect
      ? this.selectedOptions = []
      : this.selected = undefined
    this.$refs.input.dispatchEvent(new Event('clear'))
  },
  isEmpty () {
    if (this.config.multiselect) {
      return this.selectedOptions.length === 0
    }

    return this.selected === undefined
  },
  renderOption (option) {
    if (option.html) {
      return baseTemplate(option.html)
    }

    if (option.template) {
      const config = initOptions.template?.config ?? {}

      return templates[option.template](config).render(option)
    }

    return this.config.template.render(option)
  }
})
