export interface Icon {
  name: string
  color?: string
}

export const colors = {
  'success': 'text-green-400',
  'error': 'text-red-400',
  'info': 'text-blue-400',
  'warning': 'text-yellow-400',
  'question': 'text-gray-400'
}

export const icons = {
  'success': { name: 'check-circle', color: colors['success'] },
  'error': { name: 'exclamation', color: colors['error'] },
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
