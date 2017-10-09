const path = require('path');
const webpack = require('webpack');
module.exports = {
  context: path.resolve(__dirname, './js'),
  resolve: {
    alias: {}
  },
  plugins: [
       new webpack.ProvidePlugin({
           $: "jquery",
           jQuery: "jquery",
           "window.jQuery": "jquery"
       })
   ],
  entry: {
    scripts:  './scripts.js',
  },
  output: {
    path: path.resolve(__dirname, './js/min'),
    filename: '[name].bundle.js',
  },
};
