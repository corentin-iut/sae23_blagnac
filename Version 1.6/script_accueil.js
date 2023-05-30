document.querySelector('.nav-links ul li:nth-child(3) a').addEventListener('click', function (event) {
    event.preventDefault();
    var banner = document.getElementById('tempBanner');
    banner.classList.toggle('show');
});

/* -> Sélectionne le lien consultation
   -> écouteur d'évènement au lien
   -> empêche l'action par défaut d'un lien (va à l'URL)
   -> récupère l'élément tempBanner
   -> lui ajoute la classe .show ou on l'enlève (mode bascule) 
   -> pour effet de faire apparaître le bandeau
*/