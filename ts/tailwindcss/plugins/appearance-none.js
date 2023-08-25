const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addUtilities }) {
  addUtilities({
    'input.appearance-number-none::-webkit-outer-spin-button': {
      '-webkit-appearance': 'none',
      '@apply m-0': ''
    },
    'input.appearance-number-none::-webkit-inner-spin-button': {
      '-webkit-appearance': 'none',
      '@apply m-0': ''
    },
    'input[type="number"].appearance-number-none': {
      '-moz-appearance': 'textfield'
    }
  })
})
