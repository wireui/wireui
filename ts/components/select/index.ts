import { stringify } from 'qs'
import { focusables } from '@/components/modules/focusables'
import { Select } from './interfaces'
import { templates } from './templates'
import { InitOptions, Option, Options, Props, Refs } from './types'
import baseTemplate from './templates/baseTemplate'
import dataGet from '@/utils/dataGet'
import { notify } from '@/notifications'
import { watchProps } from '@/alpine/magic/props'
import { jsonParse } from '@/utils/helpers'
import { positioning } from '@/components/modules/positioning'

export default (initOptions: InitOptions): Select => ({
  ...focusables,
  ...positioning,
  focusableSelector: 'div[tabindex="0"][select-option], input',
  $refs: {} as Refs,
  $props: {} as Props,
  asyncData: {
    api: null,
    method: 'GET',
    optionsPath: null,
    fetching: false,
    params: {},
    alwaysFetch: false
  },
  config: {
    hasSlot: false,
    searchable: false,
    multiselect: false,
    clearable: false,
    readonly: false,
    disabled: false,
    optionValue: null,
    optionLabel: null,
    optionDescription: null,
    placeholder: null,
    template: templates['default']()
  },
  search: '',
  wireModel: initOptions.wireModel,
  selected: undefined,
  selectedOptions: [],
  displayOptions: [],
  options: [],
  get hasWireModel () {
    return this.wireModel !== undefined
  },
  init () {
    this.initWatchers()
    this.syncProps()
    this.initPositioningSystem()

    watchProps(this, this.syncProps.bind(this))

    if (!this.asyncData.api) {
      this.config.hasSlot
        ? this.initSlotObserver()
        : this.initOptionsObserver()
    } else if (!this.hasWireModel && this.asyncData.api) {
      this.fetchSelected()
    }

    this.hasWireModel
      ? this.initWireModel()
      : this.fillSelectedFromInputValue()

    this.initDeferredWatchers()
  },
  initRenderObserver () {
    const config = {
      root: this.$refs.optionsContainer,
      rootMargin: '20px',
      threshold: 1.0
    }

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(({ target, isIntersecting }) => {
        if (!isIntersecting) return

        const index = target.getAttribute('index')

        if (index !== null) {
          target.innerHTML = this.renderOption(this.displayOptions[index])
          target.setAttribute('rendered', 'true')
          observer.unobserve(target)
        }
      })
    }, config)

    this.$refs.listing
      .querySelectorAll('li:not([rendered])')
      .forEach(li => {
        li.setAttribute('rendered', 'false')
        observer.observe(li)
      })
  },
  initWatchers () {
    this.$watch('popover', (state: boolean) => {
      if (state) {
        if (this.asyncData.api && (this.asyncData?.alwaysFetch || this.options.length === 0)) {
          this.fetchOptions()
        }

        this.$nextTick(() => {
          if (window.innerWidth >= 1024) {
            setTimeout(() => this.$refs.search?.focus(), 100)
          }
        })

        this.$nextTick(() => this.initRenderObserver())
      }

      if (this.asyncData.alwaysFetch && !state) {
        this.$nextTick(() => {
          setTimeout(() => (this.options = []), 150)
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

      this.$nextTick(() => this.initRenderObserver())
    })

    this.$watch('options', (options: Options) => {
      this.displayOptions = options
    })
  },
  initDeferredWatchers () {
    this.$watch('asyncData.api', () => (this.options = []))
    this.$watch('asyncData.optionsPath', () => (this.options = []))
    this.$watch('asyncData.params', () => (this.options = []))
    this.$watch('asyncData.method', () => (this.options = []))
  },
  initWireModel () {
    this.syncSelectedFromWireModel()

    if (this.hasWireModel && this.config.multiselect) {
      this.$watch('selectedOptions', (options: Options, oldOptions: Options) => {
        if (this.mustSyncWireModel()) {
          this.wireModel = options.map((option: Option) => option.value)
        }

        if (JSON.stringify(options) !== JSON.stringify(oldOptions)) {
          this.syncSelectedOptions()
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

      if (this.wireModel?.length > 0 && this.asyncData.api) {
        this.fetchSelected()
      }
    }

    if (this.hasWireModel && !this.config.multiselect) {
      this.$watch('selected', (option?: Option, oldOption?: Option) => {
        this.wireModel = option?.value ?? null

        if (oldOption?.value !== option?.value) {
          this.syncSelectedOptions()
        }
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

      if (this.wireModel && this.asyncData.api) {
        this.fetchSelected()
      }
    }
  },
  initOptionsObserver () {
    this.syncJsonOptions()

    const observer = new MutationObserver(this.syncJsonOptions.bind(this))

    observer.observe(this.$refs.json, {
      subtree: true,
      characterData: true
    })

    this.$cleanup(() => observer.disconnect())
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
  syncProps () {
    const props = this.$props

    const template = {
      name: props.template?.name ?? 'default',
      config: props.template?.config ?? {}
    }

    this.config = {
      hasSlot: props.hasSlot,
      searchable: props.searchable,
      multiselect: props.multiselect,
      clearable: props.clearable,
      readonly: props.readonly,
      disabled: props.disabled,
      placeholder: props.placeholder,
      optionValue: props.optionValue,
      optionLabel: props.optionLabel,
      optionDescription: props.optionDescription,
      template: templates[template.name](template.config)
    }

    this.asyncData = {
      ...this.asyncData,
      api: props.asyncData.api,
      method: props.asyncData.method,
      optionsPath: props.asyncData.optionsPath,
      params: props.asyncData.params,
      alwaysFetch: props.asyncData.alwaysFetch,
      credentials: props.asyncData.credentials
    }
  },
  syncJsonOptions () {
    this.setOptions(window.Alpine.evaluate(this, this.$refs.json.innerText))

    if (this.hasWireModel) {
      this.syncSelectedFromWireModel()
    }
  },
  syncSlotOptions () {
    const elements = this.$refs.slot.querySelectorAll('[name="wireui.select.option"]')

    const options = Array.from(elements).flatMap(element => {
      const base64 = element.querySelector('[name="wireui.select.option.data"]')?.textContent

      if (!base64) return []

      const option: Option = window.Alpine.evaluate(this, base64)

      option.html = element.querySelector('[name="wireui.select.slot"]')?.innerHTML

      return option
    })

    this.setOptions(options)

    if (this.hasWireModel) {
      this.syncSelectedFromWireModel()
    }
  },
  makeRequest (params = {}) {
    const { api, method, credentials } = this.asyncData

    const url = new URL(api ?? '')

    const parameters = Object.assign(
      params,
      window.Alpine.raw(this.asyncData.params),
      ...Array.from(url.searchParams).map(([key, value]) => ({ [key]: value }))
    )

    url.search = ''

    if (method === 'GET') {
      url.search = stringify(parameters)
    }

    const request = new Request(url, {
      method,
      body: method === 'POST' ? JSON.stringify(parameters) : undefined,
      credentials
    })

    request.headers.set('Content-Type', 'application/json')
    request.headers.set('Accept', 'application/json')
    request.headers.set('X-Requested-With', 'XMLHttpRequest')

    const csrfToken = document.head.querySelector('[name="csrf-token"]')?.getAttribute('content')

    if (csrfToken) {
      request.headers.set('X-CSRF-TOKEN', csrfToken)
    }

    return request
  },
  fetchOptions () {
    if (!this.asyncData.api) return

    this.asyncData.fetching = true

    fetch(this.makeRequest({ search: this.search }))
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw new Error(data.message ?? 'Failed to fetch options')
          })
        }

        return response.json()
      })
      .then((json: any) => {
        const rawOptions: any[] = dataGet(json, this.asyncData.optionsPath)
        if (!Array.isArray(rawOptions)) return

        this.setOptions(
          rawOptions.map(rawOption => this.mapOption(rawOption))
        )

        this.$nextTick(() => this.initRenderObserver())
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
    const selected = this.getValue()

    if (selected.length === 0) {
      this.selected = undefined
      this.selectedOptions = []

      return
    }

    fetch(this.makeRequest({ selected }))
      .then(response => response.json())
      .then(rawOptions => {
        this.selected = undefined
        this.selectedOptions = []

        if (!Array.isArray(rawOptions) || !rawOptions?.length) return

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
  setOptions (options) {
    this.options = options

    this.syncSelectedOptions()
  },
  syncSelectedOptions () {
    this.options
      .filter(option => option.isSelected)
      .forEach(option => (option.isSelected = false))

    const options = [...this.selectedOptions]

    if (this.selected && !this.config.multiselect) {
      options.push(this.selected)
    }

    options.forEach(option => {
      const index = this.options.findIndex(({ value }) => value === option.value)

      if (this.options[index]) {
        this.options[index].isSelected = true
      }
    })
  },
  fillSelectedFromInputValue () {
    this.selected = undefined
    this.selectedOptions = []

    if (this.options.length === 0) return

    const inputValue = this.$refs.input.value

    if (!this.config.multiselect) {
      if (!inputValue) {
        this.selected = undefined

        return
      }

      // eslint-disable-next-line eqeqeq
      this.selected = this.options.find(option => option.value == inputValue)

      return
    }

    try {
      this.selectedOptions = jsonParse(inputValue, []).map(value => {
        // eslint-disable-next-line eqeqeq
        return this.options.find(option => option.value == value)
      })
    } catch (error) {
      this.selectedOptions = []
      reportError(error)
    }
  },
  syncSelectedFromWireModel () {
    if (this.config.multiselect) {
      if (!Array.isArray(this.wireModel)) {
        this.wireModel = [this.wireModel]
      }

      return (this.selectedOptions = this.wireModel.flatMap(value => {
        const original = this.selectedOptions.find(option => option.value === value)

        if (original) return original

        return this.options.find(option => option.value === value) ?? []
      }))
    }

    if (this.selected?.value !== this.wireModel) {
      this.selected = this.options.find(option => option.value === this.wireModel)
    }
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
  closeIfNotFocused () {
    if (!this.$root.contains(document.activeElement) && this.popover) {
      this.close()
    }
  },
  toggle () {
    if (this.config.readonly) return

    this.popover = !this.popover

    this.$refs.input.focus()
  },
  getValue () {
    try {
      const values = this.hasWireModel
        ? this.wireModel
        : jsonParse(this.$refs.input.value)

      if (!values) return []

      return [values].flat()
    } catch (error) {
      reportError(error)

      return []
    }
  },
  getSelectedValue () {
    if (this.config.multiselect) {
      if (this.selectedOptions.length === 0) return null

      return JSON.stringify(this.selectedOptions.map(option => option.value))
    }

    return this.selected?.value ?? ''
  },
  getSelectedDisplayText () {
    if (!this.selected || this.config.multiselect) return ''
    if (this.selected.html) return this.selected.html
    if (this.selected.template) {
      const config = this.config.template.config ?? {}
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

    return this.config.placeholder ?? ''
  },
  isSelected (option) {
    if (this.config.multiselect) {
      return this.selectedOptions.some(({ value }) => value === option.value)
    }

    return option.value === this.selected?.value
  },
  select (option) {
    if (this.config.readonly || option.disabled || option.readonly) return

    this.search = ''

    if (this.config.multiselect) {
      const exists = this.selectedOptions.some(({ value }) => value === option.value)

      if (exists) return this.unSelect(option)

      this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: option }))

      option.isSelected = true

      return this.selectedOptions.push(option)
    }

    if (!this.config.clearable && this.selected?.value === option.value) {
      return this.close()
    }

    this.selected = option.value === this.selected?.value
      ? undefined
      : option

    this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: this.selected }))

    this.close()
  },
  unSelect (option) {
    if (this.config.readonly || !this.config.clearable) return

    const index = this.selectedOptions.findIndex(({ value }) => value === option.value)

    this.selectedOptions.splice(index, 1)

    option.isSelected = false

    this.$refs.input.dispatchEvent(new CustomEvent('un-selected', { detail: option }))
  },
  clear () {
    this.search = ''

    this.syncSelectedOptions()

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
      const config = this.config.template?.config ?? {}

      return templates[option.template](config).render(option)
    }

    return this.config.template.render(option)
  }
})
