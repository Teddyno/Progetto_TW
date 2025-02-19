function barraProgressiva(giorniRestanti, giorniTotali){
    let percentuale = (giorniRestanti / giorniTotali) * 100;
    
    let barraProgressiva = document.getElementById('barra-progressiva');
    let testoBarra = document.getElementById('testo-barra');

    
    barraProgressiva.style.width = percentuale + '%';
    testoBarra.textContent = 'Giorni restanti: ' + giorniRestanti;

    if(percentuale>50){
        barraProgressiva.style.backgroundColor = 'green';
    } else if(percentuale>25){
        barraProgressiva.style.backgroundColor = 'orange';
    } else {
        barraProgressiva.style.backgroundColor = 'red';
    }
}

let giorniTotali = 0;

switch(tipoAbbonamento) {
    case 'mensile':
        giorniTotali = 30;
        break;
    case 'annuale':
        giorniTotali = 365;
        break;
    case 'trimestrale':
        giorniTotali = 120;
        break;
    default:
        giorniTotali = 0;
  }

    let giorniRestanti = 3;
    barraProgressiva(giorniRestanti, giorniTotali);