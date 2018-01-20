// const ExtractTextPlugin = require('extract-text-webpack-plugin');
// const path = require('path');

// module.exports = {
// 	entry: {
// 		'main': './resource/js/view/general.js',
// 		'function': './resource/js/view/function.js'
// 	},
// 	output: {
// 		path: path.resolve(__dirname, 'resource/dist/js/'),
// 		filename: '[name].js'
// 	},
// 	module: {
// 		rules: [
// 			{
// 				test: /\.js$/,
// 				exclude: /(node_modules|bower_components)/,
// 				use: {
// 					loader: 'babel-loader'
// 				}
// 			},
// 			{
// 				test: /\.(scss|css)$/,
// 				use: ExtractTextPlugin.extract({
// 					fallback: 'style-loader',
// 					use: ['css-loader', 'postcss-loader', 'sass-loader', 'resolve-url-loader']
// 				})
// 			},
// 			{
// 				test: /\.(png|jpg|gif)$/,
// 				use: {
// 					loader: 'file-loader',
// 					options: {
// 						name: '[path][name].[ext]'
// 					}
// 				}
// 			}
// 		]
// 	},
// 	plugins: [
// 		new ExtractTextPlugin('[name].css')
// 	]
// };