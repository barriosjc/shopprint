const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                'process.env': {
                    STRIPE_KEY: JSON.stringify(process.env.STRIPE_KEY),
                    // Add other environment variables here as needed
                },
            }),
        ],
    });