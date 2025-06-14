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

// function getDatePart(dateStr, type) {
//   const date = new Date(dateStr);
//   switch (type) {
//       case 'year': return date.getFullYear();
//       case 'month': return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`;
//       case 'week': {
//           const firstJan = new Date(date.getFullYear(), 0, 1); 
//           const days = Math.floor((date - firstJan) / (24 * 60 * 60 * 1000));
//           return `${date.getFullYear()}-W${Math.ceil((days + firstJan.getDay() + 1) / 7)}`;
//       }
//       case 'day': return date.toISOString().split('T')[0];
//   }
// }

// document.querySelectorAll('#sortingMenu .dropdown-item').forEach(item => {
//     item.addEventListener('click', () => {
//         const sortType = item.getAttribute('data-sort');
//         const rows = document.querySelectorAll('tbody tr[data-date]');
//         const grouped = {};

//         rows.forEach(row => {
//             const dateStr = row.getAttribute('data-date');
//             const groupKey = getDatePart(dateStr, sortType);
//             if (!grouped[groupKey]) grouped[groupKey] = [];
//             grouped[groupKey].push(row);
//         });

//         const tbody = document.querySelector('tbody');
//         tbody.innerHTML = '';
//         Object.keys(grouped).sort().forEach(key => {
//             const headerRow = document.createElement('tr');
//             headerRow.innerHTML = `<td colspan="6" class="text-left bg-gray-100 font-semibold px-4 py-2">${sortType.toUpperCase()}: ${key}</td>`;
//             tbody.appendChild(headerRow);
//             grouped[key].forEach(row => tbody.appendChild(row));
//         });

//         document.getElementById('sortingMenu').classList.add('hidden');
//     });
// });

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

document.getElementById("userFilter").addEventListener("change", function () {
    const selectedUser = this.value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");
    let visibleCount = 0;

    rows.forEach(row => {
        const rowUser = row.getAttribute("data-user").toLowerCase();
        const match = selectedUser === "all" || rowUser === selectedUser;

        row.style.display = match ? "" : "none";
        if (match) visibleCount++;
    });

    // Tampilkan pesan jika tidak ada data
    const noData = document.getElementById("noData");
    if (visibleCount === 0) {
        noData.style.display = "flex";
    } else {
        noData.style.display = "none";
    }
});