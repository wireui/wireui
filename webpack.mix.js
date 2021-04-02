const mix = require('laravel-mix')

mix.ts('ts/index.ts', 'dist/wireui.js').setPublicPath('dist')

if (mix.inProduction()) {
  mix.version()
}
