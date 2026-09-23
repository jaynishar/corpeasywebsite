/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./*.js", "./js/**/*.js"],
  theme: {
    extend: {
      fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
      colors: {
        brand: {
          blue: '#1e3a8a',
          electric: '#6366f1',
          navy: '#f0f9ff',
          cyan: '#06b6d4',
          gold: '#fbbf24',
          rose: '#f43f5e',
          violet: '#8b5cf6',
          slate: '#64748b',
          ice: '#ffffff',
          amber: '#f59e0b',
          emerald: '#10b981'
        }
      }
    }
  },
  plugins: []
}
