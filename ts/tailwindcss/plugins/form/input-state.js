const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addVariant }) {
  const make = selector => [`label[name="form.wrapper.container"]:has(${selector}) &`]

  addVariant('input-hover', make('input:hover'))
  addVariant('input-focus', make('input:focus'))
  addVariant('input-interaction', make('input:hover, input:focus'))
})
