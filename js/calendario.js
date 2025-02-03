let oggi = new Date();
let meseCorrente = oggi.getMonth();
let annoCorrente = oggi.getFullYear();
let allenamenti = {};

function creaCalendario() {
    const meseAnno = document.getElementById("mese-anno");
    const giorni = document.getElementById("giorni");
    giorni.innerHTML = "";

    let primoGiorno = new Date(annoCorrente, meseCorrente, 1).getDay();
    let ultimoGiorno = new Date(annoCorrente, meseCorrente + 1, 0).getDate();

    meseAnno.textContent = new Date(annoCorrente, meseCorrente).toLocaleDateString("it-IT", { month: "long", year: "numeric" });

    for(let i = 0; i < primoGiorno; i++) {
        let giornoVuoto = document.createElement("div");
        giornoVuoto.classList.add("fade");
        giorni.appendChild(giornoVuoto);
    }

    for(let i = 1; i <= ultimoGiorno; i++) {
        let giornoPieno = document.createElement("div");
        giornoPieno.textContent = i;
        let si = `${annoCorrente}-${meseCorrente + 1}-${i}`;
        if (allenamenti[si]) {
            giornoPieno.classList.add("allenato");
        }
        giorni.appendChild(giornoPieno);
    }
}

function cambiaMese(index) {
    meseCorrente += index;
    if(meseCorrente < 0) {
        meseCorrente = 11;
        annoCorrente--;
    } else if(meseCorrente > 11) {
        meseCorrente = 0;
        annoCorrente++;
    }  
    creaCalendario();
}

function rispondiAllenamento(AllenamentoSi) {
    const messaggio = document.getElementById("messaggio-risposta");
    
    document.querySelector('.bottoni').classList.add('nascondi');
    document.getElementById("domanda").classList.add('nascondi');

    if (AllenamentoSi) {
        let si = `${oggi.getFullYear()}-${oggi.getMonth() + 1}-${oggi.getDate()}`;
        allenamenti[si] = true;

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
creaCalendario();