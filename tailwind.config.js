/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#2A5EDC",
                primaryContent: "#D4DFF8",
                text: "#212122",
                danger: "#F41E21",
            },
            boxShadow: {
                custom: "0 0 4px rgba(0, 0, 0, 0.2)",
            },
        },
    },
    // plugins: [require("daisyui")],
};
