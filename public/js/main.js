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

// pagination, searching, and filter select-option
document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 24;
    let productList = Array.from(document.querySelectorAll(".product_box"));
    const dropProductBtn = document.getElementById("drop_product_btn");
    const paginationContainer = document.getElementById("product_pagination");
    const prevButton = document.getElementById("prev-product");
    const nextButton = document.getElementById("next-product");
    const searchInput = document.getElementById("search_product");
    const categorySelect = document.getElementById("category_product");
    const productNotFound = document.getElementById("product_not_found");

    let currentPage = 1;
    let filteredProducts = [...productList];
    let totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

    function scrollToSearch() {
        dropProductBtn.scrollIntoView({ behavior: "auto", block: "start" });
    }

    function showProducts(page) {
        productList.forEach((item) => (item.style.display = "none"));

        let start = (page - 1) * itemsPerPage;
        let end = start + itemsPerPage;

        filteredProducts
            .slice(start, end)
            .forEach((item) => (item.style.display = "block"));

        productNotFound.classList.toggle("hidden", filteredProducts.length > 0);
    }

    function updatePagination() {
        paginationContainer.innerHTML = "";
        paginationContainer.appendChild(prevButton);

        totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
        let paginationButtons = [];

        if (totalPages <= 7) {
            for (let i = 1; i <= totalPages; i++) paginationButtons.push(i);
        } else {
            if (currentPage <= 4) {
                paginationButtons = [1, 2, 3, 4, "...", totalPages];
            } else if (currentPage >= totalPages - 3) {
                paginationButtons = [
                    1,
                    "...",
                    totalPages - 3,
                    totalPages - 2,
                    totalPages - 1,
                    totalPages,
                ];
            } else {
                paginationButtons = [
                    1,
                    "...",
                    currentPage - 1,
                    currentPage,
                    currentPage + 1,
                    "...",
                    totalPages,
                ];
            }
        }

        paginationButtons.forEach((num) => {
            let pageBtn = document.createElement("button");
            pageBtn.textContent = num;
            pageBtn.className = `p-2 mx-1 border-t border-transparent hover:border-gray-700 ${
                num === currentPage
                    ? "text-gray-800 font-bold border-t border-transparent border-gray-700 py-[11px] lg:py-3 xl:py-2.5"
                    : ""
            }`;
            if (num !== "...") {
                pageBtn.addEventListener("click", function () {
                    currentPage = num;
                    showProducts(currentPage);
                    updatePagination();
                    scrollToSearch();
                });
            } else {
                pageBtn.disabled = true;
            }
            paginationContainer.appendChild(pageBtn);
        });

        paginationContainer.appendChild(nextButton);
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages;
    }

    function filterProducts() {
        const searchValue = searchInput.value.trim().toLowerCase();
        const selectedCategory = categorySelect.value;

        filteredProducts = productList.filter((item) => {
            const matchesSearch = item.innerText
                .toLowerCase()
                .includes(searchValue);
            const matchesCategory =
                selectedCategory === "all" ||
                item.dataset.category === selectedCategory;
            return matchesSearch && matchesCategory;
        });

        currentPage = 1;
        showProducts(currentPage);
        updatePagination();
    }

    searchInput.addEventListener("input", filterProducts);
    categorySelect.addEventListener("change", filterProducts);

    prevButton.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            showProducts(currentPage);
            updatePagination();
            scrollToSearch();
        }
    });

    nextButton.addEventListener("click", function () {
        if (currentPage < totalPages) {
            currentPage++;
            showProducts(currentPage);
            updatePagination();
            scrollToSearch();
        }
    });

    showProducts(currentPage);
    updatePagination();
});
