<?php 
// ==================== DATABASE CONNECTION ====================

// Flag to check if record is inserted
$insert = false;

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Shubham@36";
$database = "notess";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Sorry we failed to connect " . mysqli_connect_error());
}

// ==================== HANDLE FORM SUBMIT ====================

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST["title"];
  $description = $_POST["description"];

  // Insert query
  $sql = "INSERT INTO `notess` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $sql);

  // Check if insert was successful
  if ($result) {
    $insert = true;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project -1 PHP CRUD</title>
  </head>
  <body style="margin: 0; font-family: Arial, sans-serif;">

    <!-- ==================== NAVBAR ==================== -->
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

    <!-- ==================== SUCCESS ALERT ==================== -->
    <?php
      if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'
              style='
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                padding: 15px;
                font-size: 16px;
                box-shadow: 0 4px 8px rgba(0, 128, 0, 0.1);
                border-radius: 8px;
                margin-top: 20px;
              '>
              <strong>Success!</strong> Your note has been inserted successfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
      }
    ?>

    <!-- ==================== ADD NOTES FORM ==================== -->
    <div class="container">
      <form action="/crud/index.php" method="post" style="max-width: 400px; margin: 20px auto; font-family: Arial, sans-serif;">
        <div style="margin-bottom: 15px;">
          <h2>Add a Note</h2>  
          <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Note Title</label>
          <input type="text" name="title" id="title" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
          <label for="desc" style="display: block; margin-bottom: 5px; font-weight: bold;">Note Description</label>
          <textarea name="description" id="description" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>

        <button type="submit" style="padding: 0.375rem 0.75rem; background-color: #0d6efd; color: white; border: none; border-radius: 4px;">Add Note</button>
      </form>
    </div>


    <div class="container">
  <table style="width: 90%; margin: 30px auto; border-collapse: collapse; box-shadow: 0 0 15px rgba(0,0,0,0.1); border-radius: 10px; overflow: hidden;">
    <thead style="background-color: #343a40; color: white;">
      <tr>
        <th style="padding: 12px;">S.NO</th>
        <th style="padding: 12px;">Title</th>
        <th style="padding: 12px;">Description</th>
        <th style="padding: 12px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php  
        $sql = "SELECT * FROM `notess`";
        $result = mysqli_query($conn, $sql);
        $sno = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr style='text-align: center; background-color: #fff; border-bottom: 1px solid #ddd;'>
                  <td style='padding: 12px;'>".$sno++."</td>
                  <td style='padding: 12px;'>".htmlspecialchars($row['title'])."</td>
                  <td style='padding: 12px;'>".htmlspecialchars($row['description'])."</td>
                  <td style='padding: 12px;'>
                    <button style='padding: 5px 10px; background-color: #ffc107; border: none; color: white; border-radius: 5px;'>Edit</button>
                    <button style='padding: 5px 10px; background-color: #dc3545; border: none; color: white; border-radius: 5px;'>Delete</button>
                  </td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>


    <script>
      // Dropdown menu logic (optional, no menu yet)
      const dropdown = document.querySelector('nav ul li:nth-child(3)');
      const menu = dropdown.querySelector('ul');
      dropdown.addEventListener('mouseover', () => menu.style.display = 'block');
      dropdown.addEventListener('mouseout', () => menu.style.display = 'none');
    </script>

  </body>
</html>
