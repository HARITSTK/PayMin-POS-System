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

function confirmPayment() {
  const paymentSuccess = document.getElementById("processingPayment");
  const processingSection = document.getElementById("paymentSuccess");
  const successSection = document.getElementById("successPayment");

  // Tampilkan modal dan bagian processing
  paymentSuccess.classList.remove("hidden");
  processingSection.classList.remove("hidden");
  successSection.classList.add("hidden");

  // Sembunyikan invoice dan payment sidebar
  const invoiceModal = document.getElementById("modalInvoice");
  const paymentAside = document.getElementById("sidebarPayment");
  const finishAside = document.getElementById("sidebarFinish");

  invoiceModal.classList.add("hidden");
  paymentAside.classList.add("hidden");

  // Setelah delay 3 detik, tampilkan bagian sukses
  setTimeout(() => {
    processingSection.classList.add("hidden");
    successSection.classList.remove("hidden");
  }, 3000);

  // Setelah delay total 6.5 detik, sembunyikan modal dan tampilkan sidebarFinish
  setTimeout(() => {
    paymentSuccess.classList.add("hidden");
    finishAside.classList.remove("hidden");
  }, 6500);
}

const modalOrderFinish = document.getElementById("modalOrderFinish");
const processingSection = document.getElementById("processingPayment");
const successSection = document.getElementById("paymentSuccess");

function showPaymentProcessModal() {
  modalOrderFinish.classList.remove("hidden");
  processingSection.classList.remove("hidden");
  successSection.classList.add("hidden");

  document.getElementById("modalInvoice")?.classList.add("hidden");
  document.getElementById("sidebarPayment")?.classList.add("hidden");

  setTimeout(() => {
    processingSection.classList.add("hidden");
    successSection.classList.remove("hidden");
  }, 3500);

  setTimeout(() => {
    modalOrderFinish.classList.add("hidden");
    document.getElementById("sidebarFinish")?.classList.remove("hidden");
  }, 6500);
}

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

// add item to sidebar order list
let currentQty = 1;
let currentPrice = 0;

function fillModal(name, price, image) {
    const orderId = Math.floor(1000 + Math.random() * 9000); // hasil: 4 digit acak, misal 4923
    const now = new Date();

    const orderCode = "#Orders" + orderId;
    const dateStr = now.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    }).replace(/\//g, '/');

    const timeStr = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    });

    const fullInfo = `${orderCode} | ${dateStr} | ${timeStr}`;

    // Tampilkan ke elemen-elemen di modal
    const meta1 = document.getElementById('orderMeta1');
    const meta2 = document.getElementById('orderMeta2');

    if (meta1) meta1.textContent = fullInfo;
    if (meta2) meta2.textContent = fullInfo;

    // (lanjutkan isi produk seperti sebelumnya...)
    currentQty = 1;
    currentPrice = parseInt(price);
    document.getElementById('productImage').src = image;
    document.getElementById('productName').textContent = name;
    document.getElementById('productPrice').textContent = 'Rp. ' + formatRupiah(price);
    document.getElementById('itemCounter').textContent = currentQty;
    document.getElementById('productSubtotal').textContent = 'Rp. ' + formatRupiah(price);

    toggleSidebar('sidebarOrderedList');
}

function incrementCounter() {
    currentQty++;
    updateQtyDisplay();
}

function decrementCounter() {
    if (currentQty > 1) currentQty--;
    updateQtyDisplay();
}

function updateQtyDisplay() {
    document.getElementById('itemCounter').textContent = currentQty;
    document.getElementById('productSubtotal').textContent = 'Rp. ' + formatRupiah(currentQty * currentPrice);
}

function formatRupiah(number) {
    return parseInt(number).toLocaleString('id-ID');
}

function toggleSidebar(id) {
    const sidebar = document.getElementById(id);
    sidebar.classList.toggle('hidden');
}