/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/**/*.js",
    "./node_modules/**/*.css"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
}