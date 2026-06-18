/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.php', './components/**/*.php'],
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['Montserrat', 'sans-serif'],
      },
      backdropBlur: {
        custom: '15px',
      },
      backgroundImage: {
        'gradient-green': 'linear-gradient(to right, rgba(0, 182, 100, 1), rgba(9, 156, 86, 1))',
      },
    },
  },
  plugins: [],
};
