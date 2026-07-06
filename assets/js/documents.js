document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("searchInput");
    const table = document.querySelector("table tbody");

    let rows = Array.from(table.querySelectorAll("tr"));

    const entries = document.getElementById("entries");
    const pageContainer = document.querySelector(".pagination");
    const recordsInfo = document.querySelector(".records-info");

    let currentPage = 1;

    function displayTable() {

        let filter = searchInput.value.toLowerCase();

        let filteredRows = rows.filter(row =>
            row.textContent.toLowerCase().includes(filter)
        );

        let perPage = parseInt(entries.value);

        let totalPages = Math.ceil(filteredRows.length / perPage);

        if(currentPage > totalPages)
            currentPage = 1;

        rows.forEach(r => r.style.display = "none");

        let start = (currentPage - 1) * perPage;
        let end = start + perPage;

        filteredRows.slice(start, end).forEach(row => {
            row.style.display = "";
        });

        createPagination(totalPages);

        if(filteredRows.length == 0){

            recordsInfo.innerHTML = "Showing 0 to 0 of 0 records";

        }else{

            recordsInfo.innerHTML =
                `Showing ${start + 1} to ${Math.min(end, filteredRows.length)} of ${filteredRows.length} records`;

        }

    }

    function createPagination(totalPages){

        pageContainer.innerHTML = "";

        // Previous
        let prev = document.createElement("button");
        prev.innerHTML = "&laquo;";
        prev.disabled = currentPage == 1;

        prev.onclick = function(){

            currentPage--;
            displayTable();

        };

        pageContainer.appendChild(prev);

        for(let i=1;i<=totalPages;i++){

            let btn = document.createElement("button");

            btn.innerText = i;

            btn.classList.add("page-btn");

            if(i == currentPage)
                btn.classList.add("active");

            btn.onclick = function(){

                currentPage = i;
                displayTable();

            };

            pageContainer.appendChild(btn);

        }

        // Next
        let next = document.createElement("button");

        next.innerHTML = "&raquo;";

        next.disabled = currentPage == totalPages || totalPages == 0;

        next.onclick = function(){

            currentPage++;
            displayTable();

        };

        pageContainer.appendChild(next);

    }

    searchInput.addEventListener("keyup", function(){

        currentPage = 1;
        displayTable();

    });

    entries.addEventListener("change", function(){

        currentPage = 1;
        displayTable();

    });

    displayTable();

});