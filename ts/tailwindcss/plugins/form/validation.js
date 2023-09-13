const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addVariant }) {
  const makeSelectors = (modifier, alias) => {
    return [
      `&[${modifier}]`,
      `[group-${alias}] &`,
      `[with-validation-colors] > div[form-wrapper] > &:has(input:${modifier})`,
      `[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) ~ &`,
      `[with-validation-colors] > div[form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}) &`,
      `[with-validation-colors] > div[form-wrapper] > div[name="form.wrapper.header"]:has(+ label[name="form.wrapper.container"] > input:${modifier}) > &`,

      `[with-validation-colors][form-wrapper] > &:has(input:${modifier}:not(:placeholder-shown))`,
      `[with-validation-colors][form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}:not(:placeholder-shown)) ~ &`,
      `[with-validation-colors][form-wrapper] > label[name="form.wrapper.container"]:has(input:${modifier}:not(:placeholder-shown)) &`,
      `[with-validation-colors][form-wrapper] > div[name="form.wrapper.header"]:has(+ label[name="form.wrapper.container"] > input:${modifier}:not(:placeholder-shown)) > &`
    ]
  }

  addVariant('invalidated', makeSelectors('invalid', 'invalidated'))
})
