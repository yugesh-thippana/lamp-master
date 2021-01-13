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
    <title>Guest</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once 'guest_process.php';
   // echo "yo!!!!";
    ?> 

    <?php 
       if(isset($_SESSION['message'])): 
        //echo "yttttt";
    ?>
    <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
     
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
       <?php endif; ?>  
       <?php
// Initialize the session
        session_start();
 
// Check if the user is logged in, if not then redirect him to login page

?>

    <p><a href="logout.php">login here</a>
    
    <div class ="row justify-content-center">
    <form action = "guest_process.php" method ="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <div class="form-group">
    <label> Search</label>
    <input type="text" name="search" class="form-control" value= "<?php echo $search; ?>" placeholder="Search here...">
    </div>
    <button type="submit" class= "btn btn-info" name="sear">Search</button>
    </form>
    </div>
    </div>
    <div class = "container">
    <?php
     // echo "yaaa";
      $mysqi = new mysqli('localhost', 'root', 'Nikhil@170758', 'student_search') or die(mysqli_error($mysqi)); 
      //echo "yee";
      if(isset($_SESSION['sea'])){
          $se = $_SESSION['sea'];
          $sql= "SELECT * FROM music WHERE song LIKE '%$se%' OR singer LIKE '%$se%' OR album LIKE '%$se%'";
          unset($_SESSION['sea']);
        }
      
      else {
        $sql = "SELECT * FROM music";
      }
      $result = $mysqi->query($sql) or die($mysqi->error);
      //echo "ypppp";
      //pre_r($result->fetch_assoc());
      ?>
    <div class="row justify-content-center">
       <table class="table">
            <thead>
                <tr>
                    <th>Song</th>
                    <th>Singer</th>
                    <th>Album</th>
                    <th>Date</th>
                   
                </tr>
            </thead>
        <?php
            while ($row= $result->fetch_assoc()): 
        ?>
        <tr>
            <td><?php echo $row['song']; ?></td>
            <td><?php echo $row['singer']; ?></td>
            <td><?php echo $row['album']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            
        </tr>
        <?php endwhile;?>
       </table> 
    </div>
   
    <?php
    
        function pre_r($array){
            echo'<pre>';
            print_r($array);
            echo'</pre>';
        }
        
    ?>
    
</body>
</html>