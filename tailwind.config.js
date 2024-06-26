/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily : {
        "inter" : 'inter',
        "circular" : 'Circular STD',
      },
      colors : {
        "purple" : '#5D50C6',
        "pink" : '#F85E9F',
        "orange" : '#FF5722',
        "grey" : '#222831',
      },
      dropShadow : {
        "sm-shadow" : [
          '0px 548px 219px rgba(0, 0, 0, 0.01)',
          '0px 308px 185px rgba(0, 0, 0, 0.04)',
          '0px 137px 137px rgba(0, 0, 0, 0.06)',
          '0px 34px 75px rgba(0, 0, 0, 0.07)',
          '0px 0px 0px rgba(0, 0, 0, 0.07)'
        ],
        "lg-shadow" : [
          '0px 81px 32px rgba(0, 0, 0, 0.01)',
          '0px 45px 27px rgba(0, 0, 0, 0.05)',
          '0px 20px 20px rgba(0, 0, 0, 0.09)',
          '0px 5px 11px rgba(0, 0, 0, 0.1)',
          '0px 0px 0px rgba(0, 0, 0, 0.1)'
        ],
        "xl-shadow" : [
          '0px 41px 89px rgba(0, 0, 0, 0.1)',
          '0px 0px 0px rgba(0, 0, 0, 0.1)'
        ],
        "md-shadow" : [
          '0px 19px 19px rgba(0, 0, 0, 0.09)', 
          '0px 43px 26px rgba(0, 0, 0, 0.05)', 
          '0px 77px 31px rgba(0, 0, 0, 0.01)', 
          '0px 120px 34px rgba(0, 0, 0, 0)'
        ]
      }
    },
  },
  plugins: [],
}

