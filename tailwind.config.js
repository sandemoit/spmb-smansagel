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
            colors: {
                blue: {
                    900: '#172554',  // Dark blue for footer and headings
                },
                orange: {
                    500: '#f97316', // Primary orange for buttons and accents
                    600: '#ea580c', // Darker orange for hover states
                },
            },
            fontFamily: {
                sans: ['Figtree', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
