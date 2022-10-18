// webpack.config.js
/**
 * Webpack configuration.
 */
 const path = require( 'path' );
 const MiniCssExtractPlugin = require('mini-css-extract-plugin');
 const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
 const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
 const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
 const cssnano = require('cssnano');
 // JS Directory path.
 const JS_DIR = path.resolve( __dirname, 'theme/src/js' );
 const IMG_DIR = path.resolve( __dirname, 'theme/src/assets' );
 const FONT_DIR = path.resolve( __dirname, 'theme/assets/fonts' );
 const BUILD_DIR = path.resolve( __dirname, 'theme/dist' );
 //CSS Directory path.
 const CSS_DIR = path.resolve( __dirname, 'theme/src/css' );

 const BLOCKLIST = [

 ];
 const entry = {
     main: JS_DIR + '/head.js',
     footer: JS_DIR + '/foot.js',
     
     //I Still don't know how to do this a better way
     'blocks/cta-cards': JS_DIR + '/blocks/cta-cards.js',
     //End Blocks

     admin: JS_DIR + '/admin.js',
     admin_css: CSS_DIR + '/admin.scss',
     style: CSS_DIR + '/style.scss',
 };
 const output = {
     path: path.resolve(__dirname, BUILD_DIR),
     //path: BUILD_DIR,
     filename: 'js/[name].js'
 };
 /**
  * Note: argv.mode will return 'development' or 'production'.
  */
 const plugins = ( argv ) => [
     new CleanWebpackPlugin( {
         cleanStaleWebpackAssets: ( argv.mode === 'production' ) // Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
     } ),
     new MiniCssExtractPlugin( { 

        filename: "[name].css",

     } ),
 ];
 const rules = [
     {
         test: /\.js$/,
         include: [ JS_DIR ],
         exclude: /node_modules/,
         use: 'babel-loader'
     },
     {
         test: /\.scss$/,
         exclude: /node_modules/,
         use: [
             MiniCssExtractPlugin.loader,
             'css-loader','sass-loader',
         ]
     },
     {
         test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
         exclude: /node_modules/,
         use: {
             loader: 'file-loader',
             options: {
                 name: '[path][name].[ext]',
                 publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
             }
         }
     },
     {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg|json)$/i,
        use: 'url-loader?limit=1024'
      }
 ];
 /**
  * Since you may have to disambiguate in your webpack.config.js between development and production builds,
  * you can export a function from your webpack configuration instead of exporting an object
  *
  * @param {string} env environment ( See the environment options CLI documentation for syntax examples. https://webpack.js.org/api/cli/#environment-options )
  * @param argv options map ( This describes the options passed to webpack, with keys such as output-filename and optimize-minimize )
  * @return {{output: *, devtool: string, entry: *, optimization: {minimizer: [*, *]}, plugins: *, module: {rules: *}, externals: {jquery: string}}}
  *
  * @see https://webpack.js.org/configuration/configuration-types/#exporting-a-function
  */
 module.exports = ( env, argv ) => ({
     entry: entry,
     output: output,
     /**
      * A full SourceMap is emitted as a separate file ( e.g.  main.js.map )
      * It adds a reference comment to the bundle so development tools know where to find it.
      * set this to false if you don't need it
      */
     devtool: 'source-map',
     module: {
         rules: rules,
     },
     optimization: {
         minimizer: [
             new OptimizeCssAssetsPlugin( {
                 cssProcessor: cssnano
             } ),
             new UglifyJsPlugin( {
                 cache: false,
                 parallel: true,
                 sourceMap: false
             } )
         ]
     },
     plugins: plugins( argv ),
     externals: {
         jquery: 'jQuery'
     }
 });