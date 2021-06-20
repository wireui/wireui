export interface WireUiHooks {
  hook (hook: string, callback: CallableFunction): void,
  dispatchHook (hook: string): void
}

