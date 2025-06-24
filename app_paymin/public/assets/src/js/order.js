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