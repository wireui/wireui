import { LivewireOptions, parseLivewire, parseRedirect } from '../notifications/parses'
import { EventOptions, Events } from '../notifications/events'
import { Options } from './options'

export const parseEvent = (options: EventOptions, componentId?: string): CallableFunction => {
  if (options?.url) return parseRedirect(options.url)
  if (options?.method && componentId) return parseLivewire({ ...options, id: componentId } as LivewireOptions)
  if (options?.dispatch) {
    return () => {
      window.Livewire.dispatch(options.dispatch, options.params)
    }
  }

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
