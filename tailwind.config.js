module.exports = {
  mode: 'jit',
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.svelte',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        c: {
          1: "#1E2A78",
          2: "#FF1F5A"
        }
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
