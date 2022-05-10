import { parseRedirect, parseLivewire, LivewireOptions } from '../notifications/parses'
import { ConfirmationOptions } from './options'

const colors = ['primary', 'secondary', 'positive', 'negative', 'warning', 'info', 'dark']
export type Size = 'xs' | 'md' | 'lg'
export type Color = typeof colors[number]

export interface ButtonOptions {
  label?: string
  color?: Color
  size?: Size
  rounded?: boolean
  squared?: boolean
  bordered?: boolean
  flat?: boolean
  icon?: string
  rightIcon?: string
}

export interface Action extends ButtonOptions {
  label: string
  execute: CallableFunction
}

export interface ActionOptions extends ButtonOptions {
  method?: string
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

export const iconsMap = {
  question: 'primary',
  success: 'positive',
  error: 'negative'
}

export const parseActions = (options: ConfirmationOptions, componentId?: string): Actions => {
  if (options.method) {
    options.accept = Object.assign({
      method: options.method,
      params: options.params
    }, options.accept)
  }

  return Object.assign({}, ...['accept', 'reject', 'close'].map(actionName => {
    const action = Object.assign({}, options[actionName]) as ActionOptions
    action.label = getActionLabel(options, action, actionName)

    if (!action.execute) {
      action.execute = parseAction(action, componentId)
    }

    if (
      actionName === 'accept'
      && !action.color
      && typeof options.icon === 'string'
      && ['success', 'error', 'info', 'warning', 'question'].includes(options.icon)
    ) {
      action.color = iconsMap[options.icon] ?? options.icon
    }

    if (actionName === 'accept' && !action.color) {
      action.color = 'primary'
    }

    return { [actionName]: action }
  }))
}
