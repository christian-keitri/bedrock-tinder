/** @type {import('tailwindcss').Config} */
module.exports = {
  theme: {
    colors: {
      primary: '#34bfa3',
      white: '#ffffff',
      hintColor: '#575962',
      sidebarGray: '#282a3c',
      selectedDarkGray: '#191b26',
      resetButton: '#2b8be9',
      resetButtonHover: '#1173d6',
      borderColor: '#ebedf2',
      borderFocusedColor: '#2b8be9',
      hoverBackgroundColor: '#2ca189',
      hoverBorderColor: '#299781',
      hoverBoxShadow: '0 5px 10px 2px rgba(52, 191, 163, 0.36)',
      linkColor: '#2b8be9',
      linkHoverColor: '#5f57c3',
      subHeaderColor: {
        grayLevel1: '#f3f4f6',
        grayLevel2: '#6b7280',
        grayLevel3: '#4b5563',
        grayLevel4: '#374151',
        labelColor: '#262626',
        backGround: '#FFFFFF',
        spanColor: '#737373',
        iconDefaultColor: '#4b5563',
        iconFocusedColor: '#1e40af',
      },
      mainPageBgColor: '#f3f4f6',
      bordersGray: {
        1: "#e5e7eb", //200
        2: "#9ca3af", //400
        3: "#4b5563", //600
        4: "#1f2937", //800
        5: "#111827", //900
      },
      actionButtonsColor: {
        edit: "#1976D2",
        delete: "#D32F2F",
        option: "#6B7280",
        preview: "#818589"
      },
      tableLabelColors: {
        active: {
          bg: "#D1FAE5",
          text: "#065F46"
        },
        inactive: {
          bg: "#FEF3C7",  // Similar to bg-yellow-200
          text: "#92400E"     // Similar to text-yellow-800
        },
        deleted: {
          bg: "#FEE2E2",
          text: "#7F1D1D"
        },
      }

    },
    extend: {
      fontFamily: {
        'primary': ['Monsterrat', 'sans-serif'],
        'secondary': ['Roboto', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
