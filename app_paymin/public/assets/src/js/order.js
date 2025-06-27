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

// Function to render content of the modalInvoice
function renderInvoiceModal(invoiceData) {
    // Add defensive checks for all elements
    const invoiceTableNumberEl = document.getElementById("invoiceTableNumber");
    if (invoiceTableNumberEl)
        invoiceTableNumberEl.textContent = invoiceData.table_number || "N/A";
    else console.error("HTML element with ID 'invoiceTableNumber' not found!");

    const invoiceOrderNumberEl = document.getElementById("invoiceOrderNumber");
    if (invoiceOrderNumberEl)
        invoiceOrderNumberEl.textContent = invoiceData.order_number;

    const invoiceDateTimeEl = document.getElementById("invoiceDateTime");
    if (invoiceDateTimeEl)
        invoiceDateTimeEl.textContent = invoiceData.date_time;

    const invoiceItemsListEl = document.getElementById("invoiceOrderItemsList");
    if (invoiceItemsListEl) {
        invoiceItemsListEl.innerHTML = "";
        invoiceData.items.forEach((item) => {
            const itemRow = `
                <div class="grid grid-cols-4 p-2">
                    <div class="col-span-2">${item.name}</div>
                    <div>${item.quantity}</div>
                    <div class="text-right">${formatRupiah(item.subtotal)}</div>
                </div>
            `;
            invoiceItemsListEl.innerHTML += itemRow;
        });
    }

    const invoiceNotesEl = document.getElementById("invoiceNotes");
    if (invoiceNotesEl)
        invoiceNotesEl.textContent = invoiceData.notes || "No notes.";

    const invoiceSubtotalBeforeDiscountEl = document.getElementById(
        "invoiceSubtotalBeforeDiscount"
    );
    if (invoiceSubtotalBeforeDiscountEl)
        invoiceSubtotalBeforeDiscountEl.textContent = formatRupiah(
            invoiceData.raw_subtotal
        );

    const invoiceMembershipDiscountPercentageEl = document.getElementById(
        "invoiceMembershipDiscountPercentage"
    );
    if (invoiceMembershipDiscountPercentageEl) {
        invoiceMembershipDiscountPercentageEl.textContent =
            invoiceData.discount_percentage > 0
                ? `-${invoiceData.discount_percentage}%`
                : "Rp0";
    }

    const invoiceTaxAmountEl = document.getElementById("invoiceTaxAmount");
    if (invoiceTaxAmountEl)
        invoiceTaxAmountEl.textContent = formatRupiah(invoiceData.tax_amount);

    const invoiceBillAmountEl = document.getElementById("invoiceBillAmount");
    if (invoiceBillAmountEl)
        invoiceBillAmountEl.textContent = formatRupiah(invoiceData.bill_amount);

    const invoicePaymentMethodDisplayEl = document.getElementById(
        "invoicePaymentMethodDisplay"
    );
    if (invoicePaymentMethodDisplayEl) {
        invoicePaymentMethodDisplayEl.innerHTML = "";
        let iconSrc = "";
        let methodName = invoiceData.payment_method;

        switch (invoiceData.payment_method) {
            case "ShopeePay":
                iconSrc = "assets/src/assets/paymentIcons/logoShopeePay-01.png";
                break;
            case "Qris":
                iconSrc = "assets/src/assets/paymentIcons/qris.png";
                break;
            case "Dana":
                iconSrc = "assets/src/assets/paymentIcons/dana.png";
                break;
            case "Cash":
                iconSrc =
                    "https://img.icons8.com/color/48/000000/cash-in-hand.png";
                break;
            case "Muamalat":
                iconSrc = "assets/src/assets/paymentIcons/muamalat.png";
                break;
            case "BRI":
                iconSrc = "assets/src/assets/paymentIcons/bri.png";
                break;
            case "BCA":
                iconSrc = "assets/src/assets/paymentIcons/bca.png";
                break;
            default:
                iconSrc = "";
        }

        if (iconSrc) {
            invoicePaymentMethodDisplayEl.innerHTML = `<img src="${iconSrc}" class="w-6 h-6 mr-2" alt="${methodName} Icon" /><span>${methodName}</span>`;
        } else {
            invoicePaymentMethodDisplayEl.textContent = methodName;
        }
    }

    const invoiceCashReceivedEl = document.getElementById(
        "invoiceCashReceived"
    );
    if (invoiceCashReceivedEl)
        invoiceCashReceivedEl.textContent = formatRupiah(
            invoiceData.cash_received
        );

    const invoiceChangeAmountEl = document.getElementById(
        "invoiceChangeAmount"
    );
    if (invoiceChangeAmountEl)
        invoiceChangeAmountEl.textContent = formatRupiah(
            invoiceData.change_amount
        );
}

let currentTotalAmount = 0; // To store the total calculated before showing invoice modal
let currentPaymentMethod = null; // To store the selected payment method

async function processPaymentAndShowInvoice() {
    // 1. Ambil subtotal murni (tanpa pajak & diskon) dari item yang diorder
    let subtotalBeforeDiscountAndTax = 0;
    Object.values(orderItems).forEach((item) => {
        subtotalBeforeDiscountAndTax += item.price * item.quantity;
    });

    if (Object.keys(orderItems).length === 0) {
        alert("Keranjang masih kosong!");
        return;
    }

    // Get customer membership for discount calculation
    const customerPhone = document.getElementById("customerPhone").value;
    let customerMembershipType = "not_found";
    let discountPercentage = 0;

    const cardSilver = document.getElementById("cardSilver");
    const cardGold = document.getElementById("cardGold");
    const cardPlatinum = document.getElementById("cardPlatinum");

    if (cardSilver && !cardSilver.classList.contains("hidden")) {
        // Check if element exists before checking class
        customerMembershipType = "Silver";
        discountPercentage = 0.025;
    } else if (cardGold && !cardGold.classList.contains("hidden")) {
        // Check if element exists
        customerMembershipType = "Gold";
        discountPercentage = 0.05;
    } else if (cardPlatinum && !cardPlatinum.classList.contains("hidden")) {
        // Check if element exists
        customerMembershipType = "Platinum";
        discountPercentage = 0.1;
    }

    const discountAmount = Math.floor(
        subtotalBeforeDiscountAndTax * discountPercentage
    ); // Use Math.floor for consistency
    const subtotalAfterDiscount = subtotalBeforeDiscountAndTax - discountAmount;

    const taxAmount = Math.floor(subtotalAfterDiscount * 0.1); // Tax on discounted subtotal
    const finalTotal = subtotalAfterDiscount + taxAmount;

    // 2. Ambil metode pembayaran yang dipilih
    let selectedPaymentMethod = null;
    const paymentCheckboxes = document.querySelectorAll(
        '#paymentMethod input[type="checkbox"]'
    );

    paymentCheckboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedPaymentMethod = checkbox.value;
        }
    });

    // 3. Validasi: Pastikan metode pembayaran sudah dipilih
    // if (!selectedPaymentMethod) {
    //     alert("Silakan pilih metode pembayaran terlebih dahulu!");
    //     return;
    // }

    // Store these values globally for access when confirming from invoice modal
    currentTotalAmount = finalTotal;
    currentPaymentMethod = selectedPaymentMethod;

    // Prepare items array for display on invoice modal (notes might be here too)
    const itemsForDisplay = Object.values(orderItems).map((item) => {
        const itemTax = item.price * item.quantity * 0.1; // Individual item tax for invoice
        return {
            name: item.name,
            quantity: item.quantity,
            price: item.price, // Unit price
            subtotal: item.price * item.quantity, // Subtotal per line
            tax: itemTax,
            note: item.note || "", // Assuming notes can be added per item in renderOrderList
        };
    });

    // Populate data for the modalInvoice
    const invoiceData = {
        order_number: orderNumber, // Dari variabel global
        date_time: `${new Date().toLocaleDateString("id-ID", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
        })} | ${new Date().toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
        })}`,
        table_number: document.getElementById("table").value,
        items: itemsForDisplay, // Pastikan ini terisi dengan array item
        subtotal_before_discount: subtotalBeforeDiscountAndTax,
        discount_percentage: discountPercentage * 100,
        discount_amount: discountAmount,
        tax_amount: taxAmount,
        bill_amount: finalTotal,
        payment_method: selectedPaymentMethod,
        cash_received: 0, // Placeholder
        change_amount: 0, // Placeholder
        notes: "", // Jika ada catatan keseluruhan order, ambil dari input
    };
    console.log("Invoice Data being passed:", invoiceData); // <--- TAMBAHKAN INI

    renderInvoiceModal(invoiceData); // Panggil fungsi rendering
    showModal("modalInvoice"); // Tampilkan modal
}

// This function will be called when the "Confirm" button in modalInvoice is clicked
async function processPaymentAndShowFinish() {
    // Validate currentSaleDataForDisplay is set
    if (!currentSaleDataForDisplay) {
        alert("Data pesanan tidak ditemukan. Mohon ulangi proses dari awal.");
        closeModal("modalInvoice");
        return;
    }

    // If it's a cash payment, prompt for cash received and calculate change
    if (currentSaleDataForDisplay.payment_method === "Cash") {
        let cashReceivedInput = prompt(
            `Total pembayaran: ${formatRupiah(
                currentSaleDataForDisplay.bill_amount
            )}\nMasukkan jumlah uang tunai yang diterima:`
        );
        let cashReceived = parseFloat(cashReceivedInput);

        if (
            isNaN(cashReceived) ||
            cashReceived < currentSaleDataForDisplay.bill_amount
        ) {
            alert(
                "Jumlah uang tunai tidak valid atau kurang dari total pembayaran. Pembayaran dibatalkan."
            );
            return; // Stop the process if invalid cash received
        }
        currentSaleDataForDisplay.cash_received = cashReceived;
        currentSaleDataForDisplay.change_amount =
            cashReceived - currentSaleDataForDisplay.bill_amount;
    }

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')
            ? document
                  .querySelector('meta[name="csrf-token"]')
                  .getAttribute("content")
            : "";
        if (!csrfToken) {
            console.error("CSRF token meta tag not found!");
            alert("Terjadi kesalahan keamanan. Mohon refresh halaman.");
            return;
        }

        const response = await fetch("/process-payment", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                orderNumber: currentSaleDataForDisplay.order_number,
                total: currentSaleDataForDisplay.bill_amount, // Final total
                subtotal_before_discount:
                    currentSaleDataForDisplay.raw_subtotal,
                tax_amount: currentSaleDataForDisplay.tax_amount,
                discount_amount: currentSaleDataForDisplay.discount_amount,
                customer_membership:
                    currentSaleDataForDisplay.customer_membership,
                paymentMethod: currentSaleDataForDisplay.payment_method,
                customerName: currentSaleDataForDisplay.customer_name,
                customerPhone: currentSaleDataForDisplay.customer_phone,
                tableNumber: currentSaleDataForDisplay.table_number,
                sale_type: currentSaleDataForDisplay.sale_type,
                cash_received: currentSaleDataForDisplay.cash_received,
                change_amount: currentSaleDataForDisplay.change_amount,
                items: currentSaleDataForDisplay.items,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            console.log("Pembayaran berhasil dan dikonfirmasi:", data);

            renderFinishSidebar(data); // Pass backend response data to render finish sidebar

            closeModal("modalInvoice"); // Close the invoice modal
            // These might be redundant as renderFinishSidebar shows the finishAside
            // document.getElementById("sidebarPayment")?.classList.add("hidden");
            // document.getElementById("sidebarFinish")?.classList.remove("hidden");

            showPaymentSuccessAnimation(); // Show the small transient success animation

            // Reset frontend state after successful payment
            orderItems = {};
            renderOrderList(); // This will also hide the orderedList sidebar if empty
            document.getElementById("customerName").value = "";
            document.getElementById("customerPhone").value = "";
            document.getElementById("table").value = "";
            document.getElementById("cardSilver")?.classList.add("hidden");
            document.getElementById("cardGold")?.classList.add("hidden");
            document.getElementById("cardPlatinum")?.classList.add("hidden");
            document.querySelector(".noMembership")?.classList.add("hidden");
        } else {
            console.error(
                "Konfirmasi pembayaran gagal:",
                data.message || "Terjadi kesalahan pada server."
            );
            alert(
                "Konfirmasi pembayaran gagal: " +
                    (data.message || "Mohon coba lagi.")
            );
        }
    } catch (error) {
        console.error("Error saat mengkonfirmasi pembayaran ke server:", error);
        alert("Terjadi kesalahan koneksi. Mohon coba lagi.");
    }
}

// This function will be called when the "Confirm" button in modalInvoice is clicked
async function processPaymentAndShowFinish() {
    // If it's a cash payment, we need to prompt for cash received and calculate change
    if (currentPaymentMethod === "Cash") {
        let cashReceived = prompt(
            `Total pembayaran: ${formatRupiah(
                currentTotalAmount
            )}\nMasukkan jumlah uang tunai yang diterima:`
        );
        cashReceived = parseFloat(cashReceived);

        if (isNaN(cashReceived) || cashReceived < currentTotalAmount) {
            alert(
                "Jumlah uang tunai tidak valid atau kurang dari total pembayaran."
            );
            return;
        }
        currentSaleDataForDisplay.cash_received = cashReceived;
        currentSaleDataForDisplay.change_amount =
            cashReceived - currentTotalAmount;
    }

    // Send the final payment data to the server
    const saleType = document.getElementById("dinein").checked
        ? "dine_in"
        : document.getElementById("togo").checked
        ? "take_away"
        : null;

    const itemsToSend = [];
    for (const productId in orderItems) {
        if (orderItems.hasOwnProperty(productId)) {
            const item = orderItems[productId];
            itemsToSend.push({
                product_id: productId, // Assuming your productId is the actual product ID from DB
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                // note: item.note // if you're collecting notes
            });
        }
    }

    try {
        const response = await fetch("/process-payment", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                orderNumber: currentSaleDataForDisplay.order_number,
                total: currentSaleDataForDisplay.bill_amount, // Final total
                subtotal_before_discount:
                    currentSaleDataForDisplay.subtotal_before_discount,
                tax_amount: currentSaleDataForDisplay.tax_amount,
                discount_amount: currentSaleDataForDisplay.discount_amount,
                customer_membership:
                    currentSaleDataForDisplay.customer_membership,
                paymentMethod: currentSaleDataForDisplay.payment_method,
                customerName: document.getElementById("customerName").value,
                customerPhone: document.getElementById("customerPhone").value,
                tableNumber: document.getElementById("table").value,
                sale_type: saleType,
                cash_received: currentSaleDataForDisplay.cash_received, // Send cash received
                change_amount: currentSaleDataForDisplay.change_amount, // Send change amount
                items: itemsToSend,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            console.log("Pembayaran berhasil dan dikonfirmasi:", data);
            // Now, display the sidebarFinish using the data
            // Update currentSaleDataForDisplay with any backend-generated data if needed
            // e.g., data.order_number might be different, or other finalized values
            // In this case, your backend already returns comprehensive data, so use that directly:
            showPaymentSuccessModal(data); // This now populates sidebarFinish
            closeModal("modalInvoice"); // Close the invoice modal

            // Reset frontend state after successful payment
            orderItems = {};
            renderOrderList();
            document.getElementById("customerName").value = "";
            document.getElementById("customerPhone").value = "";
            document.getElementById("table").value = "";
            document.getElementById("cardSilver").classList.add("hidden");
            document.getElementById("cardGold").classList.add("hidden");
            document.getElementById("cardPlatinum").classList.add("hidden");
            document.querySelector(".noMembership").classList.add("hidden");
        } else {
            console.error(
                "Konfirmasi pembayaran gagal:",
                data.message || "Terjadi kesalahan pada server."
            );
            alert(
                "Konfirmasi pembayaran gagal: " +
                    (data.message || "Mohon coba lagi.")
            );
        }
    } catch (error) {
        console.error("Error saat mengkonfirmasi pembayaran ke server:", error);
        alert("Terjadi kesalahan koneksi. Mohon coba lagi.");
    }
}

async function orderNext() {
    const orderAside = document.getElementById("sidebarOrderedList");
    const paymentAside = document.getElementById("sidebarPayment");

    // Call checkMembership before transitioning to the payment screen
    checkMembership();

    orderAside.classList.add("hidden");
    paymentAside.classList.remove("hidden");

    processPaymentAndShowInvoice();
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

// function showPaymentSuccessModal() {

//     paymentSuccess.classList.remove("hidden");

//     setTimeout(() => {
//         paymentSuccess.classList.add("hidden");
//     }, 3500);

//     const invoiceModal = document.getElementById("modalInvoice");
//     invoiceModal.classList.add("hidden");

//     const paymentAside = document.getElementById("sidebarPayment");
//     paymentAside.classList.add("hidden");

//     const finishAside = document.getElementById("sidebarFinish");
//     finishAside.classList.remove("hidden");

//     // orderList.classList.remove(
//     //    "grid-cols-1",
//     //    "sm:grid-cols-2",
//     //    "lg:grid-cols-3",
//     //    "xl:grid-cols-4"
//     // );
// }

function showPaymentSuccessModal(saleData) {
    const paymentAside = document.getElementById("sidebarPayment");
    const finishAside = document.getElementById("sidebarFinish");

    paymentAside.classList.add("hidden"); // Hide payment sidebar
    finishAside.classList.remove("hidden"); // Show finish sidebar

    // Populate the finish sidebar with the saleData
    renderFinishSidebar(saleData);

    // Optional: tiny success message pop-up
    const paymentSuccessMessage = document.getElementById("modalOrderFinish");
    if (paymentSuccessMessage) {
        paymentSuccessMessage.classList.remove("hidden");
        setTimeout(() => {
            paymentSuccessMessage.classList.add("hidden");
        }, 3500);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const itemCards = document.querySelectorAll(".itemCard");

    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");

            itemCards.forEach((card) => {
                const category = card.getAttribute("data-category");

                if (filter === "all" || category === filter) {
                    card.classList.remove("hidden");
                } else {
                    card.classList.add("hidden");
                }
            });

            // Optional: Tambah highlight button aktif
            filterButtons.forEach((btn) =>
                btn.classList.remove(
                    "bg-[#FFB09F]",
                    "text-primary",
                    "border-primary"
                )
            );
            this.classList.add(
                "bg-[#FFB09F]",
                "text-primary",
                "border-primary"
            );
        });
    });
});

function searchTable() {
    const input = document
        .getElementById("searchInput")
        .value.toLowerCase()
        .trim();
    const cards = document.querySelectorAll(".itemCard");
    const noResults = document.getElementById("noResultsMessage");

    if (input === "") {
        cards.forEach((card) => card.classList.remove("hidden"));
        noResults.classList.add("hidden");
        // Assuming addItemCard exists, otherwise remove or adjust this line
        const addItemCard = document.getElementById("addItemCard");
        if (addItemCard) addItemCard.classList.remove("hidden");
        return;
    }

    let found = 0;
    cards.forEach((card) => {
        const name =
            card.querySelector(".item-name")?.textContent.toLowerCase() || "";
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
let currentSaleDataForDisplay = null;

// Format harga jadi "Rp. 20.000"
function formatRupiah(angka) {
    // return new Intl.NumberFormat("id-ID", {
    //     style: "currency",
    //     currency: "IDR",
    // })
    //     .format(angka)
    //     .replace(",00", "");
    if (typeof angka !== "number") {
        // Basic check for number type
        return "Rp. 0";
    }
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    })
        .format(angka)
        .replace(",00", "");
}

// Fungsi tambah item
function addItemToOrder(productId, name, price, imageUrl) {
    if (Object.keys(orderItems).length === 0) {
        orderNumber = generateOrderNumber();
        updateDateTime();
    }

    // Ensure sidebar is visible when an item is added
    const sidebar = document.getElementById("sidebarOrderedList");
    if (sidebar && sidebar.classList.contains("hidden")) {
        sidebar.classList.remove("hidden");
    }

    if (!orderItems[productId]) {
        orderItems[productId] = {
            id: productId, // Store product ID for backend
            name,
            price: parseInt(price),
            quantity: 1,
            imageUrl,
        };
    } else {
        orderItems[productId].quantity++;
    }

    renderOrderList();
}

// Tambah jumlah
function incrementItem(productId) {
    if (orderItems[productId]) {
        // Ensure item exists
        orderItems[productId].quantity++;
        renderOrderList();
    }
}

// Kurangi jumlah
function decrementItem(productId) {
    if (orderItems[productId]) {
        // Ensure item exists
        orderItems[productId].quantity--;
        if (orderItems[productId].quantity <= 0) {
            delete orderItems[productId];
        }
        renderOrderList();
    }
}

function renderOrderList() {
    const container = document.getElementById("orderedList");
    if (!container) return; // Add null check

    container.innerHTML = "";

    const sidebar = document.getElementById("sidebarOrderedList");

    if (Object.keys(orderItems).length === 0) {
        // If no items, hide the sidebar, or show a message inside it
        if (sidebar) sidebar.classList.add("hidden");
        return;
    }

    if (sidebar) sidebar.classList.remove("hidden"); // Ensure sidebar is visible when items exist

    for (const [id, item] of Object.entries(orderItems)) {
        const total = item.price * item.quantity;

        container.innerHTML += `
            <div class="flex flex-col items-center w-full mt-2">
                <div class="flex justify-between w-full h-[60px]">
                    <div class="flex items-center justify-center w-[5em]">
                        <img src="${item.imageUrl}" alt="${
            item.name
        }" class="w-full object-cover h-full" />
                    </div>
                    <div class="w-auto">
                        <h1 class="text-textColor text-lg font-semibold overflow-hidden text-ellipsis whitespace-nowrap w-[70%]">${
                            item.name
                        }</h1>
                        <p class="text-textColor text-sm w-auto">${formatRupiah(
                            item.price
                        )}</p>
                    </div>
                    <div class="w-auto">
                        <h1 class="text-primary text-2xl font-bold">${formatRupiah(
                            total
                        )}</h1>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-1 w-full">
                    <button class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold" onclick="decrementItem('${id}')">-</button>
                    <span class="text-lg font-semibold w-8 text-center">${
                        item.quantity
                    }</span>
                    <button class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold" onclick="incrementItem('${id}')">+</button>
                </div>
                <div class="flex justify-between items-center w-full h-12 mt-2">
                    <form onsubmit="return false;"> <!-- Prevent form submission on enter key -->
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
    calculateTotal(); // Update totals in the sidebar
}

// Function to update date and time display
function updateDateTime() {
    const now = new Date();
    const formattedDate = now.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
    const formattedTime = now.toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
    });
    const fullText = `${orderNumber} | ${formattedDate} | ${formattedTime}`;
    document.querySelectorAll(".currentDateTime").forEach((el) => {
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
    Object.values(orderItems).forEach((item) => {
        subtotal += item.price * item.quantity;
    });

    const tax = Math.floor(subtotal * 0.1); // Assuming 10% tax
    // The total here is the 'raw' total before any membership discount for display on order list
    const total = subtotal + tax;

    const subtotalAmountEl = document.getElementById("subtotalAmount");
    const taxAmountEl = document.getElementById("taxAmount");

    if (subtotalAmountEl) subtotalAmountEl.textContent = formatRupiah(subtotal);
    if (taxAmountEl) taxAmountEl.textContent = formatRupiah(tax);

    // Return the calculated values for use in processing functions
    return { subtotal, tax, total };
}

// Fungsi ini akan dipanggil saat user menekan 'Continue Payment' di sidebar payment
function processPayment() {
    // 1. Ambil subtotal murni (tanpa pajak & diskon) dari item yang diorder
    let subtotalBeforeDiscountAndTax = 0;
    Object.values(orderItems).forEach((item) => {
        subtotalBeforeDiscountAndTax += item.price * item.quantity;
    });

    // Get customer membership for discount calculation
    const customerPhone = document.getElementById("customerPhone").value;
    let customerMembershipType = "not_found"; // Default
    let discountPercentage = 0;

    // Check if customer is a member and apply discount
    // This part assumes checkMembership() has already run and updated global state or you re-fetch
    // For simplicity, let's assume we can get it from the customer data we might have fetched.
    // A more robust solution might pass the customer's membership status from `checkMembership` to `orderNext`
    // and then to `processPayment` via a global variable or parameter.
    // For now, we'll quickly determine it again (though less efficient).
    // Better: have a global variable for current logged-in customer's membership
    const cardSilver = document.getElementById("cardSilver");
    const cardGold = document.getElementById("cardGold");
    const cardPlatinum = document.getElementById("cardPlatinum");

    if (!cardSilver.classList.contains("hidden")) {
        customerMembershipType = "Silver";
        discountPercentage = 0.025;
    } else if (!cardGold.classList.contains("hidden")) {
        customerMembershipType = "Gold";
        discountPercentage = 0.05;
    } else if (!cardPlatinum.classList.contains("hidden")) {
        customerMembershipType = "Platinum";
        discountPercentage = 0.1;
    }

    const discountAmount = subtotalBeforeDiscountAndTax * discountPercentage;
    const subtotalAfterDiscount = subtotalBeforeDiscountAndTax - discountAmount;

    const taxAmount = Math.floor(subtotalAfterDiscount * 0.1); // Tax on discounted subtotal
    const finalTotal = subtotalAfterDiscount + taxAmount;

    // 2. Ambil metode pembayaran yang dipilih
    let selectedPaymentMethod = null;
    const paymentCheckboxes = document.querySelectorAll(
        '#paymentMethod input[type="checkbox"]'
    );

    paymentCheckboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedPaymentMethod = checkbox.value;
        }
    });

    // 3. Validasi: Pastikan metode pembayaran sudah dipilih
    if (!selectedPaymentMethod) {
        alert("Silakan pilih metode pembayaran terlebih dahulu!");
        return;
    }

    // Send all calculated data and membership info to the server
    sendPaymentToServer(
        finalTotal,
        selectedPaymentMethod,
        subtotalBeforeDiscountAndTax, // Send original subtotal
        taxAmount,
        discountAmount,
        customerMembershipType // Send the membership type for backend record
    );
}

// Function to send payment data to the server
async function sendPaymentToServer(
    finalTotal,
    paymentMethod,
    subtotalBeforeDiscount,
    taxAmount,
    discountAmount,
    customerMembershipType
) {
    // ... (existing saleType detection)

    // Prepare items array for backend, including product_id
    const itemsToSend = [];
    for (const productId in orderItems) {
        if (orderItems.hasOwnProperty(productId)) {
            const item = orderItems[productId];
            itemsToSend.push({
                product_id: productId, // Assuming your productId is the actual product ID from DB
                name: item.name,
                price: item.price,
                quantity: item.quantity,
            });
        }
    }

    try {
        const response = await fetch("/process-payment", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                orderNumber: orderNumber,
                total: finalTotal, // This is the discounted total + tax
                subtotal_before_discount: subtotalBeforeDiscount, // Original subtotal
                tax_amount: taxAmount,
                discount_amount: discountAmount,
                customer_membership: customerMembershipType, // Send membership type
                paymentMethod: paymentMethod,
                customerName: document.getElementById("customerName").value,
                customerPhone: document.getElementById("customerPhone").value,
                tableNumber: document.getElementById("table").value,
                sale_type: saleType,
                items: itemsToSend,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            console.log("Pembayaran berhasil:", data);
            // Pass *all necessary data* to showPaymentSuccessModal
            // The response from the server should ideally contain the full sale details too
            // For now, we'll augment the response data with frontend calculated values if needed
            // OR better, make your Laravel endpoint return all these details
            const saleDataForFinish = {
                order_number: data.order_number, // From backend response
                total_paid: data.total_paid, // From backend response
                payment_method: data.payment_method, // From backend response
                items: orderItems, // Use the current order items (or ideally, backend sends them back)
                subtotal_before_discount: subtotalBeforeDiscount,
                tax_amount: taxAmount,
                discount_amount: discountAmount,
                customer_membership: customerMembershipType,
            };
            showPaymentSuccessModal(saleDataForFinish);

            orderItems = {}; // Clear the cart
            renderOrderList(); // Update cart display
            document.getElementById("customerName").value = "";
            document.getElementById("customerPhone").value = "";
            document.getElementById("table").value = "";
            document.getElementById("cardSilver").classList.add("hidden");
            document.getElementById("cardGold").classList.add("hidden");
            document.getElementById("cardPlatinum").classList.add("hidden");
            document.querySelector(".noMembership").classList.add("hidden");
        } else {
            console.error(
                "Pembayaran gagal:",
                data.message || "Terjadi kesalahan pada server."
            );
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

    const name = nameInput ? nameInput.value : "";
    const phone = phoneInput ? phoneInput.value : "";

    const silverCard = document.getElementById("cardSilver");
    const goldCard = document.getElementById("cardGold");
    const platinumCard = document.getElementById("cardPlatinum");
    const noMembershipDiv = document.querySelector(".noMembership");

    // Hide all cards and noMembership message first
    if (silverCard) silverCard.classList.add("hidden");
    if (goldCard) goldCard.classList.add("hidden");
    if (platinumCard) platinumCard.classList.add("hidden");
    if (noMembershipDiv) noMembershipDiv.classList.add("hidden");

    // Clear customer info displays
    document
        .querySelectorAll(".customerName")
        .forEach((el) => (el.textContent = ""));
    document
        .querySelectorAll(".customerPhone")
        .forEach((el) => (el.textContent = ""));
    document
        .querySelectorAll(".customerPoint")
        .forEach((el) => (el.textContent = ""));

    // Only proceed if name AND phone are provided
    if (!name || !phone) {
        if (noMembershipDiv) noMembershipDiv.classList.remove("hidden"); // Show "No membership" if input is empty
        return;
    }

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')
            ? document
                  .querySelector('meta[name="csrf-token"]')
                  .getAttribute("content")
            : "";
        if (!csrfToken) {
            console.error("CSRF token meta tag not found!");
            if (noMembershipDiv) noMembershipDiv.classList.remove("hidden");
            return;
        }

        const res = await fetch("/check-membership", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({ name, phone }),
        });

        const data = await res.json();

        if (data.status === "found") {
            if (data.membership === "Silver") {
                if (silverCard) silverCard.classList.remove("hidden");
            } else if (data.membership === "Gold") {
                if (goldCard) goldCard.classList.remove("hidden");
            } else if (data.membership === "Platinum") {
                if (platinumCard) platinumCard.classList.remove("hidden");
            }

            document
                .querySelectorAll(".customerName")
                .forEach((el) => (el.textContent = data.name));
            document
                .querySelectorAll(".customerPhone")
                .forEach((el) => (el.textContent = data.phone));
            document
                .querySelectorAll(".customerPoint")
                .forEach((el) => (el.textContent = data.points));
        } else {
            if (noMembershipDiv) noMembershipDiv.classList.remove("hidden");
        }
    } catch (error) {
        console.error("Error checking membership:", error);
        if (noMembershipDiv) noMembershipDiv.classList.remove("hidden");
    }
}

let currentSaleData = null;

function showPaymentSuccessModal(saleData) {
    currentSaleData = saleData; // Store the sale data globally

    const invoiceModal = document.getElementById("modalInvoice"); // This refers to the modal, not the sidebarFinish
    invoiceModal.classList.add("hidden"); // Ensure the invoice modal is hidden

    const paymentAside = document.getElementById("sidebarPayment");
    paymentAside.classList.add("hidden"); // Hide payment sidebar

    const finishAside = document.getElementById("sidebarFinish");
    finishAside.classList.remove("hidden"); // Show finish sidebar

    // Now, populate the finish sidebar with the saleData
    renderFinishSidebar(saleData);

    // After rendering, you can still show the tiny success message if you want,
    // but the primary action is to display the finish sidebar
    const paymentSuccessMessage = document.getElementById("modalOrderFinish"); // Assuming this is your tiny success pop-up
    if (paymentSuccessMessage) {
        paymentSuccessMessage.classList.remove("hidden");
        setTimeout(() => {
            paymentSuccessMessage.classList.add("hidden");
        }, 3500);
    }
}

function renderFinishSidebar(saleData) {
    const finishOrderNumberEl = document.getElementById("finishOrderNumber");
    const finishDateTimeEl = document.getElementById("finishDateTime");
    const finishOrderItemsTableBodyEl = document.getElementById(
        "finishOrderItemsTableBody"
    );
    const finishPaymentMethodDisplayEl = document.getElementById(
        "finishPaymentMethodDisplay"
    );
    const finishSubtotalEl = document.getElementById("finishSubtotal");
    const finishOrderDiscountEl = document.getElementById(
        "finishOrderDiscount"
    );
    const finishTaxEl = document.getElementById("finishTax");
    const finishBillAmountEl = document.getElementById("finishBillAmount");
    const finishCashReceivedEl = document.getElementById("finishCashReceived"); // Added ID check
    const finishChangeAmountEl = document.getElementById("finishChangeAmount"); // Added ID check

    // Ensure the finish sidebar is visible
    const finishAside = document.getElementById("sidebarFinish");
    const paymentAside = document.getElementById("sidebarPayment");
    if (paymentAside) paymentAside.classList.add("hidden");
    if (finishAside) finishAside.classList.remove("hidden");

    // Populate Order Number and Date/Time
    if (finishOrderNumberEl)
        finishOrderNumberEl.textContent = saleData.order_number;
    // Assuming sale_date from backend is ISO string compatible
    if (finishDateTimeEl) {
        const saleDate = new Date(saleData.sale_date);
        finishDateTimeEl.textContent = `${saleDate.toLocaleDateString("id-ID", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
        })} | ${saleDate.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
        })}`;
    }

    // Populate Order Items Table
    if (finishOrderItemsTableBodyEl) {
        finishOrderItemsTableBodyEl.innerHTML = "";
        saleData.items.forEach((item) => {
            const itemTaxForDisplay = item.price * item.quantity * 0.1; // Re-calculate tax per item for display on finish screen
            const row = `
                <tr class="border-b border-tertiary h-[3rem]">
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${formatRupiah(itemTaxForDisplay)}</td>
                    <td>${formatRupiah(item.price * item.quantity)}</td>
                </tr>
            `;
            finishOrderItemsTableBodyEl.innerHTML += row;
        });
    }

    // Populate Payment Method display with icon
    if (finishPaymentMethodDisplayEl) {
        finishPaymentMethodDisplayEl.innerHTML = "";
        let iconSrc = "";
        let methodName = saleData.payment_method; // Use the raw payment method from backend

        switch (saleData.payment_method) {
            case "ShopeePay":
                iconSrc = "assets/src/assets/paymentIcons/logoShopeePay-01.png";
                break;
            case "Qris":
                iconSrc = "assets/src/assets/paymentIcons/qris.png";
                break;
            case "Dana":
                iconSrc = "assets/src/assets/paymentIcons/dana.png";
                break;
            case "Cash":
                iconSrc =
                    "https://img.icons8.com/color/48/000000/cash-in-hand.png";
                break;
            case "Muamalat":
                iconSrc = "assets/src/assets/paymentIcons/muamalat.png";
                break;
            case "BRI":
                iconSrc = "assets/src/assets/paymentIcons/bri.png";
                break;
            case "BCA":
                iconSrc = "assets/src/assets/paymentIcons/bca.png";
                break;
            default:
                iconSrc = "";
        }

        if (iconSrc) {
            finishPaymentMethodDisplayEl.innerHTML = `<img src="${iconSrc}" alt="${methodName}" class="w-5 h-5 mr-2" />${methodName}`;
        } else {
            finishPaymentMethodDisplayEl.textContent = methodName;
        }
    }

    // Populate Totals
    if (finishSubtotalEl)
        finishSubtotalEl.textContent = formatRupiah(
            saleData.subtotal_before_discount
        );
    if (finishOrderDiscountEl)
        finishOrderDiscountEl.textContent = formatRupiah(
            saleData.discount_amount
        );
    if (finishTaxEl)
        finishTaxEl.textContent = formatRupiah(saleData.tax_amount);
    if (finishBillAmountEl)
        finishBillAmountEl.textContent = formatRupiah(saleData.total_paid);

    // If it was a cash payment, show cash received and change
    if (finishCashReceivedEl)
        finishCashReceivedEl.textContent = formatRupiah(
            saleData.cash_received || 0
        );
    if (finishChangeAmountEl)
        finishChangeAmountEl.textContent = formatRupiah(
            saleData.change_amount || 0
        );
}
