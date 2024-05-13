/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
  darkMode: 'class',
  content: ["index.php","registration.php","loginpg.php","mainpage.html", "game.php", "./src/input.css", "./src/output.css"],
  theme: {
    extend: {},
    colors: {
      // Build your palette here
      transparent: 'transparent',
      current: 'currentColor',
      neutral: colors.neutral, // truegray
      stone: colors.stone, //warmgray
      slate: colors.slate, //bluegreeeeshhdsuhfsais
      white: colors.white,
      black: colors.black,
      gray: colors.gray,
      zinc: colors.zinc,
      orange: colors.orange,
      red: colors.red,
      blue: colors.sky,
      yellow: colors.amber,
    }
    
  },
  plugins: [
    require('@tailwindcss/forms')
  ]
};
