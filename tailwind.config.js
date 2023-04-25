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
      },
      fontFamily:{
        nunito:" 'ninoto',sans-serif ",
      }
    },
  },
  plugins: [],
}
