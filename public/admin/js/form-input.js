const charactersCode = "0123456789";

// Generate string/code in id category_code
const categoryCode = document.getElementById("category_code");

function generateCodeCategory(length) {
    let string = "HEMACATEGORY";
    let result = "";
    for (let i = 0; i < length; i++) {
        result += charactersCode.charAt(
            Math.floor(Math.random() * charactersCode.length)
        );
    }
    return string + result;
}

document.addEventListener("DOMContentLoaded", function () {
    categoryCode.value = generateCodeCategory(5);
});

// Generate string/code in id faqCompany
const faqCompanyCode = document.getElementById("code_faq");

function generateCodeFaqCompany(length) {
    let string = "HEMAFAQ";
    let result = "";
    for (let i = 0; i < length; i++) {
        result += charactersCode.charAt(
            Math.floor(Math.random() * charactersCode.length)
        );
    }
    return string + result;
}

document.addEventListener("DOMContentLoaded", function () {
    faqCompanyCode.value = generateCodeFaqCompany(5);
});

// Generate string/code in id galleryCompanyCode
const galleryCompanyCode = document.getElementById("code_gallery");

function generateCodeGalleryCompany(length) {
    let string = "HEMAGALLERY";
    let result = "";
    for (let i = 0; i < length; i++) {
        result += charactersCode.charAt(
            Math.floor(Math.random() * charactersCode.length)
        );
    }
    return string + result;
}

document.addEventListener("DOMContentLoaded", function () {
    galleryCompanyCode.value = generateCodeGalleryCompany(5);
});

// upload file
function updateFileName() {
    const input = document.getElementById("file_drop");
    const fileNameDisplay = document.getElementById("file-name");

    if (input.files.length > 0) {
        fileNameDisplay.textContent = "File: " + input.files[0].name;
    } else {
        fileNameDisplay.textContent = "Drag and drop a file to upload";
    }
}
