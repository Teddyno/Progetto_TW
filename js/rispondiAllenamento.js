function rispondiAllenamento(AllenamentoSi) {
    const messaggio = document.getElementById("messaggio-risposta");
    
    document.querySelector('.bottoni').classList.add('nascondi');
    document.getElementById("domanda").classList.add('nascondi');

    if (AllenamentoSi) {

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
}