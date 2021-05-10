const { colors } = require('tailwindcss/defaultTheme');
const defaultTheme = require('tailwindcss/defaultTheme');
//#5978c7
module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                black: colors.black,
                white: colors.white,
                gray: colors.trueGray,
                indigo: colors.indigo,
                red: colors.rose,
                yellow: colors.amber,
                gold: "#E8B933",
                silver: "#C0C0C0",
                bronze: "#CD7F32",
                manhua: "#D19E40",
                manhwa: "#34CB5B",
                manga: "#7DCFF8",
                oneShot: "#F1875C",
                novela: "#EC83B4",
                ourBlue: "#5978c7",
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
