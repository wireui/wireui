export interface WireUiHooks {
  cache: any
  hook (hook: string, callback: CallableFunction): void,
  dispatchHook (hook: string): void
}
