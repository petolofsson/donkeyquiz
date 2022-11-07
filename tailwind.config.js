const plugin = require('tailwindcss/plugin')

module.exports = {
  corePlugins: {
    container: false
  },

  content: [
    './resources/js/**/*.{vue, js, ts, jsx, tsx}',
    './resources/views/**/*.php'
  ],
  safelist: [],
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1440px'
    },

    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: '#fff',
      black: '#000',

      donkeywhite: '#F5F5F5',
      donkeytext: '#000064',
      donkeydarkblue: '#202E55',
      donkeyblue: '#7678ED'
    },

    lineHeight: {
      12: '3rem',
      13: '3.20rem'
    },

    fontSize: {
      12: '0.75rem',
      14: '0.875rem',
      16: '1rem',
      20: '1.25rem',
      24: '1.5rem',
      36: '2.25rem',
      48: '3rem'
    },

    extend: {
      scale: {
        90: '.9',
        80: '.8',
        70: '.7',
        60: '.6',
      },

      animation: {
        'zoomout1': 'zoomout1 0.5s ease-in 1',
        'zoomout2': 'zoomout2 0.5s ease-in 1',
        'zoomin1': 'zoomin1 0.5s ease-in 1',
        'zoomin2': 'zoomin2 0.5s ease-in 1',
      },
      keyframes: {
        zoomout1: {
          '0%' : { transform: 'scale(1)' },
          '100%': { transform: 'scale(0)' },
        },
        zoomout2: {
          '0%' : { transform: 'scale(1)' },
          '50%': { transform: 'scale(0)' },
        },
        zoomin1: {
          '0%' : { transform: 'scale(0)' },
          '100%': { transform: 'scale(1)' },
        },
        zoomin2: {
          '0%' : { transform: 'scale(0)' },
          '50%': { transform: 'scale(1)' },
        }
 
      },

      fontFamily: {
        'poppins': ['Poppins'],
      }
    },

    plugins: [
      // ..
    ]
  }
}
