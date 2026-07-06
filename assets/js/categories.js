document.addEventListener("DOMContentLoaded", function () {

    const table = document.getElementById("categoryTable");

    if (!table) return;

    const searchInput = document.getElementById("searchInput");
    const rows = Array.from(table.querySelectorAll("tbody tr"));

    const rowsPerPage = document.getElementById("rowsPerPage");
    const pageNumbers = document.getElementById("pageNumbers");
    const tableInfo = document.getElementById("tableInfo");

    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let currentPage = 1;

    function displayRows() {

        let keyword = searchInput.value.toLowerCase();

        // Filter rows
        let filteredRows = rows.filter(row =>
            row.innerText.toLowerCase().includes(keyword)
        );

        let perPage = parseInt(rowsPerPage.value);

        let totalPages = Math.max(1, Math.ceil(filteredRows.length / perPage));

        if (currentPage > totalPages)
            currentPage = totalPages;

        let start = (currentPage - 1) * perPage;
        let end = start + perPage;

        // Hide all rows
        rows.forEach(row => row.style.display = "none");

        // Show only current page of filtered rows
        filteredRows.slice(start, end).forEach(row => {
            row.style.display = "";
        });

        tableInfo.innerHTML =
            `Showing ${filteredRows.length == 0 ? 0 : start + 1} to ${Math.min(end, filteredRows.length)} of ${filteredRows.length} records`;

        pageNumbers.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {

            let btn = document.createElement("button");

            btn.className = "page-btn";
            btn.innerText = i;

            if (i === currentPage)
                btn.classList.add("active");

            btn.onclick = function () {
                currentPage = i;
                displayRows();
            };

            pageNumbers.appendChild(btn);
        }
    }

    searchInput.addEventListener("keyup", function () {
        currentPage = 1;
        displayRows();
    });

    rowsPerPage.addEventListener("change", function () {
        currentPage = 1;
        displayRows();
    });

    prevBtn.onclick = function () {
        if (currentPage > 1) {
            currentPage--;
            displayRows();
        }
    };

    nextBtn.onclick = function () {

        let keyword = searchInput.value.toLowerCase();

        let filteredRows = rows.filter(row =>
            row.innerText.toLowerCase().includes(keyword)
        );

        let totalPages = Math.max(1, Math.ceil(filteredRows.length / rowsPerPage.value));

        if (currentPage < totalPages) {
            currentPage++;
            displayRows();
        }
    };

    displayRows();

});