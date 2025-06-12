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

function togglePassword(inputId, iconElement) {
    const input = document.getElementById(inputId);
    const isHidden = input.type === "password";

    input.type = isHidden ? "text" : "password";

    iconElement.innerHTML = isHidden
        ? `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                         a9.959 9.959 0 012.208-3.419m1.435-1.407A9.955 9.955 0 0112 5c4.478 0 
                         8.268 2.943 9.542 7a9.956 9.956 0 01-4.012 4.614M15 12a3 3 0 11-6 0 
                         3 3 0 016 0z" />
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
               </svg>`
        : `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 
                         8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 
                         7-4.478 0-8.268-2.943-9.542-7z" />
               </svg>`;
}
