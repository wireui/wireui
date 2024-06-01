const mix = require('laravel-mix')
const path = require('path')

const buildPath = mix.inProduction() ? 'dist' : 'dist/dev'

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath(buildPath)
  .postCss('ts/global.css', 'dist/wireui.css', [require('tailwindcss')])
  .alias({
    '@': path.join(__dirname, 'ts')
  })
  .disableSuccessNotifications()
  .version()
