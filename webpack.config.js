const path = require('path');

module.exports = {
  entry: {
     admin: './assets/js/admin.js',
     public: './assets/js/public.js',
  },
  output: {
    filename: '[name].min.js',
    path: path.resolve(__dirname, 'assets/js')
  },
  module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['babel-preset-env']
            }
          }
        }
      ]
    }
};