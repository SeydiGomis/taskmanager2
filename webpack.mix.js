const mix = require('laravel-mix');

// Inclure Bootstrap
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

// Copie des fichiers Bootstrap depuis node_modules
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js');

// Versionning des fichiers pour le cache busting en production
if (mix.inProduction()) {
    mix.version();
}
mix.browserSync('127.0.0.1:8000');
