import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['Red Hat Mono', ...defaultTheme.fontFamily.mono],
                serif: ["Playwrite DE Grund", ...defaultTheme.fontFamily.serif]
            },
        },
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#111827",
                    "secondary": "#0075f0",
                    "accent": "#f97316",
                    "neutral": "#1b2a2a",
                    "base-100": "#ffffff",
                    "info": "#00b6de",
                    "success": "#00b000",
                    "warning": "#ffc900",
                    "error": "#ef4444",
                },
            },
            "dark",
            "cupcake",
        ],
    },

    plugins: [forms, typography, require('daisyui')],
};
