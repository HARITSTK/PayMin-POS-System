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
const sidebar = document.getElementById("sidebar");
let sidebarOpen = false;

function toggleSidebar() {
  sidebarOpen = !sidebarOpen;

  if (sidebarOpen) {
    sidebar.classList.add("active");

    sidebar.classList.remove("fixed");
  } else {
    sidebar.classList.remove("active");
    setTimeout(() => {
      sidebar.classList.add("fixed");
    }, 200);
  }

  adjustGridColumns();
}

// Function to adjust grid columns based on screen width and sidebar state
function adjustGridColumns() {
  const orderList = document.getElementById("orderList");
  if (!orderList) return;

  // Hapus semua kemungkinan grid cols
  orderList.classList.remove(
    "grid-cols-1",
    "sm:grid-cols-2",
    "md:grid-cols-3",
    "lg:grid-cols-4",
    "xl:grid-cols-5"
  );

  const screenWidth = window.innerWidth;

  if (sidebarOpen) {
    // Saat sidebar terbuka, batasi jumlah kolom
    if (screenWidth >= 1280) {
      orderList.classList.add(
        "grid-cols-1",
        "sm:grid-cols-2",
        "lg:grid-cols-3"
      );
    } else if (screenWidth >= 1024) {
      orderList.classList.add("grid-cols-1", "sm:grid-cols-2");
    } else {
      orderList.classList.add("grid-cols-1");
    }
  } else {
    // Saat sidebar tertutup, pakai responsif penuh
    if (screenWidth >= 1536) {
      orderList.classList.add(
        "grid-cols-1",
        "sm:grid-cols-2",
        "md:grid-cols-3",
        "lg:grid-cols-4",
        "xl:grid-cols-5"
      );
    } else if (screenWidth >= 1280) {
      orderList.classList.add(
        "grid-cols-1",
        "sm:grid-cols-2",
        "md:grid-cols-3",
        "lg:grid-cols-4"
      );
    } else if (screenWidth >= 1024) {
      orderList.classList.add(
        "grid-cols-1",
        "sm:grid-cols-2",
        "md:grid-cols-3"
      );
    } else if (screenWidth >= 640) {
      orderList.classList.add("grid-cols-1", "sm:grid-cols-2");
    } else {
      orderList.classList.add("grid-cols-1");
    }
  }
}

function confirmPayment() {
  const processingSection = document.getElementById("processingPayment");
  const successSection = document.getElementById("paymentSuccess");

  // Show modal and processing section
  if (processingSection) processingSection.classList.remove("hidden");
  if (successSection) successSection.classList.add("hidden");

  // Hide invoice and payment sidebar
  const invoiceModal = document.getElementById("modalInvoice");
  const paymentAside = document.getElementById("sidebarPayment");
  const finishAside = document.getElementById("sidebarFinish");

  if (invoiceModal) invoiceModal.classList.add("hidden");
  if (paymentAside) paymentAside.classList.add("hidden");

  // After 3 seconds, show success section
  setTimeout(() => {
    if (processingSection) processingSection.classList.add("hidden");
    if (successSection) successSection.classList.remove("hidden");
  }, 3000);

  // After 6.5 seconds, hide modal and show sidebarFinish
  setTimeout(() => {
    if (processingSection) processingSection.classList.add("hidden");
    if (successSection) successSection.classList.add("hidden");
    if (finishAside) finishAside.classList.remove("hidden");
  }, 6500);
}

// Steps
updateStepProgress(1);
function updateStepProgress(currentStep) {
  const steps = document.querySelectorAll(".step");

  steps.forEach((step, index) => {
    step.classList.remove("active", "completed");

    if (index + 1 < currentStep) {
      step.classList.add("completed");
    } else if (index + 1 === currentStep) {
      step.classList.add("active");
    }
  });
}

const modalInvoice = document.getElementById("modalInvoice");
const sidebarPayment = document.getElementById("sidebarPayment");
const modalOrderProcess = document.getElementById("modalOrderProcess");
const processingSection = document.getElementById("processingPayment");
const successSection = document.getElementById("paymentSuccess");
const sidebarFinish = document.getElementById("sidebarFinish");

const confirmPaymentBtn = document
  .getElementById("confirmPaymentBtn")
  .addEventListener("click", () => {
    modalInvoice.classList.add("hidden");
    sidebarPayment.classList.add("hidden");

    modalOrderProcess.classList.remove("hidden");

    processingSection.classList.remove("hidden");
    successSection.classList.add("hidden");

    setTimeout(() => {
      processingSection.classList.add("hidden");
      successSection.classList.remove("hidden");
    }, 3500);

    setTimeout(() => {
      modalOrderProcess.classList.add("hidden");
      if (sidebarFinish) sidebarFinish.classList.remove("hidden");
    }, 6500);

    setTimeout(() => {
      updateStepProgress(3);
    }, 6500);
  });

function orderNext() {
  document.getElementById("sidebarOrderedList").classList.add("hidden");
  document.getElementById("sidebarPayment").classList.remove("hidden");
  updateStepProgress(2);
}

function paymentBack() {
  document.getElementById("sidebarPayment").classList.add("hidden");
  document.getElementById("sidebarOrderedList").classList.remove("hidden");
  updateStepProgress(1);
}

function showPaymentProcessModal() {
  document.getElementById("sidebarPayment").classList.add("hidden");
  document.getElementById("sidebarFinish").classList.remove("hidden");
  updateStepProgress(3);
}
