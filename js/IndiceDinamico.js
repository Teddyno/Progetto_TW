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
        const sectionTop = section.offsetTop; /* la distanza tra la section e il parent in pixel, in questo caso la distanza con il confine superiore della pagina*/

        if (scroll >= sectionTop - 100 ) {
            current = section.getAttribute("id");
        }
    });
    return current;
}

const sezioni = document.querySelectorAll(".section-profilo");
const linkNavigazione = document.querySelectorAll(".indice a");

let current = "section1";
attivaSezioni(linkNavigazione, current);

window.addEventListener("scroll", () => {
    let scroll = window.scrollY;
    if (scroll == 0) {
        current = "section1";
    } else {
        current = controllaVisibilita(sezioni, current, scroll);
    }

    attivaSezioni(linkNavigazione, current);
});
