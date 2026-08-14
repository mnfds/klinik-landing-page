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
          DEFAULT: '#1B5D36',
          light: '#4A6B9A',
          dark: '#2eb363',
        },
        blush: '#D7E6FF',
        gold: '#2ce372',
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