<?php

    session_start();
    $mysq = new mysqli('localhost', 'root', 'Nikhil@170758', 'student_search') or die(mysqli_error($mysq));
  
    
    
    if(isset($_POST['sear'])){
        $search=$_POST['search'];
        $result = $mysq->query("SELECT * FROM music WHERE song LIKE '%$search%' OR singer LIKE '%$search%' OR album LIKE '%$search%'");
        if(count($result)>0){
            $_SESSION['sea']=$search;
        }
        else{
            $_SESSION['message'] = "NO RESULTS FOUND..!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location: guest.php");
    }

?>