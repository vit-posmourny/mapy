import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                custom1: ['bevan', 'sans-serif'],
            },
            colors: {
                // Using modern `rgb`
                dark_wood: 'rgb(var(--dark-wood))',
            },
        },
    },

    plugins: [forms],
};

