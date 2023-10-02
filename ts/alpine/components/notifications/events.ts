import { Options } from './options'
import { LivewireOptions, LivewireDispatchOptions, parseLivewire, parseLivewireDispatch, parseRedirect } from './parses'

export type Events = {
  onTimeout: CallableFunction
  onDismiss: CallableFunction
  onClose: CallableFunction
}

export interface EventOptions {
  method?: string
  dispatch?: string
  to?: string
  params?: any
  url?: string
}

export const parseEvent = (options: EventOptions, componentId?: string): CallableFunction => {
  if (options?.url) return parseRedirect(options.url)
  if (options?.method && componentId) return parseLivewire({ ...options, id: componentId } as LivewireOptions)
  if (options?.dispatch) return parseLivewireDispatch({ ...options } as LivewireDispatchOptions)

  return () => null
}

export const events = ['onClose', 'onTimeout', 'onDismiss']

export const parseEvents = (options: Options, componentId?: string): Events => {
  return Object.assign({}, ...events.map(eventName => {
    const event = options[eventName] as EventOptions

    if (typeof event === 'function') {
      return { [eventName]: event }
    }

    return { [eventName]: parseEvent(event, componentId) }
  }))
}
