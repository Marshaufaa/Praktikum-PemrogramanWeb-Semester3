const DARK_MODE_CLASS = 'dark-mode';

function addDarkModeToggle() {
    const toggleButton = document.createElement('button');
    toggleButton.id = 'dark-mode-toggle';
    toggleButton.textContent = 'Toggle Dark Mode 🌙';
    toggleButton.style.padding = '10px 20px';
    toggleButton.style.margin = '10px auto'; 
    toggleButton.style.display = 'block'; 
    toggleButton.style.backgroundColor = '#444';
    toggleButton.style.color = '#fff';
    toggleButton.style.border = 'none';
    toggleButton.style.borderRadius = '5px';
    toggleButton.style.cursor = 'pointer';
    toggleButton.style.transition = 'background-color 0.3s ease';

    const body = document.body;
    if (body) {
        body.insertBefore(toggleButton, body.firstChild); // Memasukkan tombol sebagai elemen pertama di body
    }
    return toggleButton;
}

// ini fungsi utama buat nyalain dark mode
function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle(DARK_MODE_CLASS);

    const isDarkMode = body.classList.contains(DARK_MODE_CLASS);
    localStorage.setItem('darkMode', isDarkMode);

    const toggleButton = document.getElementById('dark-mode-toggle');
    if (toggleButton) {
        toggleButton.textContent = isDarkMode ? 'Toggle Light Mode ☀️' : 'Toggle Dark Mode 🌙';
    }
}

function loadDarkModePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    const body = document.body;
    const toggleButton = document.getElementById('dark-mode-toggle');

    if (isDarkMode) {
        body.classList.add(DARK_MODE_CLASS);
        if (toggleButton) {
            toggleButton.textContent = 'Toggle Light Mode ☀️';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = addDarkModeToggle();
    loadDarkModePreference();

    if (toggleButton) {
        toggleButton.addEventListener('click', toggleDarkMode);
    }
});