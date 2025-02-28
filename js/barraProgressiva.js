function barraProgressiva(giorniRestanti, giorniTotali){
    let percentuale = (giorniRestanti / giorniTotali) * 100;
    
    let barraProgressiva = document.getElementById('barra-progressiva');
    let testoBarra = document.getElementById('testo-barra');

    
    barraProgressiva.style.width = percentuale + '%';
    if(percentuale>50){
        barraProgressiva.style.backgroundColor = 'green';
        testoBarra.textContent = 'Giorni restanti: ' + giorniRestanti;

    } else if(percentuale>25){
        barraProgressiva.style.backgroundColor = 'orange';
        testoBarra.textContent = 'Giorni restanti: ' + giorniRestanti;

    } else if(percentuale>0){
        barraProgressiva.style.backgroundColor = 'red';
        testoBarra.textContent = 'Giorni restanti: ' + giorniRestanti;
    } else {
        barraProgressiva.style.backgroundColor = 'black';
        testoBarra.textContent = 'Abbonamento scaduto';
    }
}

let giorniTotali = 0;

if (tipoAbbonamento !== 'undefined') {
    tipoAbbonamento = '';
  }

switch(tipoAbbonamento) {
    case 'annuale':
    case 'Annuale':
        giorniTotali = 365;
        break;
    case 'semestrale':
    case 'Semestrale':
        giorniTotali = 180;
        break;
    case 'trimestrale':
    case 'Trimestrale':
        giorniTotali = 90;
        break;
    case 'mensile':
    case 'Mensile':
        giorniTotali = 30;
        break;
    default:
        giorniTotali = 0;
    }

// data attuale e data scadenza in secondi
let dataAttuale =new Date().getTime();
let dataScadenzaSec = new Date(dataScadenza).getTime();

//                       differenza tra le due date in secondi,   poi faccio la conversione in giorni
let giorniRestanti = Math.floor((dataScadenzaSec - dataAttuale) / (1000 * 60 * 60 * 24));

barraProgressiva(giorniRestanti, giorniTotali);