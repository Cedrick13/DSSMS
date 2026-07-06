// assets/js/users.js
document.addEventListener("DOMContentLoaded", function () {

    const successAlert = document.querySelector(".alert-success");

    if (successAlert) {

        setTimeout(function () {

            successAlert.style.transition = "opacity 0.5s ease";
            successAlert.style.opacity = "0";

            setTimeout(function () {
                successAlert.remove();
            }, 500);

        }, 3000);

    }

});

// AJAX search functionality for users table
document.addEventListener("DOMContentLoaded", function(){

    const search = document.getElementById("searchInput");

    if(search){

        search.addEventListener("keyup", function(){

            let value = this.value.toLowerCase();

            let rows = document.querySelectorAll(".users-table tbody tr");

           rows.forEach(function(row){

    if(row.innerText.toLowerCase().includes(value)){

        row.dataset.hidden = "false";

    }else{

        row.dataset.hidden = "true";

    }

});

currentPage = 1;

displayRows();

        });

    }

});

// Pagination functionality for users table
const table = document.getElementById("usersTable");

if (table) {

    const rows = Array.from(table.querySelectorAll("tbody tr"));

    const rowsPerPage = document.getElementById("rowsPerPage");

    const pageNumbers = document.getElementById("pageNumbers");

    const tableInfo = document.getElementById("tableInfo");

    let currentPage = 1;

   function displayRows() {

    let perPage = parseInt(rowsPerPage.value);

    // Get only rows that match the search
    let visibleRows = rows.filter(row => row.dataset.hidden != "true");

    let start = (currentPage - 1) * perPage;
    let end = start + perPage;

    // Hide everything first
    rows.forEach(row => row.style.display = "none");

    // Show only current page of visible rows
    visibleRows.slice(start, end).forEach(row => {
        row.style.display = "";
    });

    tableInfo.innerHTML =
        `Showing ${
            visibleRows.length === 0 ? 0 : start + 1
        } to ${
            Math.min(end, visibleRows.length)
        } of ${
            visibleRows.length
        } records`;

    pageNumbers.innerHTML = "";

    let totalPages = Math.ceil(visibleRows.length / perPage);

    for(let i = 1; i <= totalPages; i++){

        let btn = document.createElement("button");

        btn.className = "page-btn";

        btn.innerText = i;

        if(i == currentPage)
            btn.classList.add("active");

        btn.onclick = function(){

            currentPage = i;

            displayRows();

        };

        pageNumbers.appendChild(btn);

    }

}

    rowsPerPage.onchange = function () {

        currentPage = 1;

        displayRows();

    };

    document.getElementById("prevBtn").onclick = function () {

        if (currentPage > 1) {

            currentPage--;

            displayRows();

        }

    };

    document.getElementById("nextBtn").onclick = function () {

        let totalPages = Math.ceil(rows.length / rowsPerPage.value);

        if (currentPage < totalPages) {

            currentPage++;

            displayRows();

        }

    };

    displayRows();

}