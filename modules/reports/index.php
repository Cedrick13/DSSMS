<?php
include '../../config/database.php';

$start = "";
$end = "";

$sql = "
SELECT
documents.*,
users.username,
categories.category_name
FROM documents

LEFT JOIN users
ON documents.user_id = users.id

LEFT JOIN categories
ON documents.category_id = categories.category_id
";

if(isset($_GET['start']) && isset($_GET['end']))
{
    $start = $_GET['start'];
    $end = $_GET['end'];

    if($start != "" && $end != "")
    {
        $sql .= " WHERE DATE(documents.upload_date)
                  BETWEEN '$start' AND '$end'";
    }
}

$sql .= " ORDER BY documents.upload_date DESC";

$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>

<head>

<title>Reports</title>

<link rel="stylesheet" href="../../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include '../../includes/sidebar.php'; ?>

<div class="main-content">

<div class="page-header">

<h2>

<i class="fas fa-chart-bar"></i>

Reports

</h2>

</div>

<div class="table-card">

<form method="GET">

<label>Start Date</label>

<input
type="date"
name="start"
value="<?= htmlspecialchars($start); ?>">

<label>End Date</label>

<input
type="date"
name="end"
value="<?= htmlspecialchars($end); ?>">

<button
type="submit"
class="save-btn">

Generate

</button>

</form>

<br>

<table class="users-table">

<thead>

<tr>

<th>File Name</th>

<th>Category</th>

<th>Uploaded By</th>

<th>Date Uploaded</th>

</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= htmlspecialchars($row['file_name']); ?></td>

<td><?= htmlspecialchars($row['category_name'] ?? 'No Category'); ?></td>

<td><?= htmlspecialchars($row['username']); ?></td>

<td><?= date("M d, Y", strtotime($row['upload_date'])); ?></td>

</tr>

<?php
    }

}else{
?>

<tr>

    <td colspan="3" style="text-align:center;">
        No records found.
    </td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<script src="../../assets/js/main.js"></script>

</body>

</html>