const mix = require('laravel-mix')

mix.ts('ts/index.ts', 'dist/wireui.js')
  .setPublicPath('dist')
  .postCss('resources/css/wireui.css', 'dist', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
  ])

if (mix.inProduction()) {
  mix.version()
}
