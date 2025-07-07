const yourRestaurant = document.getElementById("yourRestaurant");
const security = document.getElementById("security");
const aboutUs = document.getElementById("aboutUs");

function showYourRestaurant() {
  yourRestaurant.style.display = "block";
  security.style.display = "none";
  aboutUs.style.display = "none";
}

function showSecurity() {
  yourRestaurant.style.display = "none";
  security.style.display = "block";
  aboutUs.style.display = "none";
}

function showAboutUs() {
  yourRestaurant.style.display = "none";
  security.style.display = "none";
  aboutUs.style.display = "block";
}

// Function to show the modal
function showModal(modalId) {
  const modal = document.getElementById(modalId);

  modal.classList.remove("hidden");
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);

  modal.classList.add("hidden");
}

// 3 navigation (Your Restaurant, Security, About Us), When navigate to another page, added animated fade left and right
function navigateToPage(pageId) {
  const pages = [yourRestaurant, security, aboutUs];
  pages.forEach((page) => {
    if (page.id === pageId) {
      page.classList.remove("hidden");
      page.classList.add("fade-left");
    } else {
      page.classList.add("hidden");
      page.classList.remove("fade-left");
    }
  });
}
