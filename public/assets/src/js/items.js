// Function to show the modal
// Function to show the modal
function showModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.remove("hidden");
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.add("hidden");
}

document.querySelector('form').addEventListener('submit', function (e) {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    if (!file) {
        console.warn("❌ Tidak ada file yang dipilih saat submit!");
    } else {
        console.log("✅ File siap dikirim:", file.name, file.type);
    }

    const formData = new FormData(this);
    for (let [key, value] of formData.entries()) {
        if (value instanceof File) {
            console.log(`${key}: File - ${value.name}`);
        } else {
            console.log(`${key}: ${value}`);
        }
    }
});


document.getElementById("fileInput").addEventListener("change", function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById("imagePreview");

    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target.result;
            preview.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        preview.classList.add("hidden");
    }
});

document.getElementById("fileInput").addEventListener("change", function (e) {
    const file = e.target.files[0];
    console.log("Selected file:", file); // <- ini harus muncul
});

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
