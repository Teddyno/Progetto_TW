let ultimaPos = 0;
const header = document.querySelector(".header");

window.addEventListener("scroll", () => {
    const posizione = window.scrollY;

    if (posizione > ultimaPos && posizione - ultimaPos >= 10) {
        header.classList.add("nascosto");
    } else if(posizione < ultimaPos && ultimaPos - posizione >=10){
        header.classList.remove("nascosto");
    }

    ultimaPos = posizione;
});

function openCart() { 
    let cart = document.getElementById("carrello");
    if (cart.style.display != "none")
        cart.style.display = "none";
    else{
        cart.style.display = "block";
    }
}