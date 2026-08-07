/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Livewire/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        ivory: '#F2F4FA',
        forest: {
          DEFAULT: '#218ce3',
          light: '#4A6B9A',
          dark: '#125E9C',
        },
        blush: '#D7E6FF',
        gold: '#3BA8F5',
        charcoal: '#273244',
      },
      fontFamily: {
        display: ['Fraunces', 'serif'],
        sans: ['Manrope', 'sans-serif'],
        contax: ['Contax Sans', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}