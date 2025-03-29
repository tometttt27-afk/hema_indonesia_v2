// Generate string/code in id category_code
const categoryCode = document.getElementById("category_code");
const charactersCode = "0123456789";

function generateCodeCategory(length) {
    let string = "HEMA";
    let result = "";
    for (let i = 0; i < length; i++) {
        result += charactersCode.charAt(
            Math.floor(Math.random() * charactersCode.length)
        );
    }
    return string + result;
}

document.addEventListener("DOMContentLoaded", function () {
    categoryCode.value = generateCodeCategory(4);
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
