/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'paint-blue': "url('/public/img/blue.png')",
        'paint-red': "url('/public/img/red.png')",

      },
      colors: {
        'new-green': '#21A59F',
        'new-red': '#E42353',
        'lightPink': '#E42353',
        'thisGreen': '#21A59F',
      },
      fontFamily:{
        nunito:" 'ninoto',sans-serif ",
      }
    },
  },
  plugins: [],
}
