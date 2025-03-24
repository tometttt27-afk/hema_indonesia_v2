import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#b17457",
                secondary: "#c29470",
            },
        },
        screens: {
            sm: "340px",
            md: "540px",
            lg: "768px",
            xl: "1180px",
        },
        fontFamily: {
            urbanist: ["Urbanist", "sans-serif"],
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "12px",
                sm: "9px",
                md: "16px",
            },
        },
    },
    plugins: [],
};
