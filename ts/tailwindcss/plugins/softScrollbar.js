const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addUtilities }) {
  const utility = {
    '.soft-scrollbar::-webkit-scrollbar': {
      '@apply w-1 h-1 cursor-pointer': ''
    },
    '.soft-scrollbar::-webkit-scrollbar-track': {
      '@apply bg-secondary-200 cursor-pointer': ''
    },
    '.soft-scrollbar::-webkit-scrollbar-thumb': {
      '@apply bg-secondary-400 cursor-pointer': ''
    },
    '.dark .soft-scrollbar::-webkit-scrollbar-track': {
      '@apply bg-secondary-500 cursor-pointer': ''
    },
    '.dark .soft-scrollbar::-webkit-scrollbar-thumb': {
      '@apply bg-secondary-700 cursor-pointer': ''
    }
  }

  addUtilities(utility, ['dark', 'responsive'])
})
