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