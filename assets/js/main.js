const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("toggleBtn");

toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
});

document.querySelectorAll('.has-submenu > a').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        this.parentElement.classList.toggle('active');
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("searchInput");
    const documentsTable = document.getElementById("documentsTable");

    if (!searchInput || !documentsTable) {
        console.log("Search elements not found.");
        return;
    }

    searchInput.addEventListener("keyup", function () {

        const filter = this.value.toLowerCase();
        const rows = documentsTable.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(filter)
                ? ""
                : "none";
        });

    });

});