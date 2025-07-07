// Function to show the modal
// Function to show the modal
function showModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.remove("hidden");
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.add("hidden");

  if (id === 'modalAddItem') {
    document.getElementById('addPreviewImage').src = '';
    document.getElementById('addPreviewImage').classList.add('hidden');
    document.getElementById('addFileName').textContent = '';
    document.getElementById('addImageInput').value = '';
  } else if (id === 'modalEditItem') {
    document.getElementById('editPreviewImage').src = '';
    document.getElementById('editPreviewImage').classList.add('hidden');
    document.getElementById('editFileName').textContent = '';
    document.getElementById('editImageInput').value = '';
  }
}

// Input file for image upload and description of card
// const inputFile = document.getElementById("fileInput");
// const imageView = document.getElementById("imageView");
// let imgLink = "";
// inputFile.addEventListener("change", uploadImage);

// function uploadImage() {
//   imgLink = URL.createObjectURL(inputFile.files[0]);
//   imageView.style.backgroundImage = `url(${imgLink})`;
//   imageView.style.backgroundSize = "cover";
//   imageView.style.backgroundPosition = "center";
//   imageView.style.backgroundRepeat = "no-repeat";
//   imageView.textContent = "";
// }
function handleImageUpload(event, type) {
    const file = event.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        const previewId = type === 'edit' ? 'editPreviewImage' : 'addPreviewImage';
        const fileNameId = type === 'edit' ? 'editFileName' : 'addFileName';

        const preview = document.getElementById(previewId);
        const fileNameSpan = document.getElementById(fileNameId);

        if (preview) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }

        if (fileNameSpan) {
            fileNameSpan.textContent = file.name;
        }
    };

    reader.readAsDataURL(file);
}





document.addEventListener("DOMContentLoaded", function () {
  const categorySelect = document.getElementById("itemCategory");
  const subCategorySelect = document.getElementById("itemSubCategory");

  function updateSubCategories() {
    const selectedCategory = categorySelect.value;
    const options = subCategories[selectedCategory] || [];

    subCategorySelect.innerHTML = '';

    options.forEach(function (sub) {
      const option = document.createElement("option");
      option.value = sub.id;
      option.textContent = sub.name;
      subCategorySelect.appendChild(option);
    });
  }

  categorySelect.addEventListener("change", updateSubCategories);

  // Jalankan saat halaman pertama kali terbuka
  updateSubCategories();
});


window.showModalDelete = function(button) {
    const id = button.dataset.id;
    const name = button.dataset.name;
    const price = button.dataset.price;
    const stock = button.dataset.stock;
    const image = button.dataset.image;

    document.getElementById('deleteItemId').value = id;
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteItemInfo').textContent = `Rp ${price} | ${stock} Stock`;

    const img = document.getElementById('deleteItemImage');
    img.src = image ? `/storage/${image}` : '/default.jpg';

    document.getElementById('modalDeleteItem').classList.remove('hidden');
};


window.showModalEdit = function (btn) {
  const id = btn.dataset.id;
  const name = btn.dataset.name;
  const desc = btn.dataset.desc;
  const price = btn.dataset.price;
  const stock = btn.dataset.stock;
  const category_id = btn.dataset.category;
  const subcategory_id = btn.dataset.subcategory;
  const image = btn.dataset.image;

  // Tampilkan modal
  document.getElementById('modalEditItem').classList.remove('hidden');

  // Isi form
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_name').value = name;
  document.getElementById('edit_desc').value = desc;
  document.getElementById('edit_price').value = price;
  document.getElementById('edit_stock').value = stock;
  document.getElementById('edit_category_id').value = category_id;
  document.getElementById('edit_subcategory_id').value = subcategory_id;

  // Preview gambar
  const preview = document.getElementById('editPreviewImage');
  if (image && image !== "null") {
    preview.src = `/storage/${image}`;
    preview.classList.remove('hidden');
  } else {
    preview.src = '/default.jpg';
    preview.classList.remove('hidden');
  }
};

document.addEventListener("DOMContentLoaded", function () {
  const filterButtons = document.querySelectorAll(".filter-btn");
  const itemCards = document.querySelectorAll(".itemCard");

  filterButtons.forEach(button => {
    button.addEventListener("click", function () {
      const filter = this.getAttribute("data-filter");

      itemCards.forEach(card => {
        const category = card.getAttribute("data-category");

        if (filter === "all" || category === filter) {
          card.classList.remove("hidden");
        } else {
          card.classList.add("hidden");
        }
      });

      // Optional: Tambah highlight button aktif
      filterButtons.forEach(btn => btn.classList.remove("bg-[#FFB09F]", "text-primary", "border-primary"));
      this.classList.add("bg-[#FFB09F]", "text-primary", "border-primary");
    });
  });
});


function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase().trim();
    const cards = document.querySelectorAll(".itemCard");
    const noResults = document.getElementById("noResultsMessage");
    const addItemCard = document.getElementById("addItemCard");

    if (input === "") {
        cards.forEach(card => card.classList.remove("hidden"));
        noResults.classList.add("hidden");
        addItemCard.classList.remove("hidden");
        return;
    }

    let found = 0;
    cards.forEach(card => {
        const name = card.querySelector(".item-name")?.textContent.toLowerCase() || "";
        const isMatch = name.includes(input);

        card.classList.toggle("hidden", !isMatch);
        if (isMatch) found++;
    });

    // Tampilkan pesan + sembunyikan add jika tidak ada hasil
    const noMatch = found === 0;
    noResults.classList.toggle("hidden", !noMatch);
    addItemCard.classList.toggle("hidden", noMatch);
}

// document.addEventListener("DOMContentLoaded", function () {
  function showProductDetailCassier(button) {
      const name = button.dataset.name;
      const stock = button.dataset.stock;
      const price = button.dataset.price;
      const desc = button.dataset.desc;
      const image = button.dataset.image;

      // Set content ke modal
      document.getElementById('modalItemName').textContent = name;
      document.getElementById('modalItemStock').textContent = stock;
      document.getElementById('modalItemPrice').textContent = "Rp. " + parseInt(price).toLocaleString('id-ID');
      document.getElementById('modalItemDesc').innerHTML = desc.replace(/\n/g, "<br>");
      document.getElementById('modalItemImage').src = image;

      // Tampilkan modal
      document.getElementById('modalDetailItem').classList.remove('hidden');
  }
// });


// document.addEventListener('DOMContentLoaded', function () {
function showProductDetail(button) {
    const cashier = button.dataset.cashier;
    const customer = button.dataset.customer;
    const table = button.dataset.table;
    const items = button.dataset.items;
    const note = button.dataset.note;
    const image = button.dataset.image;

    const orderIdInput = document.getElementById('orderIdInput');
    if (orderIdInput) {
      orderIdInput.value = button.dataset.id;
    }

    // Set value ke modal
    document.getElementById('orderIdInput').value = button.dataset.id;
    document.getElementById('modalCashierName').textContent = cashier;
    document.getElementById('modalCustomerName').textContent = customer;
    document.getElementById('modalCustomerTable').textContent = table;
    document.getElementById('modalItemList').textContent = items;
    document.getElementById('modalItemDesc').textContent = note;
    document.getElementById('modalItemImage').src = image;

    // Tampilkan modal
    document.getElementById('modalDetailItem').classList.remove('hidden');
}
// });
