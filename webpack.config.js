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


 const entry = {
     main: JS_DIR + '/head.js',
     footer: JS_DIR + '/foot.js',
     
     //I Still don't know how to do this a better way
     'blocks/imagetext-twocol': JS_DIR + '/blocks/imagetext-twocol.js',
     'blocks/numbered-step': JS_DIR + '/blocks/numbered-step.js',
     'blocks/numbered-steps': JS_DIR + '/blocks/numbered-steps.js',
     'blocks/icon-card': JS_DIR + '/blocks/icon-card.js',
     'blocks/icon-cards': JS_DIR + '/blocks/icon-cards.js',
     'blocks/info-card': JS_DIR + '/blocks/info-card.js',
     'blocks/info-cards': JS_DIR + '/blocks/info-cards.js',
     'blocks/square-card': JS_DIR + '/blocks/square-card.js',
     'blocks/square-cards': JS_DIR + '/blocks/square-cards.js',
     'blocks/complex-card': JS_DIR + '/blocks/complex-card.js',
     'blocks/review-stars': JS_DIR + '/blocks/review-stars.js',
     'blocks/faq': JS_DIR + '/blocks/faq.js',
     'blocks/review-cards': JS_DIR + '/blocks/review-cards.js',
     'blocks/contactus': JS_DIR + '/blocks/contactus.js',
     'blocks/four-square': JS_DIR + '/blocks/four-square.js',
     'blocks/four-square-left': JS_DIR + '/blocks/four-square-left.js',
     'blocks/four-square-right': JS_DIR + '/blocks/four-square-right.js',
     'blocks/branded-content': JS_DIR + '/blocks/branded-content.js',
     /* components */
     'blocks/checklist': JS_DIR + '/blocks/checklist.js',
     'blocks/accordion': JS_DIR + '/blocks/accordion.js',
     'blocks/accordions': JS_DIR + '/blocks/accordions.js',
     'blocks/review': JS_DIR + '/blocks/review.js',
     'blocks/beyond-headlinetag': JS_DIR + '/blocks/beyond-headlinetag.js',
     //End Blocks

     critical: CSS_DIR + '/critical.scss',
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
        // test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
         test: /\.(woff|woff2|eot|ttf)$/,
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
       // test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        test: /\.(jpg|jpeg|png|gif|webp|svg|ico)$/i,
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