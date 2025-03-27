// pagination, searching, and filter select-option
document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 30;
    let productList = Array.from(document.querySelectorAll(".product_box"));
    const upProductBtn = document.getElementById("hero");
    const paginationContainer = document.getElementById("product_pagination");
    const prevButton = document.getElementById("prev-product");
    const nextButton = document.getElementById("next-product");
    const searchInput = document.getElementById("search_product");
    const categorySelect = document.getElementById("category_product");
    const productNotFound = document.getElementById("product_not_found");
    const mainProductPagination = document.getElementById(
        "main_product_pagination"
    );

    let currentPage = 1;
    let filteredProducts = [...productList];
    let totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

    function scrollToSearch() {
        upProductBtn.scrollIntoView({ behavior: "auto", block: "start" });
    }

    function showProducts(page) {
        productList.forEach((item) => (item.style.display = "none"));

        let start = (page - 1) * itemsPerPage;
        let end = start + itemsPerPage;

        const displayedProducts = filteredProducts.slice(start, end);

        displayedProducts.forEach((item) => (item.style.display = "block"));

        productNotFound.classList.toggle("hidden", filteredProducts.length > 0);
        mainProductPagination.classList.toggle(
            "hidden",
            filteredProducts.length === 0 || displayedProducts.length === 0
        );
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
            pageBtn.type = "button";
            pageBtn.id = "numPagination";
            pageBtn.textContent = num;
            pageBtn.className = `p-2 mx-1 border-t border-transparent hover:border-gray-700 relative`;

            if (num === currentPage) {
                pageBtn.classList.add("active");
            }

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
