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

function openCart() { //refactoring name in toggle prima o poi
    let cart = document.getElementById("carrello");
    if (cart.style.display != "none")
        cart.style.display = "none";
    else{
        cart.style.display = "flex";}
}