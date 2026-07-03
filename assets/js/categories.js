const table = document.getElementById("categoryTable");

const rows = Array.from(table.querySelectorAll("tbody tr"));

const rowsPerPage = document.getElementById("rowsPerPage");

const pageNumbers = document.getElementById("pageNumbers");

const tableInfo = document.getElementById("tableInfo");

let currentPage = 1;

function displayRows(){

let perPage = parseInt(rowsPerPage.value);

let start = (currentPage-1)*perPage;

let end = start+perPage;

rows.forEach((row,index)=>{

row.style.display=(index>=start && index<end)?"":"none";

});

tableInfo.innerHTML=
`Showing ${start+1} to ${Math.min(end,rows.length)} of ${rows.length} records`;

pageNumbers.innerHTML="";

let totalPages=Math.ceil(rows.length/perPage);

for(let i=1;i<=totalPages;i++){

let btn=document.createElement("button");

btn.innerText=i;

btn.className="page-btn";

if(i===currentPage)
btn.classList.add("active");

btn.onclick=function(){

currentPage=i;

displayRows();

};

pageNumbers.appendChild(btn);

}

}

rowsPerPage.onchange=function(){

currentPage=1;

displayRows();

};

document.getElementById("prevBtn").onclick=function(){

if(currentPage>1){

currentPage--;

displayRows();

}

};

document.getElementById("nextBtn").onclick=function(){

let totalPages=Math.ceil(rows.length/rowsPerPage.value);

if(currentPage<totalPages){

currentPage++;

displayRows();

}

};

displayRows();