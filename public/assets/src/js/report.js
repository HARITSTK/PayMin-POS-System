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
