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
        blueGray: colors.blueGray,
        primary: colors.indigo,
        secondary: colors.gray,
        positive: colors.emerald,
        negative: colors.red,
        warning: colors.amber,
        info: colors.blue
      },
      fontSize: {
        '2xs': '.5rem'
      }
    }
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      cursor: ['disabled'],
      pointerEvents: ['disabled'],
      borderWidth: ['dark'],
      borderColor: ['dark'],
      divideWidth: ['dark'],
      divideColor: ['dark']
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('./tailwindcss/plugins/hideScrollbar'),
    require('./tailwindcss/components/toggle')
  ]
}
