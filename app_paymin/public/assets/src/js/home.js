// Make new account form validation script

loginSuccess = ``;
document.addEventListener("DOMContentLoaded", function () {
  let newAccount = {};

  const newAccountForm = document.getElementById("newAccountForm");
  const loginForm = document.getElementById("loginForm");

  if (newAccountForm) {
    newAccountForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const newUsername = document.getElementById("newUsername").value.trim();
      const newPassword = document.getElementById("newPassword").value;

      if (newUsername && newPassword) {
        newAccount = {
          username: newUsername,
          password: newPassword,
        };
        alert("Account created successfully!");
        // Optionally, clear the form fields
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
          document.getElementById("usernameError").style.display = "block";
        } else {
          document.getElementById("usernameError").style.display = "none";
        }

        if (password !== newAccount.password) {
          document.getElementById("passwordError").style.display = "block";
        } else {
          document.getElementById("passwordError").style.display = "none";
        }
      }
    });
  }
});

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  grid: {
    rows: 2,
  },
  spaceBetween: 20,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
