<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light"; // Set the default theme
    var themeMode;

    // Check if documentElement exists
    if (document.documentElement) {
        // Check if a theme mode is specified in the document
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            // Check if a theme mode is stored in localStorage
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        // If theme mode is set to system, check system preferences
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        // Set the theme mode attribute
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->
