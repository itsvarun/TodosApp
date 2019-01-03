var path = require('path')
var webpack = require('webpack')

module.exports = {
    entry: './resources/js/app.js',

    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: 'app.js',
        publicPath: './public'
    },

    resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    },
    extensions: ['*', '.js', '.vue', '.json']
  },
  mode: "development"
};
