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

function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#memberTableBody tr");
    const noDataDiv = document.getElementById("noDataFound");

    let visibleCount = 0;

    rows.forEach((row) => {
        const rowText = row.innerText.toLowerCase();

        if (rowText.includes(input)) {
            row.style.display = ""; // tampilkan
            visibleCount++;
        } else {
            row.style.display = "none"; // sembunyikan
        }
    });

    // Tampilkan atau sembunyikan pesan "No data found"
    if (visibleCount === 0) {
        noDataDiv.classList.remove("hidden");
    } else {
        noDataDiv.classList.add("hidden");
    }
}

function setDeleteMember(id) {
    document.getElementById("deleteMemberId").value = id;
    document.getElementById("deleteMemberText").textContent = id;
    showModal("modalDeleteItem");
}
