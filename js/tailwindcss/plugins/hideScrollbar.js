const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addUtilities }) {
  const utility = {
    '.hide-scrollbar::-webkit-scrollbar': {
      'display': 'none'
    },
    '.hide-scrollbar': {
      '-ms-overflow-style': 'none',
      'scrollbar-width': 'none'
    }
  }

  addUtilities(utility, ['responsive'])
})
