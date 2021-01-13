<html lang="en">
<head>
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style> 
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$mysqi = new mysqli('localhost', 'root', 'Nikhil@170758', 'student_search') or die(mysqli_error($mysqi));
$sqi = "SELECT * FROM users WHERE status='no'";
$result = $mysqi->query($sqi) or die("error there");

?>
<div class="row justify-content-center">
       <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th colspan="2"> Action</th>
                </tr>
            </thead>
        <?php
            while ($row= $result->fetch_assoc()): 
        ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            
            <td> 
                <a href="process.php?accept=<?php echo $row['id']; ?>"
                    class="btn btn-info">Accept</a>
                <a href="process.php?del=<?php echo $row['id']; ?>"
                    class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile;?>
       </table> 
</div>
</body>
</html>
       