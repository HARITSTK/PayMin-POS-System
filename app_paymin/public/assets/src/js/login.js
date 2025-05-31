const clickAnywhere = document.getElementById("firstScreen");
clickAnywhere.addEventListener("click", function () {
  const loginForm = document.getElementById("loginPage");

  if (loginForm) {
    clickAnywhere.classList.add("hidden");
    loginForm.classList.remove("hidden");
  }
});
