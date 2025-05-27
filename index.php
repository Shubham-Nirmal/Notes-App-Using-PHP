<?php
$insert = false;

$servername = "localhost";
$username = "root";
$password = "Shubham@36";
$database = "notess";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// DELETE
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `notess` WHERE `sno` = $sno";
    mysqli_query($conn, $sql);
}

// UPDATE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
    $description = $_POST['descriptionEdit'];
    $sql = "UPDATE `notess` SET `title`='$title', `description`='$description' WHERE `sno` = $sno";
    mysqli_query($conn, $sql);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['snoEdit'])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $sql = "INSERT INTO `notess` (`title`, `description`) VALUES ('$title', '$description')";
    if (mysqli_query($conn, $sql)) {
        $insert = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
</head>
<body style="margin: 0; font-family: Arial, sans-serif;">

<!-- ========== NAVBAR (unchanged) ========== -->
<nav style="background-color: #f8f9fa; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center;">
  <div style="font-size: 24px; font-weight: bold;">iNotes</div>
  <ul style="list-style: none; display: flex; margin: 0; padding: 0; gap: 30px;">
    <li><a href="#" style="text-decoration: none; color: #000; font-weight: bold;">Home</a></li>
    <li><a href="#" style="text-decoration: none; color: #000;">About</a></li>
    <li><a href="#" style="text-decoration: none; color: #000;">Contact Us</a></li>
    <li><a href="#" style="text-decoration: none; color: gray; pointer-events: none;"></a></li>
  </ul>
  <form style="display: flex; gap: 5px;">
    <input type="text" placeholder="Search" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px;" />
    <button type="submit" style="padding: 5px 10px; border: 1px solid #28a745; background-color: #28a745; color: #fff; border-radius: 4px;">Search</button>
  </form>
</nav>

<!-- ========== SUCCESS ALERT ========== -->
<?php
if ($insert) {
    echo "<div style='background-color:#d4edda;color:#155724;border:1px solid #c3e6cb;padding:15px;margin:20px;border-radius:8px;'>
        <strong>Success!</strong> Your note has been inserted successfully.
    </div>";
}
?>

<!-- ========== FORM ========== -->
<div style="max-width: 400px; margin: 20px auto;">
    <form action="" method="post">
        <h2>Add a Note</h2>
        <label>Note Title</label>
        <input type="text" name="title" required style="width:100%; padding:8px; margin-bottom:10px;">
        <label>Note Description</label>
        <textarea name="description" required style="width:100%; padding:8px;"></textarea><br><br>
        <button type="submit" style="padding:10px 15px; background:#0d6efd; color:white; border:none;">Add Note</button>
    </form>
</div>

<!-- ========== NOTES TABLE ========== -->
<div style="width:90%; margin:30px auto;">
    <table id="notesTable" class="display" style="width:100%;">
        <thead style="background:#343a40; color:white;">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `notess`";
            $result = mysqli_query($conn, $sql);
            $sno = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $sno++ . "</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td>
                            <button class='editBtn' data-sno='" . $row['sno'] . "' data-title='" . htmlspecialchars($row['title'], ENT_QUOTES) . "' data-desc='" . htmlspecialchars($row['description'], ENT_QUOTES) . "' style='background:#ffc107;color:white;padding:5px 10px;border:none;'>Edit</button>
                            <a href='?delete=" . $row['sno'] . "' onclick=\"return confirm('Are you sure?')\" style='background:#dc3545;color:white;padding:5px 10px;text-decoration:none;border:none;'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- ========== EDIT MODAL ========== -->
<div id="editModal" style="display:none; position:fixed; top:15%; left:50%; transform:translateX(-50%); background:white; padding:20px; border:2px solid #ccc; border-radius:10px;">
    <form method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <label>Title</label><br>
        <input type="text" name="titleEdit" id="titleEdit" style="width:100%; padding:8px;"><br><br>
        <label>Description</label><br>
        <textarea name="descriptionEdit" id="descriptionEdit" style="width:100%; padding:8px;"></textarea><br><br>
        <button type="submit" style="background:#0d6efd;color:white;padding:8px 16px;border:none;">Update</button>
        <button type="button" onclick="closeModal()" style="background:#6c757d;color:white;padding:8px 16px;border:none;">Cancel</button>
    </form>
</div>

<!-- ========== SCRIPTS ========== -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="//cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('#notesTable').DataTable();

    $('.editBtn').click(function () {
        const sno = $(this).data('sno');
        const title = $(this).data('title');
        const desc = $(this).data('desc');
        $('#snoEdit').val(sno);
        $('#titleEdit').val(title);
        $('#descriptionEdit').val(desc);
        $('#editModal').show();
    });
});

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>

</body>
</html>
