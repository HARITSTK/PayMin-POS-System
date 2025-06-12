const clickAnywhere = document.getElementById("firstScreen");
clickAnywhere.addEventListener("click", function () {
    const loginForm = document.getElementById("loginPage");

    if (loginForm) {
        clickAnywhere.classList.add("hidden");
        loginForm.classList.remove("hidden");
    }
});

loginSuccess = ``;
document.addEventListener("DOMContentLoaded", function () {
    let newAccount = {};

    const newAccountForm = document.getElementById("newAccountForm");
    const loginForm = document.getElementById("loginForm");

    if (newAccountForm) {
        newAccountForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const newUsername = document
                .getElementById("newUsername")
                .value.trim();
            const newPassword = document.getElementById("newPassword").value;

            if (newUsername && newPassword) {
                newAccount = {
                    username: newUsername,
                    password: newPassword,
                };
                alert("Account created successfully!");
                newAccountForm.reset();
            } else {
                alert("Please fill in all fields.");
            }
        });
    }

    // Login form validation script
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value;

            if (
                username === newAccount.username &&
                password === newAccount.password
            ) {
                alert("Login successful!");
                document.getElementById("usernameError").style.display = "none";
                document.getElementById("passwordError").style.display = "none";
                // Redirect or further logic here
            } else {
                if (username !== newAccount.username) {
                    document.getElementById("usernameError").style.display =
                        "block";
                } else {
                    document.getElementById("usernameError").style.display =
                        "none";
                }

                if (password !== newAccount.password) {
                    document.getElementById("passwordError").style.display =
                        "block";
                } else {
                    document.getElementById("passwordError").style.display =
                        "none";
                }
            }
        });
    }
});

function showPage(modalId) {
    const show = document.getElementById(modalId);

    show.classList.remove("hidden");
}

function closePage(modalId) {
    const show = document.getElementById(modalId);

    show.classList.add("hidden");
}

function register() {
    const loginPage = document.getElementById("loginPage");
    const newAccountPage = document.getElementById("register");

    loginPage.classList.add("hidden");
    newAccountPage.classList.remove("hidden");
}

function login() {
    const loginPage = document.getElementById("loginPage");
    const newAccountPage = document.getElementById("register");

    newAccountPage.classList.add("hidden");
    loginPage.classList.remove("hidden");
}

// loginSuccessfull function and then redirect to the main page
function loginSuccessfull() {
    const loginPage = document.getElementById("loginPage");
    loginPage.classList.add("hidden");

    // Tampilkan pesan login success
    const successMessage = document.getElementById("loginSuccess");
    successMessage.classList.remove("hidden");

    // Setelah 2 detik, sembunyikan login success dan tampilkan welcome user
    setTimeout(() => {
        successMessage.classList.add("hidden");

        const welcomeMessage = document.getElementById("welcomeUser");
        welcomeMessage.classList.remove("hidden");

        // Setelah 2 detik lagi, sembunyikan welcome user
        setTimeout(() => {
            welcomeMessage.classList.add("hidden");
        }, 2000);
    }, 2000);

    setTimeout(() => {
        window.location.href = "./employeePages/home.html";
    }, 4000);
}
