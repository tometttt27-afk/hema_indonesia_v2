// icon password
const passwordField = document.getElementById("password");
const passwordIcon = document.querySelector(".password-icon i");

passwordIcon.addEventListener("click", function () {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordIcon.classList.remove("fa-eye-slash");
        passwordIcon.classList.add("fa-eye");
        passwordIcon.style.color = "#b17457";
    } else {
        passwordField.type = "password";
        passwordIcon.classList.remove("fa-eye");
        passwordIcon.classList.add("fa-eye-slash");
        passwordIcon.style.color = "#6b7280";
    }
});

// sweetalert
document.addEventListener("DOMContentLoaded", function () {
    let successAuth = document.querySelector(
        'meta[name="success_auth"]'
    )?.content;
    let error = document.querySelector('meta[name="error"]')?.content;
    let isNotSignIn = document.querySelector(
        'meta[name="isNotSignIn"]'
    )?.content;
    let errors = JSON.parse(
        document.querySelector('meta[name="errors"]')?.content || "[]"
    );

    if (successAuth) {
        Swal.fire({
            title: successAuth,
            icon: "success",
        });
    }

    if (error) {
        Swal.fire({
            title: error,
            icon: "error",
        });
    }

    if (isNotSignIn) {
        Swal.fire({
            title: isNotSignIn,
            icon: "error",
        });
    }

    if (errors.length > 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            html:
                "<ul>" + errors.map((e) => `<li>${e}</li>`).join("") + "</ul>",
            confirmButtonText: "OK",
        });
    }
});

// hapus history dan cache
document.addEventListener("DOMContentLoaded", function () {
    history.replaceState(null, null, location.href);
    window.onunload = function () {
        localStorage.clear();
        sessionStorage.clear();
    };
});
