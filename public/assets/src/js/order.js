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

document.addEventListener("DOMContentLoaded", function () {
  const dineinCheckbox = document.getElementById('dinein');
  const takeawayCheckbox = document.getElementById('takeaway');
  const tableWrapper = document.getElementById('tableWrapper');

  function toggleTableVisibility() {
    if (takeawayCheckbox.checked && !dineinCheckbox.checked) {
      tableWrapper.classList.add('hidden'); // Sembunyikan table
    } else {
      tableWrapper.classList.remove('hidden'); // Tampilkan table
    }
  }

  dineinCheckbox.addEventListener('change', function () {
    if (dinein.checked) {
      takeaway.checked = false;
    }
  });

  takeawayCheckbox.addEventListener('change', function () {
    if (takeaway.checked) {
      dinein.checked = false;
    }
  });

  // Event listener ketika checkbox berubah
  dineinCheckbox.addEventListener('change', toggleTableVisibility);
  takeawayCheckbox.addEventListener('change', toggleTableVisibility);

  // Panggil langsung saat halaman dimuat
  toggleTableVisibility();

  const paymentCheckboxes = document.querySelectorAll(
    'input[type="checkbox"][name="ShopeePay"], input[name="Qris"], input[name="Dana"], input[name="Cash"], input[name="Muamalat"], input[name="BRI"], input[name="BCA"]'
  );

  paymentCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      if (this.checked) {
        paymentCheckboxes.forEach(cb => {
          if (cb !== this) cb.checked = false;
        });
      }
    });
  });
});

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
let membershipUpgradeCost = 0;
let membershipDiscountRate = 0.025; // 2.5%
let customerCash = 0;
let selectedPaymentMethod = "";

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

    const noteInput = clone.querySelector('.note');
    noteInput.value = orders[id].note || '';
    noteInput.addEventListener('input', (e) => {
      orders[id].note = e.target.value;
    });

    // Event handler
    clone.querySelector('.btnMinus').onclick = () => updateQty(id, -1);
    clone.querySelector('.btnPlus').onclick = () => updateQty(id, 1);
    clone.querySelector('.btnDelete').onclick = () => removeItem(id);

    // Tambahkan ke DOM
    document.getElementById('orderedList').appendChild(clone);
}

function checkMembership() {
  const name = document.getElementById('name')?.value.trim();
  const phone = document.getElementById('phone')?.value.trim();

  fetch('/check-membership', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ name, phone })
  })
    .then(res => res.json())
    .then(data => {
      // Sembunyikan semua dulu

      if (data.status === 'found') {
        if (data.membership === 'Expired') {
          document.getElementById('cardExpired').classList.remove('hidden');
          document.querySelector('.memberName').textContent = data.name;
          document.querySelector('.memberPhone').textContent = data.phone;
          document.querySelector('.memberPoints').textContent = data.points;

          // Tampilkan tombol update
          document.getElementById('UpdateMember').classList.remove('hidden');

          // Simpan nilai untuk modal
          document.getElementById('formUpdateName').value = data.name;
          document.getElementById('formUpdatePhone').value = data.phone;

          // Set display Last Type di Modal Update
          document.getElementById('lastTypeDisplay').textContent = data.last_type ?? '-';

        } else if (data.membership === 'Silver') {
          document.getElementById('cardSilver').classList.remove('hidden');
        } else if (data.membership === 'Gold') {
          document.getElementById('cardGold').classList.remove('hidden');
        } else if (data.membership === 'Platinum') {
          document.getElementById('cardPlatinum').classList.remove('hidden');
        } else {
          document.getElementById('NoMembership')?.classList.remove('hidden');
        }
      } else {
        document.getElementById('NoMembership')?.classList.remove('hidden');
      }
    })
    // .catch(() => showCard('NoMembership'));
}

function showUpdateMembershipModal() {
  const name = document.getElementById('name')?.value.trim();
  const phone = document.getElementById('phone')?.value.trim();
  const lastType = document.getElementById('lastTypeDisplay')?.textContent || '-';

  // Isi input hidden
  document.getElementById('formUpdateName').value = name;
  document.getElementById('formUpdatePhone').value = phone;

  document.getElementById('lastTypeDisplay').textContent = last;

  // Tampilkan modal
  document.getElementById('updateMembershipModal').classList.remove('hidden');
}

// function updateMembership() {
//   const name = document.getElementById('formUpdateName').value.trim();
//   const phone = document.getElementById('formUpdatePhone').value.trim();

//   if (!name || !phone) {
//     alert('Data tidak lengkap');
//     return;
//   }

//   fetch('/membership/update', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//     },
//     body: JSON.stringify({ name, phone })
//   })
//     .then(res => res.json())
//     .then(data => {
//       if (data.status === 'updated') {
//         // Tutup modal
//         closeModal('updateMembershipModal');

//         // Tampilkan kembali sidebar payment
//         showSidebar('sidebarPayment');

//         // Tambahkan biaya update ke total (jika ada UI untuk itu)
//         const cost = data.cost || 20000;
//         document.getElementById('membershipCostSection').style.display = 'flex';
//         document.getElementById('membershipCost').textContent = formatRupiah(cost);

//         // Perbarui total pembayaran
//         updatePaymentSummary();

//         // Refresh kartu membership dengan check ulang
//         checkMembership();
//       } else {
//         alert(data.message || 'Membership gagal diperbarui.');
//       }
//     })
//     .catch(err => {
//       console.error(err);
//       alert('Terjadi kesalahan saat memperbarui membership.');
//     });
// }



function updatePaymentSummary() {
  let subtotal = 0;
  const taxRate = 0.1;

  for (const id in orders) {
    const item = orders[id];
    subtotal += item.price * item.qty;
  }

  const tax = Math.round(subtotal * taxRate);
  const total = subtotal + tax + membershipUpgradeCost;

  const formatRupiah = n => 'Rp. ' + n.toLocaleString('id-ID');

  document.getElementById('subtotalAmount').textContent = formatRupiah(subtotal);
  document.getElementById('taxAmount').textContent = formatRupiah(tax);
  document.getElementById('totalAmount').textContent = formatRupiah(total);
}

document.querySelectorAll('#paymentMethod input[type="checkbox"]').forEach(checkbox => {
  checkbox.addEventListener('change', function () {
    // Hapus centang dari semua
    document.querySelectorAll('#paymentMethod input[type="checkbox"]').forEach(cb => {
      if (cb !== this) cb.checked = false;
    });

    // Simpan metode pembayaran yang terpilih
    if (this.checked) {
      selectedPaymentMethod = this.value;
    } else {
      selectedPaymentMethod = "";
    }
  });
});

function prepareInvoice() {
  if (selectedPaymentMethod === "Cash") {
    // Tampilkan input cash terlebih dahulu
    customerCash = 0; // atau bisa default cash = total jika kamu mau
    document.getElementById("modalInputCash").classList.remove("hidden");
    
  } else {
    document.getElementById("sidebarFinish").classList.remove("hidden");
  }
}

function handleCashInput() {
  const input = document.getElementById("cashInput").value;
  const amount = parseInt(input);

  if (isNaN(amount) || amount <= 0) {
    alert("Please enter a valid cash amount.");
    return;
  }

  customerCash = amount;

  closeModal('modalInputCash');
  closeModal('modalInvoice');

  updateSidebarFinish(); // <--- Tambahkan ini
  document.getElementById("sidebarPayment").classList.add("hidden");
  document.getElementById("sidebarFinish").classList.remove("hidden");
}


function updateSidebarFinish() {
  const orderMeta = document.getElementById("orderMeta1").textContent;
  const [orderCode, date, time] = orderMeta.split(" | ");
  document.getElementById("finishOrderCode").textContent = orderCode;
  document.getElementById("finishOrderTime").textContent = `${date} | ${time}`;

  // Kosongkan dulu tbody-nya
  const tbody = document.getElementById("sidebarItemList");
  tbody.innerHTML = "";

  let subtotal = 0;
  let tax = 0;
  let discount = 0;

  for (const id in orders) {
    const item = orders[id];
    const itemSubtotal = item.price * item.qty;
    const itemTax = Math.round(itemSubtotal * 0.1);
    const itemDiscount = Math.round(itemSubtotal * membershipDiscountRate || 0);

    subtotal += itemSubtotal;
    tax += itemTax;
    discount += itemDiscount;

    const row = document.createElement("tr");
    row.classList.add("border-b", "border-tertiary", "h-[3rem]");
    row.innerHTML = `
      <td>${item.name}</td>
      <td>${item.qty}</td>
      <td>Rp${itemTax.toLocaleString("id-ID")}</td>
      <td>Rp${itemSubtotal.toLocaleString("id-ID")}</td>
    `;
    tbody.appendChild(row);
  }

  const total = subtotal + tax - discount;

  // Update summary
  document.getElementById("sidebarSubtotal").textContent = `Rp${subtotal.toLocaleString("id-ID")}`;
  document.getElementById("sidebarDiscount").textContent = `Rp${discount.toLocaleString("id-ID")}`;
  document.getElementById("sidebarTax").textContent = `Rp${tax.toLocaleString("id-ID")}`;
  document.getElementById("sidebarTotal").textContent = `Rp${total.toLocaleString("id-ID")}`;

  // Payment method
  document.getElementById("sidebarPaymentMethod").textContent = selectedPaymentMethod;
  document.getElementById("sidebarPaymentIcon").src = getPaymentIcon(selectedPaymentMethod);

  // Show/hide cash and return
  if (selectedPaymentMethod === "Cash") {
    document.getElementById("sidebarCashRow").classList.remove("hidden");
    document.getElementById("sidebarReturnRow").classList.remove("hidden");

    document.getElementById("sidebarCash").textContent = `Rp${customerCash.toLocaleString("id-ID")}`;
    const returnAmount = customerCash - total;
    document.getElementById("sidebarReturn").textContent = `Rp${returnAmount.toLocaleString("id-ID")}`;
  } else {
    document.getElementById("sidebarCashRow").classList.add("hidden");
    document.getElementById("sidebarReturnRow").classList.add("hidden");
  }
}

function orderNext() {
  const name = document.getElementById('name')?.value.trim();
  const phone = document.getElementById('phone')?.value.trim();
  const table = document.getElementById('table')?.value;
  const dineIn = document.getElementById('dinein')?.checked;
  const takeaway = document.getElementById('takeaway')?.checked;

  // Validasi utama: nama & telepon harus selalu diisi
  if (!name || !phone) {
    alert("Please enter name and phone number.");
    return;
  }

  // Validasi minimal salah satu dipilih
  if (!dineIn && !takeaway) {
    alert("Please choose either Dine In or Take Away.");
    return;
  }

  // Validasi table hanya jika dine in
  if (dineIn && !table) {
    alert("Please select a table for Dine In.");
    return;
  }

  const orderAside = document.getElementById("sidebarOrderedList");
  const paymentAside = document.getElementById("sidebarPayment");

  orderAside.classList.add("hidden");
  paymentAside.classList.remove("hidden");

  checkMembership();
  updatePaymentSummary();
}


function showInvoice() {
  const tableNo = document.getElementById("table")?.value || "-";
  const metaText = document.getElementById("orderMeta1")?.textContent || "-";
  // const cash = parseInt(document.getElementById("cashInput")?.value) || 0;
  const [orderCode, date, time] = metaText.split(" | ");

  // Set meta
  document.getElementById("invoiceTableNo").textContent = tableNo;
  document.getElementById("invoiceOrderCode").textContent = orderCode;
  document.getElementById("invoiceOrderTime").textContent = `${date} | ${time}`;

  // Ambil item terakhir dalam orders (hanya 1 yg ditampilkan berdasarkan strukturmu sekarang)
  const lastItemId = Object.keys(orders).pop(); // ambil ID terakhir
  const lastItem = orders[lastItemId];

  if (lastItem) {
    document.getElementById("invoiceItemList").textContent = lastItem.name;
    document.getElementById("invoiceItemQty").textContent = lastItem.qty;
    document.getElementById("invoiceItemTotalPrice").textContent =
      "Rp" + (lastItem.price * lastItem.qty).toLocaleString("id-ID");

    // Ambil note dari elemen sidebar
    const itemElem = document.querySelector(`[data-id="${lastItemId}"]`);
    const noteText = itemElem?.querySelector('.note')?.value?.trim() || "-";
    document.getElementById("noteItem").textContent = noteText;
  }

  // Hitung total
  let subtotal = 0;
  for (const id in orders) {
    subtotal += orders[id].price * orders[id].qty;
  }

  const discount = Math.round(subtotal * membershipDiscountRate); // misal 0.025
  const tax = Math.round(subtotal * 0.1);
  const total = subtotal + tax + membershipUpgradeCost - discount;
  // customerCash = cash;
  // const change = customerCash - total;

  // Tampilkan ke summary invoice
  const format = n => `Rp${n.toLocaleString("id-ID")}`;
  document.getElementById("invoiceSubtotal").textContent = format(subtotal);
  document.getElementById("invoiceDiscount").textContent = `-Rp${discount.toLocaleString("id-ID")}`;
  document.getElementById("invoiceTax").textContent = format(tax);
  document.getElementById("invoiceTotal").textContent = format(total);
  // document.getElementById("invoiceCash").textContent = format(customerCash);
  // document.getElementById("invoiceReturn").textContent = format(change);

  // Tampilkan metode pembayaran
  const paymentMethod = selectedPaymentMethod || "Not selected";
  document.querySelector('#modalInvoice .payment-method-icon').src = getPaymentIcon(paymentMethod);
  document.querySelector('#modalInvoice .payment-method-name').textContent = paymentMethod;

  // Tampilkan modal invoice
  document.getElementById("modalInvoice").classList.remove("hidden");
}


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


function showPaymentProcessModal() {
  const modalOrderFinish = document.getElementById("modalOrderFinish");
  const processingSection = document.getElementById("processingPayment");
  const successSection = document.getElementById("paymentSuccess");

  // Tampilkan dulu processing-nya
  modalOrderFinish.classList.remove("hidden");
  processingSection.classList.remove("hidden");
  successSection.classList.add("hidden");
  
  setTimeout(() => {
    processingSection.classList.add("hidden");
    successSection.classList.remove("hidden");
  }, 3500);
  
  setTimeout(() => {
    successSection.classList.add("hidden");
    modalOrderFinish.classList.add("hidden");
    document.getElementById("sidebarFinish")?.classList.add("hidden");
    submitTransaction()
  }, 6500);

}

function submitTransaction() {
  const name = document.getElementById('name')?.value.trim();
  const phone = document.getElementById('phone')?.value.trim();
  const table = document.getElementById('table')?.value || null;
  const dineIn = document.getElementById('dinein')?.checked;
  const takeAway = document.getElementById('takeaway')?.checked;

  const type = dineIn ? 'dine_in' : 'take_away';

  let orderItems = [];
  let totalQty = 0;
  let subtotal = 0;

  for (const id in orders) {
    const item = orders[id];
    const itemSubtotal = item.price * item.qty;

    subtotal += itemSubtotal;
    totalQty += item.qty;

    orderItems.push({
      product_id: parseInt(id),
      quantity: item.qty,
      price: item.price,
      subtotal: itemSubtotal,
      note: item.note || ""
    });
  }

  const tax = Math.round(subtotal * 0.1);
  const discount = Math.round(subtotal * membershipDiscountRate);
  const total = subtotal + tax + membershipUpgradeCost - discount;
  const change = customerCash - total;

  const payload = {
    user_id: 234083, // <-- GANTI: ambil dari session Laravel / backend
    customer_name: name,
    customer_phone: phone,
    dine_type: type,
    table: dineIn ? table : null,
    total: total,
    change_amount: change,
    orders: orderItems,
    payment_method: selectedPaymentMethod.toLowerCase(),
    payment_amount: customerCash
  };

  fetch('/submit-sale', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify(payload)
  })
    .then(res => res.text()) // baca text mentah dulu, bukan .json()
    .then(data => {
      console.log("DATA:", data);
      try {
        const data = JSON.parse(text);
        console.log("Parsed JSON:", data);
        if (data.status === 'success') {
          alert("Transaksi berhasil disimpan!");
        } else {
          alert("Gagal menyimpan transaksi.");
        }
      } catch (e) {
        console.error("Bukan JSON valid:", e);
        alert("Respon server tidak valid JSON.");
      }
    })
    .catch(err => {
      console.error("Fetch gagal:", err);
      alert("Terjadi kesalahan jaringan atau server.");
    });

}




// Fungsi bantu untuk menyesuaikan icon
function getPaymentIcon(method) {
  switch (method) {
    case "ShopeePay": return "assets/src/assets/paymentIcons/logoShopeePay-01.png";
    case "Qris": return "assets/src/assets/paymentIcons/qris.png";
    case "Dana": return "assets/src/assets/paymentIcons/dana.png";
    case "Cash": return "assets/src/assets/paymentIcons/cash.png";
    case "Muamalat": return "assets/src/assets/paymentIcons/muamalat.png";
    case "BRI": return "assets/src/assets/paymentIcons/bri.png";
    case "BCA": return "assets/src/assets/paymentIcons/bca.png";
    default: return "https://img.icons8.com/color/48/000000/cash-in-hand.png";
  }
}


