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

function orderNext() {
  const orderAside = document.getElementById("sidebarOrderedList");
  const paymentAside = document.getElementById("sidebarPayment");

  orderAside.classList.add("hidden");
  paymentAside.classList.remove("hidden");
}

function paymentNext() {
  const paymentAside = document.getElementById("sidebarPayment");
  const finishAside = document.getElementById("sidebarFinish");

  paymentAside.classList.add("hidden");
  finishAside.classList.remove("hidden");
}

function paymentBack() {
  const orderAside = document.getElementById("sidebarOrderedList");
  const paymentAside = document.getElementById("sidebarPayment");

  orderAside.classList.remove("hidden");
  paymentAside.classList.add("hidden");
}

// Function to toggle sidebar
const sidebar = document.getElementById("sidebarOrderedList");
const orderList = document.getElementById("orderList");
let sidebarOpen = false;

function toggleSidebar() {
  sidebarOpen = !sidebarOpen;

  if (sidebarOpen) {
    if (!sidebar.classList.contains("block")) {
      sidebar.classList.remove("hidden");
    }
    sidebar.classList.add("block");

    // Adjust grid columns based on screen width when sidebar is open
    adjustGridColumns();
  } else {
    sidebar.classList.add("hidden");
    sidebar.classList.remove("block");
    // Reset grid columns based on screen width when sidebar is closed
    adjustGridColumns();
  }

  console.log("Sidebar state:", sidebarOpen);
}

// Function to adjust grid columns based on screen width and sidebar state
function adjustGridColumns() {
  orderList.classList.remove(
    "grid-cols-1",
    "sm:grid-cols-2",
    "lg:grid-cols-3",
    "xl:grid-cols-4"
  );

  // Base responsive grid
  orderList.classList.add("grid-cols-1");

  const screenWidth = window.innerWidth;

  if (sidebarOpen) {
    if (screenWidth >= 1280) {
      orderList.classList.add("sm:grid-cols-2", "lg:grid-cols-3");
    } else if (screenWidth >= 1024) {
      orderList.classList.add("sm:grid-cols-2");
    } else if (screenWidth >= 640) {
      orderList.classList.add("sm:grid-cols-1");
    }
  } else {
    orderList.classList.add(
      "sm:grid-cols-2",
      "lg:grid-cols-3",
      "xl:grid-cols-4"
    );
  }
}

window.addEventListener("resize", adjustGridColumns);
adjustGridColumns();

const paymentSuccess = document.getElementById("modalOrderFinish");

function showPaymentSuccessModal() {
  paymentSuccess.classList.remove("hidden");

  setTimeout(() => {
    paymentSuccess.classList.add("hidden");
  }, 3500);

  const invoiceModal = document.getElementById("modalInvoice");
  invoiceModal.classList.add("hidden");

  const paymentAside = document.getElementById("sidebarPayment");
  paymentAside.classList.add("hidden");

  const finishAside = document.getElementById("sidebarFinish");
  finishAside.classList.remove("hidden");

  // orderList.classList.remove(
  //   "grid-cols-1",
  //   "sm:grid-cols-2",
  //   "lg:grid-cols-3",
  //   "xl:grid-cols-4"
  // );
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

let orderItems = {};
let orderNumber = "";

// Format harga jadi "Rp. 20.000"
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(angka).replace(',00', '');
}

// Fungsi tambah item
function addItemToOrder(productId, name, price, imageUrl) {
  if (Object.keys(orderItems).length === 0) {
      orderNumber = generateOrderNumber(); // Buat angka acak
      updateDateTime(); // Tampilkan ke HTML
  }

  toggleSidebar('sidebarOrderedList');

  if (!orderItems[productId]) {
      orderItems[productId] = {
          name,
          price: parseInt(price),
          quantity: 1,
          imageUrl
      };
  } else {
      orderItems[productId].quantity++;
  }

  renderOrderList();
}

// Tambah jumlah
function incrementItem(productId) {
  orderItems[productId].quantity++;
  renderOrderList();
}

// Kurangi jumlah
function decrementItem(productId) {
  orderItems[productId].quantity--;
  if (orderItems[productId].quantity <= 0) {
      delete orderItems[productId];
  }
  renderOrderList();
}

function renderOrderList() {
    const container = document.getElementById("orderedList");
    container.innerHTML = "";

    const sidebar = document.getElementById("sidebarOrderedList");

    // Jika tidak ada item, sembunyikan sidebar
    if (Object.keys(orderItems).length === 0) {
        sidebar.classList.add("hidden");
        return;
    }

    // Tampilkan sidebar kalau belum
    sidebar.classList.remove("hidden");

    for (const [id, item] of Object.entries(orderItems)) {
        const total = item.price * item.quantity;

        container.innerHTML += `
            <div class="flex flex-col items-center w-full mt-2">
                <div class="flex justify-between w-full h-[60px]">
                    <div class="flex items-center justify-center w-[5em]">
                        <img src="${item.imageUrl}" alt="${item.name}" class="w-full object-cover h-full" />
                    </div>
                    <div class="w-auto">
                        <h1 class="text-textColor text-lg font-semibold overflow-hidden text-ellipsis whitespace-nowrap w-[70%]">${item.name}</h1>
                        <p class="text-textColor text-sm w-auto">${formatRupiah(item.price)}</p>
                    </div>
                    <div class="w-auto">
                        <h1 class="text-primary text-2xl font-bold">${formatRupiah(total)}</h1>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-1 w-full">
                    <button class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold" onclick="decrementItem('${id}')">-</button>
                    <span class="text-lg font-semibold w-8 text-center">${item.quantity}</span>
                    <button class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold" onclick="incrementItem('${id}')">+</button>
                </div>
                <div class="flex justify-between items-center w-full h-12 mt-2">
                    <form action="">
                        <input type="text" class="border border-gray-300 rounded-md bg-[#C9C9C9] p-3 w-full text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="add note" />
                    </form>
                    <button onclick="delete orderItems['${id}']; renderOrderList();" class="text-tertiary hover:text-red-700 h-full rounded-md border-2 border-tertiary w-[20%]">
                        <i class="fa fa-trash fa-lg"></i>
                    </button>
                </div>
                <hr class="w-full h-[1px] my-6 border-0 bg-tertiary" />
            </div>
        `;
    }
}

// Buat jam dan tanggal dinamis
function updateDateTime() {
    const now = new Date();
    const formattedDate = now.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric"
    });

    const formattedTime = now.toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit"
    });

    const fullText = `${orderNumber} | ${formattedDate} | ${formattedTime}`;

    document.querySelectorAll(".currentDateTime").forEach(el => {
        el.textContent = fullText;
    });
}

// Inisialisasi jam dan tanggal saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    updateDateTime();
});

function generateOrderNumber() {
    const randomNum = Math.floor(1000 + Math.random() * 9000); // 4 digit acak
    return `#Orders${randomNum}`;
}