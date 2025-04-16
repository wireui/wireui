export interface Icon {
  name: string
  color?: string
}

export const colors = {
  'success': 'text-positive-500',
  'error': 'text-negative-500',
  'info': 'text-info-500',
  'warning': 'text-warning-500',
  'question': 'text-secondary-500'
}

export const icons = {
  'success': { name: 'check-circle', color: colors['success'] },
  'error': { name: 'exclamation-triangle', color: colors['error'] },
  'info': { name: 'information-circle', color: colors['info'] },
  'warning': { name: 'exclamation-circle', color: colors['warning'] },
  'question': { name: 'question-mark-circle', color: colors['question'] }
}

export const parseIcon = (options: Icon): Icon => {
  if (icons[options.name]) {
    const { name, color } = icons[options.name] as Icon
    options.name = name
    if (!options.color) { options.color = color }
  }

  return options
}
