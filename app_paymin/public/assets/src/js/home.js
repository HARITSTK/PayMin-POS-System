var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    grid: {
        rows: 2,
    },
    spaceBetween: 20,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

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
