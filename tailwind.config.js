const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: [
    './ts/**/*.js',
    './resources/views/**/*.blade.php',
    './src/View/**/*.php'
  ],
  darkMode: false,
  theme: {
    extend: {
      colors: {
        blueGray: colors.blueGray
      }
    }
  },
  variants: {
    extend: {}
  },
  plugins: [
    require('@tailwindcss/forms'),
    plugin(function ({ addUtilities }) {
      const newUtilities = {
        '.hide-scrollbar::-webkit-scrollbar': {
          'display': 'none'
        },
        '.hide-scrollbar': {
          '-ms-overflow-style': 'none',
          'scrollbar-width': 'none'
        }
      }

      addUtilities(newUtilities, ['responsive'])
    })
  ]
}
