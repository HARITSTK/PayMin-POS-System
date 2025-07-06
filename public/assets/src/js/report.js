const dropdown = document.getElementById("sortingDropdown");
const menu = document.getElementById("sortingMenu");
const arrow = document.getElementById("arrow");
const items = document.querySelectorAll(".dropdown-item");

dropdown.addEventListener("click", () => {
    menu.classList.toggle("hidden");
    arrow.classList.toggle("-rotate-135");
    arrow.classList.toggle("rotate-45");
});

window.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target)) {
        menu.classList.add("hidden");
        arrow.classList.remove("-rotate-135");
        arrow.classList.add("rotate-45");
    }
});

items.forEach((item) => {
    item.addEventListener("click", () => {
        items.forEach((i) => {
            i.classList.remove("bg-orange-500", "text-white", "bg-orange-200");
            i.classList.add("text-gray-800");
            i.classList.add("hover:bg-gray-50");
        });

        item.classList.remove("text-gray-800", "hover:bg-gray-50");
        item.classList.add("bg-orange-500", "text-white");
        item.classList.remove("hover:bg-gray-50");
        item.classList.add("hover:bg-orange-600");

        const nextItem = item.nextElementSibling;
        if (nextItem && nextItem.classList.contains("dropdown-item")) {
            nextItem.classList.remove("text-gray-800", "hover:bg-gray-50");
            nextItem.setAttribute("style", "background-color: #FDAE9D");
            nextItem.classList.remove("hover:bg-gray-50");
            nextItem.classList.add("hover:bg-orange-300");
        }

        dropdown.querySelector("span").textContent = item.textContent;
        menu.classList.add("hidden");
        arrow.classList.remove("-rotate-135");
        arrow.classList.add("rotate-45");
    });
});

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
    const icon = document.querySelector(".status-icon");
    icon.addEventListener("click", function () {
        if (icon.textContent.trim() === "checklist") {
            icon.textContent = "close";
            icon.style.color = "#f44336";
        } else {
            icon.textContent = "checklist";
            icon.style.color = "#4caf50";
        }
    });
});

function filterByDate() {
    const selectedDate = document.getElementById("dateFilter").value;
    const rows = document.querySelectorAll("#tableBody tr");

    let hasVisibleRow = false;
    let totalIncome = 0;
    let moneyOut = 0;
    let totalItemSold = 0;
    let totalTransaction = 0;
    const customerSet = new Set();

    rows.forEach((row) => {
        const rowDate = row.dataset.date;

        if (selectedDate === "" || rowDate === selectedDate) {
            row.style.display = "";
            hasVisibleRow = true;

            const rowTotal = parseInt(row.dataset.total || "0");
            const rowMoneyOut = parseInt(row.dataset.moneyout || "0");
            const rowQty = parseInt(row.dataset.qty || "0");
            const rowCustomer = row.dataset.customer || "-";

            totalIncome += rowTotal;
            moneyOut += rowMoneyOut;
            totalItemSold += rowQty;

            if (rowCustomer && rowCustomer !== "-") {
                customerSet.add(rowCustomer);
            }
        } else {
            row.style.display = "none";
        }
    });


    // Format angka (ribuan)
    const numberFormat = (num) => num.toLocaleString("id-ID");

    // Update card
    document.getElementById("cardTotalIncome").textContent = `Rp. ${numberFormat(totalIncome)}`;
    document.getElementById("cardTotalMoneyOut").textContent = `-Rp. ${numberFormat(moneyOut)}`;
    document.getElementById("cardTotalItemSell").textContent = numberFormat(totalItemSold) ;
    document.getElementById("cardTotalCustomers").textContent = numberFormat(customerSet.size);

    // // Jika kamu punya card total transaksi
    // const transactionCard = document.getElementById("cardTotalTransaction");
    // if (transactionCard) {
    //     transactionCard.textContent = `${numberFormat(totalTransaction)} Transaksi`;
    // }

    // Saldo akhir
    const beginningBalance = parseInt(document.getElementById('cardTotalBegginingBalance')?.dataset?.value || "0");
    const finalBalance = beginningBalance;
    document.getElementById("cardTotalBegginingBalance").textContent = `Rp. ${numberFormat(finalBalance)}`;

    // Tampilkan/ sembunyikan pesan jika tidak ada data
    const noDataDiv = document.getElementById("noDataRow");
    if (noDataDiv) {
        noDataDiv.style.display = hasVisibleRow ? "none" : "flex";
    }
}


function numberFormat(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function filterByUser() {
    const selectedUser = document
        .getElementById("userFilter")
        .value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");
    let visibleCount = 0;

    rows.forEach((row) => {
        const user = (row.dataset.user || "").toLowerCase();

        if (selectedUser === "all" || user === selectedUser) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    // Tampilkan / sembunyikan row "No Data"
    const noDataRow = document.getElementById("noDataRow");
    if (noDataRow) {
        noDataRow.style.display = visibleCount === 0 ? "table-row" : "none";
    }

    // Hitung ulang isi card berdasarkan baris yang terlihat
    updateCards();
}

function updateCards() {
    const rows = document.querySelectorAll("#tableBody tr");
    let income = 0;
    let items = 0;
    const customers = new Set();

    rows.forEach((row) => {
        if (row.style.display !== "none" && !row.id.includes("noDataRow")) {
            const total = parseInt(row.dataset.total || "0");
            const qty = parseInt(row.dataset.qty || "0");
            const customer = row.dataset.customer || null;

            income += total;
            items += qty;
            if (customer) customers.add(customer);
        }
    });

    // Format dan tampilkan ke card
    document.getElementById("cardTotalIncome").textContent =
        "Rp. " + income.toLocaleString("id-ID");
    document.getElementById("cardTotalItemSell").textContent =
        items.toLocaleString("id-ID");
    document.getElementById("cardTotalCustomers").textContent =
        customers.size.toLocaleString("id-ID");
}

function filterByShift() {
    const selectedShift = document
        .getElementById("shiftFilter")
        .value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");
    let visibleCount = 0;

    rows.forEach((row) => {
        const shift = (row.dataset.shift || "").toLowerCase();

        if (selectedShift === "all" || shift === selectedShift) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    // Optional: Tampilkan pesan jika tidak ada hasil
    const noDataRow = document.getElementById("noDataRow");
    if (noDataRow) {
        noDataRow.style.display = visibleCount === 0 ? "table-row" : "none";
    }
}

function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");
    let visibleCount = 0;

    rows.forEach((row) => {
        const rowText = row.textContent.toLowerCase();

        if (rowText.includes(input)) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    const noDataRow = document.getElementById("noDataRow");
    if (noDataRow) {
        noDataRow.style.display = visibleCount === 0 ? "table-row" : "none";
    }
}

function showTransactionModal(button) {
    const id = button.dataset.id;
    const user = button.dataset.user;
    const date = button.dataset.date;
    const customer = button.dataset.customer;
    const items = JSON.parse(button.dataset.items || "[]");
    const payment = button.dataset.payment;
    const type = button.dataset.type;
    const amount = button.dataset.amount;

    document.getElementById("modalTransId").textContent = "#" + id;
    document.getElementById("modalUser").textContent = user;
    document.getElementById("modalDate").textContent = date;
    document.getElementById("modalCustomer").textContent = customer;
    document.getElementById("modalPayment").textContent = payment;
    document.getElementById("modalType").textContent = type;
    document.getElementById("modalAmount").textContent = amount;

    const itemContainer = document.getElementById("modalItems");
    itemContainer.innerHTML = "";
    items.forEach((item) => {
        const p = document.createElement("p");
        p.textContent = `${item.name} ${item.qty}x`;
        itemContainer.appendChild(p);
    });

    showModal("modalViewItem");
}

function setDeleteTransaction(id) {
    document.getElementById("deleteTransactionId").value = id;
    document.getElementById("deleteTransactionText").textContent = id;
    showModal("modalDeleteItem");
}
