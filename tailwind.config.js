const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './ts/**/*.ts',
    './js/**/*.js',
    './resources/views/**/*.blade.php',
    './src/**/*.php'
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
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
      },
      keyframes: {
        'linear-progress': {
          '0%': { left: '-30%' },
          '100%': { left: '100%' }
        }
      },
      animation: {
        'linear-progress': 'linear-progress 2s linear infinite'
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms')({ strategy: 'class' }),
    require('./js/tailwindcss/plugins/hideScrollbar'),
    require('./js/tailwindcss/plugins/softScrollbar'),
    require('./js/tailwindcss/plugins/appearance-none')
  ]
}
