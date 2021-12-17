const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    './ts/**/*.js',
    './resources/views/**/*.blade.php',
    './src/View/**/*.php'
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        slate: colors.slate,
        primary: colors.indigo,
        secondary: colors.gray,
        positive: colors.emerald,
        negative: colors.red,
        warning: colors.amber,
        info: colors.blue
      },
      fontSize: {
        '2xs': '.5rem'
      },
      spacing: {
        '4.5': '1.13rem'
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms')({
      strategy: 'class'
    }),
    require('./tailwindcss/plugins/hideScrollbar')
  ]
}
