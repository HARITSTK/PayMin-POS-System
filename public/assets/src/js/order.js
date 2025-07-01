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
  const name = document.getElementById('name')?.value.trim();
  const phone = document.getElementById('phone')?.value.trim();
  const table = document.getElementById('table')?.value;
  const dineIn = document.getElementById('dinein')?.checked;
  const takeaway = document.getElementById('takeaway')?.checked;

  // Validasi
  if (!name || !phone || !table || (!dineIn && !takeaway)) {
    alert("Please complete all required fields:\n- Choose Dine In or Take Away\n- Enter name, phone number, and table number");
    return;
  }

  const orderAside = document.getElementById("sidebarOrderedList");
  const paymentAside = document.getElementById("sidebarPayment");

  orderAside.classList.add("hidden");
  paymentAside.classList.remove("hidden");

  checkMembership();
  updatePaymentSummary();
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
let orders = {};
let currentOrderCode = null;

function addToOrder(id, name, price, image) {
    price = parseInt(price);

    if (!orders[id]) {
        orders[id] = { name, price, qty: 1, image };
        createOrderItem(id); // TAMBAHKAN INI
    } else {
        orders[id].qty++;
        updateExistingItem(id);
    }

    // TAMPILKAN SIDEBAR
    const sidebar = document.getElementById('sidebarOrderedList');
    if (sidebar.classList.contains('hidden')) {
        sidebar.classList.remove('hidden');
        setOrderMeta(); // orderID hanya dibuat sekali
    }
}


function updateQty(id, change) {
    if (!orders[id]) return;
    orders[id].qty += change;

    if (orders[id].qty <= 0) {
        removeItem(id);
    } else {
        updateExistingItem(id);
    }
}

function updateExistingItem(id) {
    const item = document.querySelector(`[data-id="${id}"]`);
    if (!item) return;

    item.querySelector('.productQty').textContent = orders[id].qty;
    item.querySelector('.productSubtotal').textContent =
        'Rp. ' + (orders[id].qty * orders[id].price).toLocaleString();
}

function removeItem(id) {
    delete orders[id];
    const item = document.querySelector(`[data-id="${id}"]`);
    if (item) item.remove();

    if (Object.keys(orders).length === 0) {
      document.getElementById('sidebarOrderedList').classList.add('hidden');
      currentOrderCode = null; // reset supaya dibuat ulang di pemesanan baru
    }
}

function setOrderMeta() {
  if (currentOrderCode) return; // sudah ada, tidak perlu buat baru

  const now = new Date();
  const randomNumber = Math.floor(1000 + Math.random() * 9000);
  currentOrderCode = `#Orders${randomNumber}`;

  const dateStr = now.toLocaleDateString('id-ID', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
  });
  const timeStr = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
  });

  const info = `${currentOrderCode} | ${dateStr} | ${timeStr}`;
  document.getElementById('orderMeta1').textContent = info;
  document.getElementById('orderMeta2').textContent = info;
}

function createOrderItem(id) {
    const template = document.getElementById('templateItem');
    if (!template) {
        console.error("templateItem not found!");
        return;
    }

    const clone = template.cloneNode(true);
    clone.id = "";
    clone.classList.remove("hidden");
    clone.setAttribute('data-id', id);

    // Isi data
    clone.querySelector('.productImage').src = orders[id].image;
    clone.querySelector('.productName').textContent = orders[id].name;
    clone.querySelector('.productPrice').textContent = 'Rp. ' + orders[id].price.toLocaleString();
    clone.querySelector('.productSubtotal').textContent = 'Rp. ' + orders[id].price.toLocaleString();
    clone.querySelector('.productQty').textContent = orders[id].qty;

    // Event handler
    clone.querySelector('.btnMinus').onclick = () => updateQty(id, -1);
    clone.querySelector('.btnPlus').onclick = () => updateQty(id, 1);
    clone.querySelector('.btnDelete').onclick = () => removeItem(id);

    // Tambahkan ke DOM
    document.getElementById('orderedList').appendChild(clone);
}

function checkMembership() {

  const name = document.getElementById('name').value.trim();
  const phone = document.getElementById('phone').value.trim();
  console.log('[checkMembership] input:', { name, phone });

  if (!name || !phone) {
    showNoMembershipCard();
    return;
  }

  fetch('/check-membership', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ name, phone })
  })
  .then(res => res.json())
  .then(data => {

  if (data.status === 'found') {

    const nameEl = document.querySelectorAll('.memberName');
    const phoneEl = document.querySelectorAll('.memberPhone');
    const pointEl = document.querySelectorAll('.memberPoints');

    // Isi semua kartu yang aktif (karena hanya satu yang akan tampil)
    nameEl.forEach(el => el.textContent = data.name);
    phoneEl.forEach(el => el.textContent = data.phone);
    pointEl.forEach(el => el.textContent = data.points ?? 0);

      if (data.membership === 'Silver') {
        document.getElementById('cardSilver').classList.remove('hidden');
      } else if (data.membership === 'Gold') {
        document.getElementById('cardGold').classList.remove('hidden');
      } else if (data.membership === 'Platinum') {
        document.getElementById('cardPlatinum').classList.remove('hidden');
      } else if (data.membership === 'Expired') {
        document.getElementById('cardExpired')?.classList.remove('hidden');
        document.getElementById('UpdateMember')?.classList.remove('hidden');
      } else {
        document.getElementById('NoMembership')?.classList.remove('hidden');
      }
    } else {
      document.getElementById('NoMembership')?.classList.remove('hidden');
    }
  })
}

function updatePaymentSummary() {
  let subtotal = 0;
  const taxRate = 0.1; // 10%

  // Hitung subtotal dari pesanan
  for (const id in orders) {
    const item = orders[id];
    subtotal += item.price * item.qty;
  }

  const tax = Math.round(subtotal * taxRate);
  const total = subtotal + tax;

  const formatRupiah = n => 'Rp. ' + n.toLocaleString('id-ID');

  // Masukkan nilai yang sesuai ke elemen
  document.getElementById('subtotalAmount').textContent = formatRupiah(subtotal);
  document.getElementById('taxAmount').textContent = formatRupiah(tax);
  document.getElementById('totalAmount').textContent = formatRupiah(total); // pastikan ID ini ada
}
