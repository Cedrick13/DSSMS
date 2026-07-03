<?php
include '../../config/database.php';

$result = mysqli_query($conn,"SELECT * FROM categories");

$success = "";

if(isset($_GET['success']) && $_GET['success']=="added")
{
    $success = "Category added successfully!";
}

if(isset($_GET['success']) && $_GET['success']=="updated")
{
    $success = "Category updated successfully!";
}

if(isset($_GET['success']) && $_GET['success']=="deleted")
{
    $success = "Category deleted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Categories</title>

<link rel="stylesheet" href="../../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include '../../includes/sidebar.php'; ?>

<div class="main-content">

<?php if($success!=""){ ?>

<div class="alert-success">
    <?= $success; ?>
</div>

<?php } ?>

<div class="page-header">

    <div>

        <h2>
            <i class="fas fa-folder"></i>
            Categories
        </h2>

    </div>

    <a href="add.php" class="add-btn">
        + Add Category
    </a>

</div>

<div class="table-toolbar">

<input
type="text"
id="searchInput"
placeholder="🔍 Search categories...">

</div>

<div class="table-card">

<table class="users-table" id="categoryTable">

<thead>

<tr>

<th>No.</th>

<th>Category Name</th>

<th>Description</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

    <td><?= $no++; ?></td>

    <td><?= $row['category_name']; ?></td>

    <td><?= $row['description']; ?></td>

    <td class="action-column">

        <a
        href="edit.php?id=<?= $row['category_id']; ?>"
        class="icon-btn edit-btn"
        title="Edit">
            <i class="fas fa-pen"></i>
        </a>

        <a
        href="delete.php?id=<?= $row['category_id']; ?>"
        class="icon-btn delete-btn"
        onclick="return confirm('Delete this category?')"
        title="Delete">
            <i class="fas fa-trash"></i>
        </a>

    </td>

</tr>

<?php
}
?>

</tbody>

</table>

<div class="table-footer">

<div class="entries">

Showing
<select id="rowsPerPage">
    <option>10</option>
    <option>20</option>
    <option>50</option>
</select>

</div>

<div id="tableInfo"></div>

<div class="pagination">

<button id="prevBtn">
<i class="fas fa-chevron-left"></i>
</button>

<span id="pageNumbers"></span>

<button id="nextBtn">
<i class="fas fa-chevron-right"></i>
</button>

</div>

</div>

</div>

</div>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/categories.js"></script>

<script>

const searchInput=document.getElementById("searchInput");

searchInput.addEventListener("keyup",function(){

let filter=this.value.toLowerCase();

let rows=document.querySelectorAll(".users-table tbody tr");

rows.forEach(function(row){

let text=row.textContent.toLowerCase();

row.style.display=text.includes(filter) ? "" : "none";

});

});

</script>

</body>

</html>