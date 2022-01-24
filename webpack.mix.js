const mix = require('laravel-mix')

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath('dist')
  .postCss('resources/css/wireui.css', 'dist', [require('tailwindcss')])

if (mix.inProduction()) {
  mix.version()
}

mix.disableSuccessNotifications()
