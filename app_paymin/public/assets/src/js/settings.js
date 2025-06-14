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
    const modalContent = modal.querySelector(".modal-content");

    modal.classList.remove("hidden");
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector(".modal-content");

    modal.classList.add("hidden");
}