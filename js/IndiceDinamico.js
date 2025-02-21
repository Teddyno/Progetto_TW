function attivaSezioni(linkNavigazione, current) {
    linkNavigazione.forEach(link => {
        if (link.getAttribute("href").includes(`#${current}`)) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
}

function controllaVisibilita(sezioni, current, scroll) {
    let newCurrent = current;
    let closestSection = null;
    let minDistance = Infinity;

    sezioni.forEach((section) => {
        const sectionTop = section.offsetTop;
        const distance = Math.abs(scroll - sectionTop);

        if (distance < minDistance && scroll >= sectionTop - 300) {
            minDistance = distance;
            closestSection = section;
        }
    });

    if (closestSection) {
        newCurrent = closestSection.getAttribute("id");
    }

    return newCurrent;
}

function scrollToSection(event) {
    event.preventDefault();

    const targetId = this.getAttribute("href").substring(1);
    const targetSection = document.getElementById(targetId);

    if (targetSection) {
        const offsetTop = targetSection.offsetTop - 90; //serve per non farsi coprire dall'header
        window.scrollTo({
            top: offsetTop,
            behavior: "smooth"
        });

        current = targetId;
        attivaSezioni(linkNavigazione, current);
    }
}

const sezioni = document.querySelectorAll(".section-profilo");
const linkNavigazione = document.querySelectorAll(".indice a");

let current = "section1";

attivaSezioni(linkNavigazione, current);

linkNavigazione.forEach(link => {
    link.addEventListener("click", scrollToSection);
});

window.addEventListener("scroll", () => {
    let scroll = window.scrollY;

    if (scroll == 0) {
        current = "section1";
    } else {
        current = controllaVisibilita(sezioni, current, scroll);
    }
    attivaSezioni(linkNavigazione, current);
});