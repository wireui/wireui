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
        secondary: colors.slate,
        positive: colors.emerald,
        negative: colors.red,
        warning: colors.amber,
        info: colors.blue
      },
      fontSize: {
        '3xs': '0.5rem',
        '2xs': '0.65rem'
      },
      spacing: {
        '2.2': '0.55rem',
        '3.5': '0.875rem',
        '4.5': '1.13rem',
        '5.5': '1.38rem',
        '6.5': '1.63rem',
        '9.5': '2.38rem'
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
