document.addEventListener('DOMContentLoaded', (event) => {
    let boutton = document.getElementById('boutton_bascule');
    let tableau = document.getElementById('first');
    let graphique = document.getElementById('second');

    boutton.addEventListener('click', function () {
        if (graphique.style.display === 'none') {
            graphique.style.display = 'flex';
            tableau.style.display = 'none';
        } else {
            graphique.style.display = 'none';
            tableau.style.display = 'flex';
        }
    });
});