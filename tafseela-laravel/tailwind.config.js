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
    theme: {
        extend: {
            colors: {
                primary: '#A67C52',
                'primary-dark': '#7D5A39',
                'accent-gold': '#A67C52',
                charcoal: '#1A1A1A',
                'neutral-charcoal': '#1A1A1A',
                'warm-white': '#FDFCFB',
                'background-light': '#FDFCFB',
                'background-dark': '#121212',
                'neutral-beige': '#F7F3F0',
                surface: '#fff8f5',
                'surface-dim': '#e1d8d3',
                'on-surface': '#1f1b17',
                'success-green': '#2D6A4F',
            },
            fontFamily: {
                sans: ['"IBM Plex Sans Arabic"', 'sans-serif'],
                body: ['"IBM Plex Sans Arabic"', 'sans-serif'],
                almarai: ['Almarai', 'sans-serif'],
                display: ['Almarai', 'sans-serif'],
            },
            spacing: {
                'section': '8rem',
                'gutter': '2rem',
                'stack-sm': '0.5rem',
                'stack-md': '1.5rem',
                'stack-lg': '3rem',
            },
            borderRadius: {
                'none': '0px',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries'),
    ],
};
