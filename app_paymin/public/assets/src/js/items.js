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

function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const cards = document.querySelectorAll(".itemCard");
    const noData = document.getElementById("noData");

    let visibleCount = 0;

    cards.forEach(card => {
        const itemNameEl = card.querySelector(".item-name"); // cari elemen nama item
        const itemName = itemNameEl ? itemNameEl.innerText.toLowerCase() : "";

        if (itemName.includes(input)) {
            card.style.display = "";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    if (visibleCount === 0) {
        noData.classList.remove("hidden");
        noData.style.display = "flex";
    } else {
        noData.classList.add("hidden");
        noData.style.display = "none";
    }
}


