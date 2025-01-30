function attivaSezioni(linkNavigazione, current) {
    linkNavigazione.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href").includes(current)) {
            link.classList.add("active");
        }
    });
}

function controllaVisibilita(sezioni, current, scroll) {
    sezioni.forEach((section) => {
        const sectionTop = section.offsetTop;

        if (scroll >= sectionTop - 100 ) {
            current = section.getAttribute("id");
        }
    });
    return current;
}

const sezioni = document.querySelectorAll(".section-profilo");
const linkNavigazione = document.querySelectorAll(".indice a");

let current = "section1";

window.addEventListener("scroll", () => {
    let scroll = window.scrollY;
    if (scroll == 0) {
        current = "section1";
    } else {
        current = controllaVisibilita(sezioni, current, scroll);
    }

    attivaSezioni(linkNavigazione, current);
});
