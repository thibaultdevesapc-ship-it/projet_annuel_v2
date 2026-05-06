document.addEventListener('DOMContentLoaded', function() {
    const connexionBtn = document.getElementById('header-connexion-btn');
    const connexionMenu = document.getElementById('header-connexion-menu');

    // Ouvrir le menu
    if (connexionBtn) {
        connexionBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            connexionMenu.classList.toggle('active');
        });
    }

    // Fermer le menu si on clique à côté
    document.addEventListener('click', function(e) {
        if (connexionMenu && !connexionMenu.contains(e.target) && e.target !== connexionBtn) {
            connexionMenu.classList.remove('active');
        }
    });
});