// Toggle sidebar functionality
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

// Search functionality for documents table
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

// AJAX search functionality for documents table
const searchInput = document.getElementById("searchInput");

if(searchInput){

    searchInput.addEventListener("keyup", function(){

        let search = this.value;

        fetch("search_documents.php?search=" + encodeURIComponent(search))
        .then(response => response.text())
        .then(data => {

            document.getElementById("documentsBody").innerHTML = data;

        });

    });

}