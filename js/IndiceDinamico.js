const sezioni = document.querySelectorAll(".section-profilo");
const linkNavigazione = document.querySelectorAll(".indice a");
let current = "section1";


function attivaSezioni(linkNavigazione, current) {
    linkNavigazione.forEach(link => {
        const container = link.querySelector(".container-indice");
        if (link.getAttribute("href").includes(`#${current}`)) {
            container.classList.add("active");
        } else {
            container.classList.remove("active");
        }
    });
}

function controllaVisibilita(sezioni, current, scroll) {
    let newCurrent = current;
    let sezioneVicina = null;
    let minimo = Infinity;

    sezioni.forEach((section) => {
        const sezioneTop = section.offsetTop-350;
        const distanza = Math.abs(scroll - sezioneTop);

        if (distanza < minimo && scroll >= sezioneTop) {
            minimo = distanza;
            sezioneVicina = section;
        }
    });

    if (sezioneVicina && sezioneVicina !== current) {
        newCurrent = sezioneVicina.getAttribute("id");
    }

    return newCurrent;
}

function scrollToSection(event) {
    event.preventDefault();

    const targetId = this.getAttribute("href").substring(1);
    const targetSezione = document.getElementById(targetId);

    if (targetSezione) {
        const distanzaTop = targetSezione.offsetTop - 80; //serve per non farsi coprire dall'header
        window.scrollTo({
            top: distanzaTop,
            behavior: "smooth"
        });

        current = targetId;
        attivaSezioni(linkNavigazione, current);
    }
}

attivaSezioni(linkNavigazione, current);

linkNavigazione.forEach(link => {
    link.addEventListener("click", scrollToSection);
    
});

window.addEventListener("scroll", () => {
    const scroll = window.scrollY;
    if (scroll == 0) {
        current = "section1";
    } else {
        current = controllaVisibilita(sezioni, current, scroll);
    }
    attivaSezioni(linkNavigazione, current);
});