let slideIndex = 0;
const slides = document.querySelectorAll(".slide");
const punti = document.querySelectorAll(".punto");

function slideAttiva(index) {
    slideIndex = index;

    slides.forEach((slide) => {
        slide.classList.remove("attiva");
    });

    punti.forEach((punto) => {
        punto.classList.remove("attivo");
    });

    slides[slideIndex].classList.add("attiva");
    punti[slideIndex].classList.add("attivo");

    const offset = -slideIndex * 100;
    document.querySelector(".slideshow").style.transform = `translateX(${offset}%)`;
}

function cambiaSlide(direzione) {
    slideIndex += direzione;

    if (slideIndex >= slides.length) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }

    slideAttiva(slideIndex);
}

slideAttiva(slideIndex);
avviaSlideshow();