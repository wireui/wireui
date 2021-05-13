const colors = require('tailwindcss/colors')

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
    require('./tailwindcss/plugins/hideScrollbar'),
    require('./tailwindcss/components/toggle')
  ]
}
