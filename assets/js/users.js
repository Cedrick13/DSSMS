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

                row.style.display =
                    row.innerText.toLowerCase().includes(value)
                    ? ""
                    : "none";

            });

        });

    }

});