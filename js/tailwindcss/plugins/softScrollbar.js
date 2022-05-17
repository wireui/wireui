const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addUtilities }) {
  const utility = {
    '.soft-scrollbar::-webkit-scrollbar': {
      'width': '4px',
      'height': '4px',
      'cursor': 'pointer'
    },
    '.soft-scrollbar::-webkit-scrollbar-track': {
      'background-color': '#e2e8f0',
      'cursor': 'pointer'
    },
    '.soft-scrollbar::-webkit-scrollbar-thumb': {
      'cursor': 'pointer',
      'background-color': '#94a3b8'
    },
    '.dark .soft-scrollbar::-webkit-scrollbar-track': {
      'background-color': '#475569',
      'cursor': 'pointer'
    },
    '.dark .soft-scrollbar::-webkit-scrollbar-thumb': {
      'cursor': 'pointer',
      'background-color': '#334155'
    }
  }

  addUtilities(utility, ['dark', 'responsive'])
})
