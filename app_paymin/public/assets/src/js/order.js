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

async function orderNext() {
    const orderAside = document.getElementById("sidebarOrderedList");
    const paymentAside = document.getElementById("sidebarPayment");

    // Call checkMembership before transitioning to the payment screen
    await checkMembership();

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

// Function to toggle sidebar (This function seems to be for the main product display sidebar, not the order/payment sidebar)
const sidebar = document.getElementById("sidebarOrderedList"); // This should likely be a different ID if it's not the order sidebar itself
const orderListGrid = document.getElementById("orderList"); // Renamed to avoid confusion with the orderedList inside the sidebar
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
    // Make sure orderListGrid actually refers to the main product display grid, not the ordered items list
    if (!orderListGrid) return; // Add a check to prevent errors if the element isn't found

    orderListGrid.classList.remove(
        "grid-cols-1",
        "sm:grid-cols-2",
        "lg:grid-cols-3",
        "xl:grid-cols-4"
    );

    // Base responsive grid
    orderListGrid.classList.add("grid-cols-1");

    const screenWidth = window.innerWidth;

    if (sidebarOpen) {
        if (screenWidth >= 1280) {
            orderListGrid.classList.add("sm:grid-cols-2", "lg:grid-cols-3");
        } else if (screenWidth >= 1024) {
            orderListGrid.classList.add("sm:grid-cols-2");
        } else if (screenWidth >= 640) {
            orderListGrid.classList.add("sm:grid-cols-1");
        }
    } else {
        orderListGrid.classList.add(
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
    //    "grid-cols-1",
    //    "sm:grid-cols-2",
    //    "lg:grid-cols-3",
    //    "xl:grid-cols-4"
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
        // Assuming addItemCard exists, otherwise remove or adjust this line
        const addItemCard = document.getElementById("addItemCard");
        if (addItemCard) addItemCard.classList.remove("hidden");
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
    const addItemCard = document.getElementById("addItemCard"); // Re-get it here in case it wasn't defined globally
    if (addItemCard) addItemCard.classList.toggle("hidden", noMatch);
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

    toggleSidebar(); // Assuming this opens the sidebarOrderedList

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
    calculateTotal();
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




function calculateTotal() {
    let subtotal = 0;

    Object.values(orderItems).forEach(item => {
        subtotal += item.price * item.quantity;
    });

    const tax = Math.floor(subtotal * 0.1); // misal 10% pajak
    const total = subtotal + tax;

    // Update tampilan subtotal dan pajak
    document.getElementById("subtotalAmount").textContent = formatRupiah(subtotal);
    document.getElementById("taxAmount").textContent = formatRupiah(tax);
}

// Fungsi ini akan dipanggil saat user menekan 'Continue Payment' di sidebar payment
function processPayment() {
    // 1. Ambil total yang harus dibayar
    const finalTotal = calculateTotal(); // Pastikan ini mengembalikan nilai total

    // 2. Ambil metode pembayaran yang dipilih
    let selectedPaymentMethod = null;
    const paymentCheckboxes = document.querySelectorAll('#paymentMethod input[type="checkbox"]');

    paymentCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedPaymentMethod = checkbox.value;
        }
    });

    // 3. Validasi: Pastikan metode pembayaran sudah dipilih
    if (!selectedPaymentMethod) {
        alert("Silakan pilih metode pembayaran terlebih dahulu!");
        return; // Hentikan proses jika belum ada yang dipilih
    }

    // 4. Lakukan sesuatu dengan data pembayaran (contoh: kirim ke backend)
    console.log("Total yang harus dibayar:", formatRupiah(finalTotal));
    console.log("Metode pembayaran dipilih:", selectedPaymentMethod);

    // Di sini kamu akan mengirimkan data ini ke backend (server)
    // Menggunakan fetch API seperti yang kamu lakukan di checkMembership()
    sendPaymentToServer(finalTotal, selectedPaymentMethod);

    // Setelah pembayaran berhasil, tampilkan modal sukses
    // showPaymentSuccessModal(); // Ini akan dipanggil setelah respons dari server
}

// Fungsi untuk mengirim data pembayaran ke server (ini contoh)
async function sendPaymentToServer(totalAmount, paymentMethod) {
    try {
        const response = await fetch('/process-payment', { // Ganti dengan endpoint API kamu
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                orderNumber: orderNumber, // Ambil dari variabel global orderNumber
                total: totalAmount,
                paymentMethod: paymentMethod,
                customerName: document.getElementById("customerName").value,
                customerPhone: document.getElementById("customerPhone").value,
                tableNumber: document.getElementById("table").value, // Jika ada
                items: Object.values(orderItems)
            })
        });

        const data = await response.json();

        if (response.ok) { // Jika respons dari server adalah sukses (status 2xx)
            console.log("Pembayaran berhasil:", data);
            showPaymentSuccessModal(); // Tampilkan modal sukses
            orderItems = {}; // Kosongkan keranjang
            renderOrderList(); // Perbarui tampilan keranjang
        } else {
            console.error("Pembayaran gagal:", data.message || "Terjadi kesalahan pada server.");
            alert("Pembayaran gagal: " + (data.message || "Mohon coba lagi."));
        }

    } catch (error) {
        console.error("Error saat mengirim pembayaran ke server:", error);
        alert("Terjadi kesalahan koneksi. Mohon coba lagi.");
    }
}

async function checkMembership() {
    const nameInput = document.getElementById("customerName");
    const phoneInput = document.getElementById("customerPhone");

    const name = nameInput.value;
    const phone = phoneInput.value;

    // Hide all membership cards and the "no membership" message initially
    document.getElementById("cardSilver").classList.add("hidden");
    document.getElementById("cardGold").classList.add("hidden");
    document.getElementById("cardPlatinum").classList.add("hidden");
    document.querySelector(".noMembership").classList.add("hidden");

    try {
        const res = await fetch("/check-membership", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ name, phone })
        });

        const data = await res.json();

        if (data.status === "found") {
            // Tampilkan sesuai membership
            if (data.membership === "Silver") {
                document.getElementById("cardSilver").classList.remove("hidden");
            } else if (data.membership === "Gold") {
                document.getElementById("cardGold").classList.remove("hidden");
            } else if (data.membership === "Platinum") {
                document.getElementById("cardPlatinum").classList.remove("hidden");
            }

            // Update nama, hp, dan poin
            document.querySelectorAll(".customerName").forEach(el => el.textContent = data.name);
            document.querySelectorAll(".customerPhone").forEach(el => el.textContent = data.phone);
            document.querySelectorAll(".customerPoint").forEach(el => el.textContent = data.points);
        } else {
            // Tampilkan "No membership yet"
            document.querySelector(".noMembership").classList.remove("hidden");
        }
    } catch (error) {
        console.error("Error checking membership:", error);
        // Fallback to showing "No membership yet" in case of API error
        document.querySelector(".noMembership").classList.remove("hidden");
    }
}