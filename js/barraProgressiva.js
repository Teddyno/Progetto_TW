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

switch(tipoAbbonamento) {
    case 'mensile':
        giorniTotali = 30;
        break;
    case 'trimestrale':
        giorniTotali = 120;
        break;
    case 'annuale':
        giorniTotali = 365;
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