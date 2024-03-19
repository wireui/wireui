import { watchProps } from '@/alpine/magic/props'
import { notify } from '@/notifications'
import dataGet from '@/utils/dataGet'
import { jsonParse } from '@/utils/helpers'
import { stringify } from 'qs'
import { templates } from './templates'
import baseTemplate from './templates/baseTemplate'
import { AsyncData, Config, Option, Options, Props } from './types'
import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { AlpineComponent } from '@/components/alpine2'
import { Focusable } from '@/alpine/modules/Focusable'
import Positionable from '@/alpine/modules/Positionable'

export default class Select extends AlpineComponent {
  declare $refs: {
    popover: HTMLElement
    search?: HTMLInputElement
    input: HTMLInputElement
    json: HTMLElement
    slot: HTMLElement
    optionsContainer: HTMLElement
    listing: HTMLElement
    container: HTMLElement
  }

  declare $props: Props

  asyncData: AsyncData = {
    api: null,
    method: 'GET',
    optionsPath: null,
    fetching: false,
    params: {},
    alwaysFetch: false
  }

  config: Config = {
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
  }

  search: string|null = ''

  entangleable = new Entangleable()

  positionable: Positionable = new Positionable()

  focusable: Focusable = new Focusable()

  selected?: Option = undefined

  selectedOptions: Option[] = []

  displayOptions: Option[] = []

  options: Option[] = []

  get hasWireModel (): boolean {
    return this.$props.wireModel.exists
  }

  init (): void {
    this.initWatchers()
    this.syncProps()

    this.positionable
      .start(this, this.$refs.container, this.$refs.popover)
      .position('bottom')

    this.focusable.start(this.$refs.optionsContainer, 'div[tabindex="0"][select-option], input')

    watchProps(this, this.syncProps.bind(this))

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    new SupportsAlpine(this.entangleable, this.$refs.input)

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
  }

  initRenderObserver (): void {
    const config: IntersectionObserverInit = {
      root: this.$refs.optionsContainer,
      rootMargin: '20px',
      threshold: 0.9
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
  }

  initWatchers (): void {
    this.positionable.watch((state: boolean) => {
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

      if (this.asyncData.api && this.asyncData.alwaysFetch && !state) {
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
  }

  initDeferredWatchers (): void {
    this.$watch('asyncData.api', () => (this.options = []))
    this.$watch('asyncData.optionsPath', () => (this.options = []))
    this.$watch('asyncData.params', () => (this.options = []))
    this.$watch('asyncData.method', () => (this.options = []))
  }

  initWireModel (): void {
    this.syncSelectedFromWireModel()

    if (this.config.multiselect) {
      this.$watch('selectedOptions', (options: Options, oldOptions: Options) => {
        if (this.mustSyncWireModel()) {
          this.entangleable.set(options.map((option: Option) => option.value))
        }

        if (JSON.stringify(options) !== JSON.stringify(oldOptions)) {
          this.syncSelectedOptions()
        }
      })

      this.entangleable.watch((options: any[]) => {
        if (!Array.isArray(options)) {
          throw new Error('The wire:model value must be an array to use the select as multiselect')
        }

        if (this.mustSyncWireModel()) {
          this.asyncData.api
            ? this.fetchSelected()
            : this.syncSelectedFromWireModel()
        }
      })

      if (this.entangleable.get()?.length > 0 && this.asyncData.api) {
        this.fetchSelected()
      }

      return
    }

    this.$watch('selected', (option?: Option, oldOption?: Option) => {
      this.entangleable.set(option?.value ?? null)

      if (oldOption?.value !== option?.value) {
        this.syncSelectedOptions()
      }
    })

    this.entangleable.watch(value => {
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

    if (this.entangleable.get() && this.asyncData.api) {
      this.fetchSelected()
    }
  }

  initOptionsObserver (): void {
    this.syncJsonOptions()

    const observer = new MutationObserver(this.syncJsonOptions.bind(this))

    observer.observe(this.$refs.json, {
      subtree: true,
      characterData: true
    })

    this.$destroy(() => observer.disconnect())
  }

  initSlotObserver (): void {
    this.syncSlotOptions()

    const element = this.$refs.slot
    const observer = new MutationObserver(this.syncSlotOptions.bind(this))

    observer.observe(element, {
      characterData: true,
      childList: true,
      subtree: true
    })
  }

  shouldSyncProps (mutations: MutationRecord[] = []): boolean {
    return mutations.some(mutation => {
      return mutation.attributeName === 'x-props'
    })
  }

  syncProps (mutations: MutationRecord[] = []): void {
    if (mutations.length && !this.shouldSyncProps(mutations)) return

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
  }

  syncJsonOptions (): void {
    this.setOptions(window.Alpine.evaluate(this, this.$refs.json.innerText))

    if (this.hasWireModel) {
      this.syncSelectedFromWireModel()
    }
  }

  syncSlotOptions (): void {
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
  }

  makeRequest (params = {}): Request {
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
  }

  fetchOptions (): void {
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
  }

  fetchSelected (): void {
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
  }

  mapOption (rawOption: Record<string, any>): Option {
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
  }

  setOptions (options: Option[]): void {
    this.options = options

    this.syncSelectedOptions()
  }

  syncSelectedOptions (): void {
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
  }

  fillSelectedFromInputValue (): void {
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

      if (this.selected) {
        this.selected.isSelected = true
      }

      return
    }

    try {
      this.selectedOptions = jsonParse(inputValue, []).map((value: any) => {
        // eslint-disable-next-line eqeqeq
        const selected = this.options.find(option => option.value == value)

        if (selected) {
          selected.isSelected = true
        }

        return selected
      })
    } catch (error) {
      this.selectedOptions = []
      reportError(error)
    }
  }

  syncSelectedFromWireModel (): void {
    if (this.config.multiselect) {
      if (this.entangleable.get() && !Array.isArray(this.entangleable.get())) {
        this.entangleable.set([this.entangleable.get()])
      }

      return (this.selectedOptions = this.entangleable.get().flatMap((value: any) => {
        const original = this.selectedOptions.find(option => option.value === value)

        if (original) return original

        const option = this.options.find(option => option.value === value);

        if (!option) return [];

        option.isSelected = true;

        return option;
      }))
    }

    if (this.selected?.value !== this.entangleable.get()) {
      this.selected = this.options.find(option => option.value === this.entangleable.get())

      if (this.selected) {
        this.selected.isSelected = true
      }
    }
  }

  mustSyncWireModel (): boolean {
    return this.entangleable.get()?.toString() !== this.selectedOptions.map(option => option.value).toString()
  }

  searchOptions (search: string): Option[] {
    return this.options.filter(option => {
      const label = option.label.toLocaleLowerCase()

      return label.includes(search)
    })
  }

  closeIfNotFocused (): void {
    if (!this.$root.contains(document.activeElement) && this.positionable.state) {
      this.positionable.close()
    }
  }

  toggle (): void {
    if (this.config.readonly) return

    this.positionable.toggle()

    this.$refs.input.focus()
  }

  getValue (): any[] {
    try {
      const values = this.hasWireModel
        ? this.entangleable.get()
        : jsonParse(this.$refs.input.value)

      if (!values) return []

      return [values].flat()
    } catch (error) {
      reportError(error)

      return []
    }
  }

  getSelectedValue (): any {
    if (this.config.multiselect) {
      if (this.selectedOptions.length === 0) return null

      return JSON.stringify(this.selectedOptions.map(option => option.value))
    }

    return this.selected?.value ?? ''
  }

  getSelectedDisplayText (): string {
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
  }

  getPlaceholder (): string {
    if (this.config.multiselect && this.selectedOptions.length > 0) return ''

    return this.config.placeholder ?? ''
  }

  isSelected (option: Option): boolean {
    if (this.config.multiselect) {
      return this.selectedOptions.some(({ value }) => value === option.value)
    }

    return option.value === this.selected?.value
  }

  select (option: Option): void {
    if (this.config.readonly || option.disabled || option.readonly) return

    this.search = ''

    if (this.config.multiselect) {
      const exists = this.selectedOptions.some(({ value }) => value === option.value)

      if (exists) return this.unSelect(option)

      this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: option }))

      option.isSelected = true

      this.selectedOptions.push(option)

      return
    }

    if (!this.config.clearable && this.selected?.value === option.value) {
      return this.positionable.close()
    }

    this.selected = option.value === this.selected?.value
      ? undefined
      : option

    this.$refs.input.dispatchEvent(new CustomEvent('selected', { detail: this.selected }))

    this.positionable.close()
  }

  unSelect (option: Option): void {
    if (this.config.readonly || !this.config.clearable) return

    const index = this.selectedOptions.findIndex(({ value }) => value === option.value)

    this.selectedOptions.splice(index, 1)

    option.isSelected = false

    this.$refs.input.dispatchEvent(new CustomEvent('un-selected', { detail: option }))
  }

  clear (): void {
    this.search = ''

    this.syncSelectedOptions()

    this.config.multiselect
      ? this.selectedOptions = []
      : this.selected = undefined

    this.$refs.input.dispatchEvent(new Event('clear'))
  }

  isEmpty (): boolean {
    if (this.config.multiselect) {
      return this.selectedOptions.length === 0
    }

    return this.selected === undefined
  }

  renderOption (option: Option): string {
    if (option.html) {
      return baseTemplate(option.html)
    }

    if (option.template) {
      const config = this.config.template?.config ?? {}

      return templates[option.template](config).render(option)
    }

    return this.config.template.render(option)
  }
}
