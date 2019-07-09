const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ConcatPlugin = require('webpack-concat-plugin');
const {
	CleanWebpackPlugin
} = require('clean-webpack-plugin');

module.exports = {
	entry: ["./src/scss/style.scss"],
	module: {
		rules: [{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["babel-preset-env"]
					}
				}
			},
			{
				test: /\.(sass|scss)$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"]
			}
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "./build/style.min.[hash:8].css"
		}),
		new ConcatPlugin({
			uglify: true,
			sourceMap: false,
			outputPath: './build/',
			fileName: 'app.min.[hash:8].js',
			filesToConcat: ['./src/js/**'],
			attributes: {
				async: true
			}
		}),
		new CleanWebpackPlugin({
			cleanOnceBeforeBuildPatterns: ['/build/*']
		})
	],
};