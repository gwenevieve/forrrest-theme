const path = require("path");
const UglifyJSPlugin = require("uglifyjs-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const ConcatPlugin = require('webpack-concat-plugin');
const {
	CleanWebpackPlugin
} = require('clean-webpack-plugin');

module.exports = {
	entry: ["./src/js/app.js", "./src/scss/style.scss"],
	output: {
		path: path.resolve(__dirname)
	},
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
			filename: "./dist/style.min.[hash:8].css"
		}),
		new CleanWebpackPlugin({
			cleanOnceBeforeBuildPatterns: ['./dist/*']
		}),
		new ConcatPlugin({
			uglify: true,
			sourceMap: false,
			name: 'app',
			outputPath: '/dist/',
			fileName: '[name].min.[hash:8].js',
			filesToConcat: ['./src/js/**'],
			attributes: {
				async: true
			}
		})
	],
	optimization: {
		minimizer: [
			new UglifyJSPlugin({
				cache: true,
				parallel: true
			}),
			new OptimizeCSSAssetsPlugin({})
		]
	},
};