// @ts-check - enable TS check for js file
import { defineConfig } from "windicss/helpers";
import forms from "windicss/plugin/forms";
import typography from "windicss/plugin/typography";

export default defineConfig({
    extract: {
        include: [
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
        ],
    },
    darkMode: "class", // or 'media'
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", "Graphik", "sans-serif"],
            },
        },
    },
    plugins: [forms, typography()],
});
