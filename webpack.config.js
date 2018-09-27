/* global module process */

let devToolType = process.env.NODE_ENV === 'dev' ? 'cheap-eval-source-map' : '';

module.exports = {
  entry: './src/js/main.js',
  output: {
    filename: './dist/js/main.bundle.js'
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        query: {
          presets: ['env']
        }
      }
    ]
  },
  devtool: devToolType
};
