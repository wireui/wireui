export interface WireUiConfig {
  cache: { [index: string]: any }
  hook (hook: string, callback: CallableFunction): void,
  dispatchHook (hook: string): void
}
