// --- main javascrip apufunktiot ---
// Hamburger menun toiminnallisuus
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger-menu');
    const navRight = document.querySelector('.nav-right');

    hamburger.addEventListener('click', function() {

        // Vaihdetaan 'active'-luokkaa, joka näyttää tai piilottaa valikon
        navRight.classList.toggle('active');

        // Päivitetään ARIA-attribuutti käyttöä varten
        const isExpanded = navRight.classList.contains('active');
        hamburger.setAttribute('aria-expanded', isExpanded);
    });
});