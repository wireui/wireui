const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addVariant }) {
  const makeSelectors = (modifier, alias) => {
    return [
      `&[${modifier}]`,
      `[group-${alias}] &`,
      `form[with-validation-colors] &:${modifier}`,
      `form[with-validation-colors] > div[form-wrapper] > &:has(input:${modifier})`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) ~ &`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) &`,
      `form[with-validation-colors] > div[form-wrapper] > div[name="form.wrapper.header"]:has(+ label[name="form.wrapper.container"] > input:${modifier}) > &`
    ]
  }

  addVariant('invalidated', makeSelectors('invalid', 'invalidated'))
  addVariant('validated', makeSelectors('valid', 'validated'))
})
