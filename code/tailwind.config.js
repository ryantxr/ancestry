const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/*.blade.php',
    ],
    safelist: [
        'hidden','xs:hidden','sm:hidden','md:hidden','lg:hidden','xl:hidden',
        'block','xs:block','sm:block','md:block','lg:block','xl:block',
        'inline','xs:inline','sm:inline','md:inline','lg:inline','xl:inline',
        'inline-block',
        {
            pattern: /^m[trblxy]?-[0-9]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        'mx-auto',
        {
            pattern: /^p[trblxy]?-[0-9]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^space-[xy]-[0-9]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^w-[0-9]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^min-w-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^max-w-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^bg-(red|green|blue|yellow|gray|orange|teal|cyan|sky|indigo|violet|purple|pink|rose)-([0-9]+)$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^text-(red|green|blue|yellow|gray|orange|teal|cyan|sky|indigo|violet|purple|pink|rose)-([0-9]+)$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^font-[a-z]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        {
            pattern: /^text-[0-9a-z]+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        'flex',
        {
            pattern: /^flex-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        'grid',
        {
            pattern: /^grid-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        'border',
        {
            pattern: /^border-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        },
        'rounded',
        {
            pattern: /^rounded-.+$/,
            variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl', '3xl']
        }
    ],
    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            red: colors.red,
            blue: colors.blue,
            green: colors.green,
            gray: colors.gray,
            emerald: colors.emerald,
            indigo: colors.indigo,
            yellow: colors.yellow,
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
