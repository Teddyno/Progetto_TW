const btnModifica = document.getElementById('btn-modifica');
const formModifica = document.getElementById('form-modifica');
const visualizzaDati = document.getElementById('visualizza-dati');
const btnAnnulla = document.getElementById('btn-annulla');

btnModifica.addEventListener('click', () => {
    visualizzaDati.style.display ='none';
    formModifica.style.display = 'grid';
    btnModifica.style.display = 'none';
});

btnAnnulla.addEventListener('click', () => {
    visualizzaDati.style.display ='grid'; 
    formModifica.style.display = 'none'; 
    btnModifica.style.display = 'block';
});