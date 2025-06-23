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
    const categorySelect = document.getElementById("categorySelect");
    const subCategorySelect = document.getElementById("subcategorySelect");

    function updateSubCategories() {
        const selectedCategoryId = categorySelect.value;
        const subs = subCategories[selectedCategoryId] || [];

        subCategorySelect.innerHTML = '';

        subs.forEach(sub => {
            const option = document.createElement("option");
            option.value = sub.id;
            option.textContent = sub.name;
            subCategorySelect.appendChild(option);
        });
    }

    categorySelect.addEventListener("change", updateSubCategories);

    // Isi subkategori default kalau kategori sudah terisi
    if (categorySelect.value) {
        updateSubCategories();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    window.showModalDelete = function(id, name, price, stock) {
        document.getElementById('deleteItemId').value = id;
        document.getElementById('deleteItemName').textContent = name;
        document.getElementById('deleteItemInfo').textContent = `Rp ${price} | ${stock} Stock`;

        document.getElementById('modalDeleteItem').classList.remove('hidden');
    }

    window.closeModal = function(id) {
        document.getElementById(id).classList.add('hidden');
    }
});

window.showModalEdit = function (btn) {
  const id = btn.dataset.id;
  const name = btn.dataset.name;
  const desc = btn.dataset.desc;
  const price = btn.dataset.price;
  const stock = btn.dataset.stock;
  const category_id = btn.dataset.category;
  const subcategory_id = btn.dataset.subcategory;

  document.getElementById('modalEditItem').classList.remove('hidden');

  document.getElementById('edit_id').value = id;
  document.getElementById('edit_name').value = name;
  document.getElementById('edit_desc').value = desc;
  document.getElementById('edit_price').value = price;
  document.getElementById('edit_stock').value = stock;
  document.getElementById('edit_category_id').value = category_id;
  document.getElementById('edit_subcategory_id').value = subcategory_id;
}



