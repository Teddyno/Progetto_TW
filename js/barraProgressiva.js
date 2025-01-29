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
    
    const giorniTotali = 60;
    const giorniRestanti = 45;
    barraProgressiva(giorniRestanti, giorniTotali);