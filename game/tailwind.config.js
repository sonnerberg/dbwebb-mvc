module.exports = {
  purge: {
    enabled: true,
    content: ["./view/twig/**/*.html", "./src/**/*.html", "./src/**/*.js"],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
