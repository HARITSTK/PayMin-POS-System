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

function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const tableBody = document.getElementById("tableBody");
    const rows = tableBody.getElementsByTagName("tr");
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const text = row.innerText.toLowerCase();

        if (text.includes(input)) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    }

    const noData = document.getElementById("noData");
    if (visibleCount === 0) {
        noData.style.display = "flex";
    } else {
        noData.style.display = "none";
    }
}

// Optional: Add debounce untuk performa yang lebih baik
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function setDeleteId(id) {
    document.getElementById("deleteIdInput").value = id;
    document.getElementById("deleteIdText").innerText = id;
}

function showViewModal(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const username = button.getAttribute("data-username");
    const bio = button.getAttribute("data-bio");
    const role = button.getAttribute("data-role");
    const updated_at = button.getAttribute("data-updated_at");
    const created_at = button.getAttribute("data-created_at");
    const photo = button.getAttribute("data-photo");

    // Set teks
    document.getElementById("modalViewId").textContent = `#${id}`;
    document.getElementById("modalViewName").textContent = name;
    document.getElementById("modalViewNameDetail").textContent = name;
    document.getElementById("modalViewUsername").textContent = username;
    document.getElementById("modalViewCreatedAt").textContent = created_at;
    document.getElementById("modalViewUpdatedAt").textContent = updated_at;
    document.getElementById("modalViewBio").textContent = bio;

    const roleEl = document.getElementById("modalViewRole");
    roleEl.textContent = role.charAt(0).toUpperCase() + role.slice(1);
    roleEl.className =
        role === "admin"
            ? "bg-primary text-white text-xs px-4 py-1 rounded-full mb-6 inline-block"
            : "bg-tertiary text-white text-xs px-4 py-1 rounded-full mb-6 inline-block";

    // Set foto
    const photoEl = document.getElementById("modalViewPhoto");
    if (photo) {
        photoEl.src = `/storage/uploads/photos/${photo}`;
    } else {
        photoEl.src = `/assets/src/assets/user.png`;
    }

    // Tampilkan modal
    showModal("modalViewItem");
}

function showModal(id) {
    document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
}
