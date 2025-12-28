<!-- Dark Mode Toggle Button -->
<button 
    id="darkModeToggle" 
    class="p-2 sm:p-2.5 bg-white/10 hover:bg-white/20 dark:bg-gray-700/50 dark:hover:bg-gray-600/50 backdrop-blur-sm rounded-lg sm:rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-purple-500/20 flex-shrink-0 group"
    aria-label="Toggle Dark Mode"
>
    <!-- Sun Icon (Visible in Dark Mode) -->
    <svg 
        id="sunIcon" 
        class="w-5 h-5 text-yellow-400 transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 hidden dark:block" 
        fill="currentColor" 
        viewBox="0 0 24 24"
    >
        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
    </svg>
    
    <!-- Moon Icon (Visible in Light Mode) -->
    <svg 
        id="moonIcon" 
        class="w-5 h-5 text-blue-300 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110 block dark:hidden" 
        fill="currentColor" 
        viewBox="0 0 24 24"
    >
        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
    </svg>
</button>

<script>
    // Dark Mode Toggle Functionality
    (function() {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        
        // Check for saved dark mode preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        
        // Apply the theme
        if (currentTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Toggle dark mode
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            
            // Save preference
            const newTheme = html.classList.contains('dark') ? 'dark' : 'light';
            localStorage.setItem('theme', newTheme);
            
            // Add a nice transition effect
            darkModeToggle.style.transform = 'scale(0.9)';
            setTimeout(() => {
                darkModeToggle.style.transform = 'scale(1)';
            }, 150);
        });
    })();
</script>

<style>
    /* Smooth transition for dark mode toggle */
    #darkModeToggle {
        transition: transform 0.15s ease, background-color 0.3s ease;
    }
    
    /* Ensure icons transition smoothly */
    #sunIcon, #moonIcon {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
</style>
