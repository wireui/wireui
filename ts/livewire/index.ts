export type WireModifiers = {
  live: boolean
  blur: boolean
  debounce: {
    exists: boolean
    delay: number
  }
  throttle: {
    exists: boolean
    delay: number
  }
}

export type WireModel = {
  exists: boolean
  livewireId: string
  name: string
  modifiers: WireModifiers
}

export type LivewireComponent = {
  el: HTMLElement
  id: string
  name: string
  effects: any
  canonical: any
  ephemeral: any
  reactive: any
  $wire: $Wire
  children: any
  snapshot: Snapshot
  snapshotEncoded: string

  watch(name: string, callback: (value: any, old: any) => void): void
  get(name: string): any
  set(name: string, value: any, live?: boolean): any
}

export type Livewire = {
  find: (id: string) => LivewireComponent|null
  dispatch: (event: string, params?: any) => void
  dispatchTo: (name: string, event: string, params?: any) => void
  on: (event: string, callback: (params?: any) => void) => void
  hook: (
    event: string,
    callback: (params: { component: LivewireComponent, succeed: CallableFunction }) => void
  ) => void
  directive: (name: string, callback: (params: any) => void) => void
  start: () => void
  rescan: () => void
  stop: () => void
}

export type $Wire = {
  $parent: LivewireComponent

  $get(name: string): any
  $set(name: string, value: any, live?: boolean): any
  $toggle(name: string, live?: boolean): void
  $call(method: string, ...params: any): any
  $entangle(name: string, live?: boolean): any
  $watch(name: string, callback: (value: any, old: any) => void): void
  $refresh(): void
  $commit(): void
  $on(event: string, callback: (params: any) => void): void
  $dispatch(event: string, params?: any): void
  $dispatchTo(name: string, event: string, params?: any): void
  $dispatchSelf(event: string, params?: any): void
  $upload(
    name: string,
    file: File,
    finish?: () => void,
    error?: () => void,
    progress?: (event: { detail: { progress: number } }) => void
  ): void
  $uploadMultiple(
    name: string,
    files: File[],
    finish?: () => void,
    error?: () => void,
    progress?: (event: { detail: { progress: number } }) => void
  ): void
  $removeUpload(
    name: string,
    tmpFilename: string,
    finish?: () => void,
    error?: () => void
  ): void
  __instance(): LivewireComponent
}

export type Snapshot = {
  data: any
  memo: {
    id: string
    name: string
    path: string
    method: 'GET'|'POST'
    locale: string
    children: any[]
    lazyLoaded: boolean
    errors: any[]
  }
  checksum: string
}

export type Commit = {
  snapshot: Snapshot
  updates: { [index: string]: any }
  calls: { method: string, params: any }[]
}
