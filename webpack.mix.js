const mix = require('laravel-mix')
const path = require('path')

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath('dist')
  .postCss('ts/global.css', 'dist/wireui.css', [require('tailwindcss')])
  .alias({
    '@': path.join(__dirname, 'ts'),
    '@components': path.join(__dirname, 'src/Components'),
  })
  .disableSuccessNotifications()
  .version()
