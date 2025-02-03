let dataCorrente = new Date();
let giorniAllenamento = new Set();

function creaCalendario() {
    const meseAnno = document.getElementById("mese-anno");
    const giorni = document.getElementById("giorni-calendario");

    const mese = dataCorrente.getMonth();
    const anno = dataCorrente.getFullYear();

    meseAnno.textContent = `${dataCorrente.toLocaleString('it-IT', { month: 'long' })} ${anno}`;
    giorni.innerHTML = "";

    const primoGiorno = new Date(anno, mese, 1);
    const ultimoGiorno = new Date(anno, mese + 1, 0);

    const giornoInizio = primoGiorno.getDay();

    for(let i = 0; i < giornoInizio; i++) {
        const giornoVuoto = document.createElement("div");
        giornoVuoto.classList.add("giorno", "disabilitato");
        giorni.appendChild(giornoVuoto);
    }

    for(let giorno = 1; giorno <= ultimoGiorno.getDate(); giorno++) {
        const giornoPieno = document.createElement("div");
        giornoPieno.classList.add("giorno");
        giornoPieno.textContent = giorno;

        const dataGiorno = `${anno}-${mese + 1}-${giorno}`;
        if(giorniAllenamento.has(dataGiorno)) {
            giornoPieno.classList.add("allenato");
        }

        giorni.appendChild(giornoPieno);
    }
}

function cambiaMese(direzione) {
    dataCorrente.setMonth(dataCorrente.getMonth() + direzione);
    creaCalendario();
}

function rispondiAllenamento(AllenamentoSi) {
    const messaggio = document.getElementById("messaggio-risposta");
    
    document.querySelector('.bottoni').classList.add('nascondi');
    document.getElementById("domanda").classList.add('nascondi');

    if (AllenamentoSi) {
        const oggi = new Date();
        const dataOggi = `${oggi.getFullYear()}-${oggi.getMonth() + 1}-${oggi.getDate()}`;
        giorniAllenamento.add(dataOggi);

        const frasiMotivazionali = [
            "Grande! Continua così, sei sulla strada giusta! 🚀",
            "Ogni allenamento ti avvicina al tuo obiettivo! 🔥",
            "Sei una bestia! Non fermarti! 🦾",
            "Il tuo futuro io ti ringrazierà! 💯",
            "Il lavoro di oggi è il successo di domani. 🔥",
            "Ogni allenamento è una vittoria su te stesso. 🏅",
            "I risultati arrivano con costanza e impegno. ⏳",
            "Il sacrificio di oggi porta ricompense domani. 🎯",
            "La tua determinazione ti porterà lontano! 🚀",
            "Non mollare mai! Il successo è dietro l'angolo! 💪"
        ];
        messaggio.innerText = frasiMotivazionali[Math.floor(Math.random() * frasiMotivazionali.length)];
        messaggio.style.color = "green";
    } else {
        messaggio.innerText = "Dai, è il momento di muoversi! Il tuo corpo te ne sarà grato! 🏋️‍♂️";
        messaggio.style.color = "red";
    }
    messaggio.classList.add('show-message');
    creaCalendario();
}

window.onload = creaCalendario;