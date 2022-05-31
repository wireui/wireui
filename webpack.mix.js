const mix = require('laravel-mix')
const path = require('path')

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath('dist')
  .postCss('resources/css/wireui.css', 'dist', [require('tailwindcss')])
  .alias({
    '@': path.join(__dirname, 'ts')
  })

if (mix.inProduction()) {
  mix.version()
}

mix.disableSuccessNotifications()
