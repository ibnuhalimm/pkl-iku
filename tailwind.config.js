const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',

    purge: {
        content: [
            './app/Http/Controllers/**/*.php',
            './resources/views/**/*.blade.php'
        ]
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'iku-primary': '#017eff',
                'iku-secondary': '#126e82',
                'iku-dark': '#132c33',
                'iku-gray': '#d8e3e7'
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },
};
