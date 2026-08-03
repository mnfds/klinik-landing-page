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
        ivory: '#FBF7F1',
        forest: {
          DEFAULT: '#2C4433',
          light: '#3F5F49',
          dark: '#1E2E23',
        },
        blush: '#E8C7BF',
        gold: '#B98A4D',
        charcoal: '#2A2622',
      },
      fontFamily: {
        display: ['Fraunces', 'serif'],
        sans: ['Manrope', 'sans-serif'],
      },
    },
  },
  plugins: [],
}