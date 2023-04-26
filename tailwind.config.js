/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'lightPink': '#E42353',
        'thisGreen': '#21A59F',
      },
    },
  },
  plugins: [],
}
