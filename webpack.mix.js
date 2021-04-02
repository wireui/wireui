const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath('dist')
  .sass('resources/scss/wireui.scss', 'dist')
  .options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')]
  })

if (mix.inProduction()) {
  mix.version()
}
