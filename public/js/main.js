// swiper hero
var swiper = new Swiper(".mySwiperHero", {
    loop: true,
    slidesPerView: "auto",
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

// sticky navbar
window.addEventListener("scroll", function () {
    var navSticky = document.querySelector("#navbar");
    navSticky.classList.toggle("sticky-navbar", this.window.scrollY > 0);
});

// sticky scroll up
window.addEventListener("scroll", function () {
    var scrollUpBox = document.querySelector(".scroll_up_box");

    if (window.scrollY > 0) {
        scrollUpBox.classList.remove("hidden");
        scrollUpBox.classList.add("flex");
    } else {
        scrollUpBox.classList.remove("flex");
        scrollUpBox.classList.add("hidden");
    }
});

// magic grid
document.addEventListener("DOMContentLoaded", function () {
    let magicGrid = new MagicGrid({
        container: "#content_gallery",
        animate: true,
        gutter: 10,
        static: true,
        useMin: true,
    });
    magicGrid.listen();
});
