<?php 

// INSERT INTO `notess` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'by books ', 'plz go bu store', CURRENT_TIMESTAMP);

// connecting to the Database 

$servername = "localhost";
$username = "root";
$password = "Shubham@36";
$database = "notess";

// Create a connection 

$conn = mysqli_connect($servername, $username, $password, $database);


// Die if connection was not successful 
if (!$conn) {
    die("Sorry we failed to connect ". mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD']== 'POST') {
  $title = $_POST["title"];
  $description = $_POST["description"];

  //sql query to be wxecuted 
  $sql = "INSERT INTO `notess` (`title`, `description` ) VALUES (`$title`, `$description `)";

  // Add a new 

  if ($result) {
   echo "The record has been inserted successfully !<br> ";
  }
  else {
     echo "The record was not inserted successfully becouse of this error ---> ! ".mysqli_error($conn);
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

    <nav style="background-color: #f8f9fa; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center;">
      <div style="font-size: 24px; font-weight: bold;">iNotes</div>
      <ul style="list-style: none; display: flex; margin: 0; padding: 0; gap: 30px;">
        <li><a href="#" style="text-decoration: none; color: #000; font-weight: bold;">Home</a></li>
        <li><a href="#" style="text-decoration: none; color: #000;">About </a></li>
        <li style="position: relative;">
          <a href="#" style="text-decoration: none; color: #000;">Contact Us</a>
          
        </li>
        <li><a href="#" style="text-decoration: none; color: gray; pointer-events: none;"></a></li>
      </ul>
      <form style="display: flex; gap: 5px;">
        <input type="text" placeholder="Search" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px;" />
        <button type="submit" style="padding: 5px 10px; border: 1px solid #28a745; background-color: #28a745; color: #fff; border-radius: 4px;">Search</button>
      </form>
    </nav>



     <div class="container">
       
      <form action="/crud/index.php " method="post" style="max-width: 400px; margin: 20px auto; font-family: Arial, sans-serif;">
  <div style="margin-bottom: 15px;">
    <h2>Add  a Notes </h2>  
    
    <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Note Title </label>
    <input type="text" name= "title" id="title" aria-describedby="emailHelp"
      style="width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border: 1px solid #ccc; border-radius: 4px;">
    
  </div>

  <div style="margin-bottom: 15px;">
    <label for="desc" style="display: block; margin-bottom: 5px; font-weight: bold;">Note Description </label>
    <div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="description" name = "description" style="width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border: 1px solid #ccc; border-radius: 4px;"></textarea>
  
</div>
  <button type="submit"
    style="padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; background-color: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer;">
    Add Not
  </button>
</form>

</div>

     <div class="container">
     
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stylish Table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 30px;
    }

    table {
      width: 80%;
      margin: auto;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    thead {
      background-color: #343a40;
      color: white;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    tbody tr:nth-child(even) {
      background-color: #e9ecef;
    }

    tbody tr:hover {
      background-color: #d1ecf1;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
  </style>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>S.NO </th>
        <th>Title</th>
        <th> Description</th>
        <th>Actions </th>
      </tr>
    </thead>
    <tbody>
           <?php  
           $sql = "SELECT * FROM `notess`";
           $result= mysqli_query($conn, $sql);
           while ($row = mysqli_fetch_assoc($result)) {
            echo " <tr>
        <th scope = 'row'>".$row['sno']."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td>Action </td>
      </tr>";
            
           }
          
         ?>

      
      <tr>
        <th>2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      
    </tbody>
  </table>

</body>
</html>


     </div>




    <script>
      // Simple dropdown toggle effect
      const dropdown = document.querySelector('nav ul li:nth-child(3)');
      const menu = dropdown.querySelector('ul');
      dropdown.addEventListener('mouseover', () => menu.style.display = 'block');
      dropdown.addEventListener('mouseout', () => menu.style.display = 'none');
    </script>

  </body>
</html>
