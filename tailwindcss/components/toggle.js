const plugin = require('tailwindcss/plugin')

module.exports = plugin(function ({ addComponents }) {
  const component = {
    '.form-toggle': {
      '@apply focus:outline-none cursor-pointer relative': {}
    },
    '.form-toggle-background': {
      '@apply transition-all ease-in-out duration-200 rounded-full shadow-inner bg-gray-200': {}
    },
    '.form-toggle-circle': {
      '@apply transition-all ease-in-out duration-200 absolute my-auto bg-white rounded-full inset-y-0': {}
    },
    '.form-toggle input:checked ~ .form-toggle-background': {
      '@apply bg-blue-600': {}
    },
    '.form-toggle:focus .form-toggle-background': {
      '@apply ring-2 ring-offset-2 ring-indigo-500': {}
    },
    '.form-toggle input:checked ~ .form-toggle-circle': {
      '@apply transform translate-x-full': {}
    }
  }

  addComponents(component)
})
