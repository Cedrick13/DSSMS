// assets/js/documents.js
document.addEventListener("DOMContentLoaded", () => {

    const searchInput = document.getElementById("searchInput");

    if(searchInput){

        searchInput.addEventListener("keyup", function(){

            let filter = this.value.toLowerCase();

            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {

                let text = row.textContent.toLowerCase();

                row.style.display =
                    text.includes(filter)
                    ? ""
                    : "none";

            });

        });

    }

});