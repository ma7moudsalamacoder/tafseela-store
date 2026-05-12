import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './Modules/**/*.blade.php',
        './Modules/**/*.js',
        './Modules/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                "primary": "#A67C52",
                "primary-dark": "#7D5A39",
                "accent-gold": "#A67C52",
                "background-light": "#FDFCFB",
                "background-dark": "#121212",
                "neutral-charcoal": "#1A1A1A",
                "neutral-beige": "#F7F3F0",
            },
            fontFamily: {
                "display": ["Almarai", "sans-serif"],
                "body": ["IBM Plex Sans Arabic", "sans-serif"]
            },
            borderRadius: {
                "DEFAULT": "0px", 
                "lg": "0px", 
                "xl": "0px", 
                "full": "9999px"
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries'),
    ],
};
