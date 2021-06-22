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
      },
      fontSize: {
        '2xs': '.5rem'
      }
    }
  },
  variants: {
    extend: {
      opacity: ['disabled']
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('./tailwindcss/plugins/hideScrollbar'),
    require('./tailwindcss/components/toggle')
  ]
}
