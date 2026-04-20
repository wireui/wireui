const path = require('path');
const webpack = require('./node_modules/webpack');

module.exports = {
  entry: './ts/index.ts',
  mode: 'production',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'wireui.js',
    library: {
      type: 'window',
    },
  },
  resolve: {
    extensions: ['.ts', '.js'],
    alias: {
      '@': path.resolve(__dirname, 'ts'),
    },
  },
  module: {
    rules: [{
      test: /\.tsx?$/,
      use: {
        loader: './node_modules/ts-loader',
        options: {
          transpileOnly: true,
        },
      },
      exclude: /node_modules/,
    }, ],
  },
};
