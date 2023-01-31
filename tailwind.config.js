const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './src/**/*.{html,js}',
        './node_modules/tw-elements/dist/css/**/*.css',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],

    plugins: [
        require('tw-elements/dist/plugin'),
        require('@tailwindcss/forms')
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
 
}