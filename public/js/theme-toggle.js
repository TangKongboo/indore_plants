document.addEventListener('DOMContentLoaded', function() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    const themeIcon = document.getElementById('theme-icon');
    
    // Check local storage for preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        htmlElement.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);
    }
    
    if(themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            let currentTheme = htmlElement.getAttribute('data-theme');
            let newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });
    }
    
    function updateIcon(theme) {
        if(!themeIcon) return;
        if(theme === 'light') {
            themeIcon.classList.remove('fa-sun', 'text-warning');
            themeIcon.classList.add('fa-moon', 'text-dark');
        } else {
            themeIcon.classList.remove('fa-moon', 'text-dark');
            themeIcon.classList.add('fa-sun', 'text-warning');
        }
    }
});
