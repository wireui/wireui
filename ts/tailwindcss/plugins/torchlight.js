const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addUtilities }) {
  addUtilities({
    '.torchlight > pre': {
      '@apply rounded-lg overflow-x-auto soft-scrollbar': ''
    },
    '.torchlight > pre code.torchlight': {
      'background-color': '#27272A !important',
      '@apply block py-6 min-w-max text-sm space-y-2': ''
    },
    '.torchlight > pre code.torchlight .line': {
      '@apply px-6': ''
    },
    '.torchlight > pre code.torchlight .line-number, pre code.torchlight .summary-caret': {
      '@apply mr-4': ''
    }
  })
})
