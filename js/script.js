function ouvrirModale() {
    document.getElementById('modale').style.display = 'flex';
}

function changerFormulaire() {
    var formConnexion = document.getElementById('form-connexion');
    var formInscription = document.getElementById('form-inscription');
    var titreModale = document.getElementById('titre-modale');
    var switchForm = document.getElementById('switch-form');

    if (formConnexion.style.display === 'none') {
        formConnexion.style.display = 'block';
        formInscription.style.display = 'none';
        titreModale.textContent = 'Connexion';
        switchForm.innerHTML = 'Pas encore inscrit ? <a href="#" onclick="changerFormulaire()">Créer un compte</a>';
    } else {
        formConnexion.style.display = 'none';
        formInscription.style.display = 'block';
        titreModale.textContent = 'Inscription';
        switchForm.innerHTML = 'Déjà inscrit ? <a href="#" onclick="changerFormulaire()">Se connecter</a>';
    }
}

document.querySelector('.hamburger').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});

let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}
setInterval(nextSlide, 5000);

window.onclick = function(event) {
    if (event.target === document.getElementById('modale')) {
        fermerModale();
    }
};