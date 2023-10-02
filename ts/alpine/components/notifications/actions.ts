import { ConfirmationOptions } from './options'
import { LivewireOptions, LivewireDispatchOptions, parseLivewire, parseLivewireDispatch, parseRedirect } from './parses'

export interface Action {
  label: string
  style?: string
  solid?: boolean
  execute: CallableFunction
}

export interface ActionOptions extends Omit<Action, 'execute'> {
  method?: string
  dispatch?: string
  to?: string
  params?: any
  url?: string
  execute?: CallableFunction
}

export type Actions = {
  accept: Action
  reject: Action
}

export const parseAction = (options: ActionOptions, componentId?: string): CallableFunction => {
  if (options?.url) return parseRedirect(options.url)
  if (options?.method && componentId) return parseLivewire({ ...options, id: componentId } as LivewireOptions)
  if (options?.dispatch) return parseLivewireDispatch({ ...options } as LivewireDispatchOptions)

  return () => null
}

const getActionLabel = (
  options: ConfirmationOptions,
  action: ActionOptions,
  actionName: string
): string => {
  const defaultLabels = { accept: 'Confirm', reject: 'Cancel' }

  return action?.label
    ?? options[`${actionName}Label`]
    ?? defaultLabels[actionName]
}

export const parseActions = (options: ConfirmationOptions, componentId?: string): Actions => {
  if (options.method) {
    options.accept = Object.assign({
      method: options.method,
      params: options.params
    }, options.accept)
  }
  if (options.dispatch) {
    options.accept = Object.assign({
      dispatch: options.dispatch,
      to: options.to,
      params: options.params
    }, options.accept)
  }

  return Object.assign({}, ...['accept', 'reject'].map(actionName => {
    const action = Object.assign({}, options[actionName]) as ActionOptions
    action.label = getActionLabel(options, action, actionName)

    if (!action.execute) {
      action.execute = parseAction(action, componentId)
    }

    return { [actionName]: action }
  }))
}
