const btnModifica = document.getElementById('btn-modifica');
const formModifica = document.getElementById('form-modifica');
const visualizzaDati = document.getElementById('visualizza-dati');
const btnAnnulla = document.getElementById('btn-annulla');
const btnModificaSic = document.getElementById('btn-modifica-sicurezza');
const visualizzaSicurezza = document.getElementById('visualizza-sicurezza');
const formModificaSicurezza = document.getElementById('form-modifica-sicurezza');
const btnAnnullaSic = document.getElementById('btn-annulla-sicurezza');
const btnElimina = document.getElementById('bottone-elimina');
const popup = document.getElementById('conferma-password-popup');
const annullaConfermaBtn = document.getElementById('annulla-conferma');

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

btnModificaSic.addEventListener('click', () => {
    visualizzaSicurezza.style.display ='none';
    formModificaSicurezza.style.display = 'grid';
    btnModificaSic.style.display = 'none';
});

btnAnnullaSic.addEventListener('click', () => {
    visualizzaSicurezza.style.display ='grid'; 
    formModificaSicurezza.style.display = 'none'; 
    btnModificaSic.style.display = 'block';
});

// Gestione del popup per la conferma della password
btnElimina.addEventListener('click', () => {
    popup.style.display = 'block';
});

annullaConfermaBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === popup) {
        popup.style.display = 'none';
    }
});
