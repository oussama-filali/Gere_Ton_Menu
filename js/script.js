// Gestion de la modale
function ouvrirModale() {
    document.getElementById('modale').style.display = 'flex';
}

function fermerModale() {
    document.getElementById('modale').style.display = 'none';
}

// Basculer entre formulaires
function changerFormulaire() {
    const connexion = document.getElementById('form-connexion');
    const inscription = document.getElementById('form-inscription');
    const titre = document.getElementById('titre-modale');
    const lien = document.querySelector('#switch-form a');

    if (connexion.style.display === 'none') {
        connexion.style.display = 'block';
        inscription.style.display = 'none';
        titre.textContent = 'Connexion';
        lien.textContent = 'Créer un compte';
    } else {
        connexion.style.display = 'none';
        inscription.style.display = 'block';
        titre.textContent = 'Inscription';
        lien.textContent = 'Se connecter';
    }
}

// Menu hamburger
document.querySelector('.hamburger').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});

// Slider automatique
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');


function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}
setInterval(nextSlide, 5000);

// Fermeture modale au clic externe
window.onclick = function(event) {
    if (event.target === document.getElementById('modale')) {
        fermerModale();
    }
};