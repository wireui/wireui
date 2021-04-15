module.exports = {
  purge: [
    './ts/**/*.js',
    './resources/views/**/*.blade.php'
  ],
  darkMode: false,
  theme: {
    extend: {}
  },
  variants: {
    extend: {}
  },
  plugins: [require('@tailwindcss/forms')]
}
