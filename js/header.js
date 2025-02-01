let ultimaPos = 0;
const header = document.querySelector(".header");

window.addEventListener("scroll", () => {
    const posizione = window.scrollY;

    if (posizione > ultimaPos) {
        header.classList.add("nascosto");
    } else {
        header.classList.remove("nascosto");
    }

    ultimaPos = posizione;
});