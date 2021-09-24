const mix = require('laravel-mix')

mix.js('js/app.testing.js', 'dist/testing').setPublicPath('dist/testing')
