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
    let found = false;

    for (let i = 0; i < rows.length; i++) {
        const nameCell = rows[i].getElementsByTagName("td")[2]; // kolom ke-3 = Nama
        if (nameCell) {
            const name = nameCell.textContent.toLowerCase();
            if (name.includes(input)) {
                rows[i].style.display = "";
                found = true;
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    // Tampilkan atau sembunyikan pesan "no data"
    const noDataDiv = document.getElementById("noData");
    if (!found) {
        noDataDiv.style.display = "flex";
    } else {
        noDataDiv.style.display = "none";
    }
}

function showViewModal(button) {
    // Ambil semua data dari atribut data-*
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const username = button.getAttribute("data-username");
    const role = button.getAttribute("data-role");
    const image = button.getAttribute("data-photo");
    const bio = button.getAttribute("data-bio") || "-";
    const createdAt = button.getAttribute("data-created_at");
    const updatedAt = button.getAttribute("data-updated_at");

    // Isi data ke modal
    document.getElementById("modalViewId").textContent = `#${id}`;
    document.getElementById("modalViewName").textContent = name;
    document.getElementById("modalViewNameDetail").textContent = name;
    document.getElementById("modalViewUsername").textContent = username;
    document.getElementById("modalViewRole").textContent = formatRole(role);
    document.getElementById("modalViewCreatedAt").textContent =
        formatDate(createdAt);
    document.getElementById("modalViewUpdatedAt").textContent =
        formatDate(updatedAt);
    document.getElementById("modalViewBio").textContent = bio;

    // Jika ada foto
    const photoElement = document.getElementById("modalViewPhoto");
    if (image && image !== "null") {
        photoElement.src = `/storage/${image}`;
    } else {
        photoElement.src = "https://via.placeholder.com/150"; // fallback image
    }

    // Tampilkan modal
    document.getElementById("modalViewItem").classList.remove("hidden");
}

// function showViewModal(button) {
//     const role = button.getAttribute("data-role");
//     const roleElement = document.getElementById("modalViewRole");

//     // Tambahkan validasi sebelum innerHTML
//     if (roleElement) {
//         const color =
//             {
//                 admin: "bg-primary",
//                 cassier: "bg-tertiary",
//                 kitchen: "bg-tertiary",
//                 storage: "bg-tertiary",
//                 waiters: "bg-tertiary",
//             }[role] || "bg-tertiary";

//         roleElement.innerHTML = `
//             <div class="relative inline-block">
//                 <span class="relative z-10 text-sm font-semibold text-white">${role}</span>
//                 <span class="absolute inset-0 ${color} rounded-full z-0 px-2 py-[2px]"></span>
//             </div>
//         `;
//     } else {
//         console.error("Element #modalViewRole tidak ditemukan!");
//     }

//     // Tampilkan modal
//     document.getElementById("modalViewItem").classList.remove("hidden");
// }

// const role = button.getAttribute("data-role");
// const roleElement = document.getElementById("modalViewRole");

// const roleMap = {
//     admin: { label: "Admin", bg: "bg-orange-500" },
//     cassier: { label: "Kasir", bg: "bg-blue-500" },
//     kitchen: { label: "Dapur", bg: "bg-red-500" },
//     storage: { label: "Gudang", bg: "bg-yellow-600" },
//     waiters: { label: "Pelayan", bg: "bg-green-500" },
// };

// const { label, bg } = roleMap[role] || { label: "Anggota", bg: "bg-gray-500" };

// // Ganti isi dan background class
// roleElement.textContent = label;

// // Reset semua bg-* lalu tambahkan bg baru
// roleElement.className = "text-white text-xs px-4 py-1 rounded-full mb-6 " + bg;

function showViewModal(button) {
    const id = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const username = button.getAttribute("data-username");
    const role = button.getAttribute("data-role");
    const photo = button.getAttribute("data-photo");
    const bio = button.getAttribute("data-bio") || "-";
    const createdAt = button.getAttribute("data-created_at");
    const updatedAt = button.getAttribute("data-updated_at");

    // Ganti konten
    document.getElementById("modalViewId").textContent = `#${id}`;
    document.getElementById("modalViewName").textContent = name;
    document.getElementById("modalViewNameDetail").textContent = name;
    document.getElementById("modalViewUsername").textContent = username;
    document.getElementById("modalViewCreatedAt").textContent =
        formatDate(createdAt);
    document.getElementById("modalViewUpdatedAt").textContent =
        formatDate(updatedAt);
    document.getElementById("modalViewBio").textContent = bio;

    // Ganti foto
    const photoElement = document.getElementById("modalViewPhoto");
    if (photo && photo !== "null") {
        photoElement.src = `/storage/${photo}`;
    } else {
        photoElement.src = "https://via.placeholder.com/150";
    }

    // Ganti Role Badge
    const roleElement = document.getElementById("modalViewRole");
    const roleMap = {
        admin: { label: "Admin", bg: "bg-primary" },
        cassier: { label: "Cassier", bg: "bg-tertiary" },
        kitchen: { label: "Kitchen", bg: "bg-tertiary" },
        storage: { label: "Storage", bg: "bg-tertiary" },
        waiters: { label: "Waiters", bg: "bg-tertiary" },
    };
    const { label, bg } = roleMap[role] || {
        label: "Anggota",
        bg: "bg-tertiary",
    };

    if (roleElement) {
        roleElement.textContent = label;
        roleElement.className = `text-white text-xs px-4 py-1 rounded-full mb-6 ${bg}`;
    }

    // Tampilkan modal
    document.getElementById("modalViewItem").classList.remove("hidden");
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleString("id-ID", {
        dateStyle: "medium",
        timeStyle: "short",
    });
}

function setDeleteId(id) {
    document.getElementById("deleteIdInput").value = id;
    document.getElementById("deleteIdText").textContent = id;
}
