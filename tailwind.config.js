/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'new-green': '#21A59F',
        'new-red': '#E42353',
      },
      fontFamily:{
        nunito:" 'ninoto',sans-serif ",
      }
    },
  },
  plugins: [],
}
