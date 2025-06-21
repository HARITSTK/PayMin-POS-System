// Function to show the modal
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

// Input file for image upload and description of card

const inputFile = document.getElementById("fileInput");
const imageView = document.getElementById("imageView");
let imgLink = "";
inputFile.addEventListener("change", uploadImage);

function uploadImage() {
  imgLink = URL.createObjectURL(inputFile.files[0]);
  imageView.style.backgroundImage = `url(${imgLink})`;
  imageView.style.backgroundSize = "cover";
  imageView.style.backgroundPosition = "center";
  imageView.style.backgroundRepeat = "no-repeat";
  imageView.textContent = "";
}

document.addEventListener("DOMContentLoaded", function () {
  const categorySelect = document.querySelector(".itemCategory");
  const subCategorySelect = document.querySelector(".itemSubCategory");

  const subCategories = {
    food: ["Main Course", "Appetizer", "Side Dish", "Salad"],
    drink: ["Hot Drink", "Cold Drink", "Juice", "Soda", "Coffee", "Tea"],
    snack: ["Chips", "Nuts", "Cookies", "Crackers"],
    dessert: ["Cake", "Ice Cream", "Pudding", "Pastry"],
    signature: ["Chef Special", "House Special", "Seasonal Special"],
    // other: ["Other"],
  };

  function updateSubCategories() {
    const selectedCategory = categorySelect.value;
    const options = subCategories[selectedCategory] || [""];

    subCategorySelect.innerHTML = ""; // Kosongkan dulu

    options.forEach(function (sub) {
      const option = document.createElement("option");
      option.value = sub.toLowerCase().replace(/\s+/g, "-");
      option.textContent = sub;
      subCategorySelect.appendChild(option);
    });
  }

  categorySelect.addEventListener("change", updateSubCategories);

  updateSubCategories();
});