const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addVariant }) {
  const makeSelectors = (modifier, alias) => {
    return [
      `&[${modifier}]`,
      `[group-${alias}] &`,
      `form[with-validation-colors] &:${modifier}`,
      `form[with-validation-colors] > div[form-wrapper] > &:has(input:${modifier})`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) ~ &[name="form.wrapper.description"]`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) &[name="form.wrapper.container.prefix"]`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) &[name="form.wrapper.container.suffix"]`,
      `form[with-validation-colors] > div[form-wrapper] > div[name="form.wrapper.header"]:has(+ label[name="form.wrapper.container"] > input:${modifier}) > &`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) > div[name="form.wrapper.container.prepend"] &:is(button, a)`,
      `form[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) > div[name="form.wrapper.container.append"] &:is(button, a)`
    ]
  }

  addVariant('invalidated', makeSelectors('invalid', 'invalidated'))
  addVariant('validated', makeSelectors('valid', 'validated'))
})
