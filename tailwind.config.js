const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './ts/**/*.js',
    './resources/views/**/*.blade.php',
    './src/View/**/*.php'
  ],
  darkMode: 'class',
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
      backgroundColor: ['checked'],
      borderWidth: ['dark'],
      borderColor: ['dark', 'checked'],
      divideWidth: ['dark'],
      divideColor: ['dark'],
      ringWidth: ['dark'],
      ringOffsetWidth: ['dark']
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('./tailwindcss/plugins/hideScrollbar'),
    require('./tailwindcss/components/toggle')
  ]
}
