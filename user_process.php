<?php

    session_start();
    $mysq = new mysqli('localhost', 'root', 'Nikhil@170758', 'student_search') or die(mysqli_error($mysq));
    //echo "$mysqli"; 
    //$a='yeeeeeeeee';
    $id= 0;
    $update= false;
    $playli= false;
    $song='';
    $singer='';
    $album='';
    $date_added='';
    
    if(isset($_POST['logout'])){
        $_SESSION = array();
        
// Destroy the session.
        session_destroy();
 
// Redirect to login page
        header("location: login.php");
    }
    
    if(isset($_POST['playli'])){
        $user=$_SESSION['username'];
        $result = $mysq->query("SELECT * FROM playlist WHERE user LIKE '%$user%'");
        if(count($result)>0){
            $_SESSION['play']=$user;
        }
        else{
            $_SESSION['message'] = "NO RESULTS FOUND..!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location: user.php");
    }
    if(isset($_GET['playlist'])){
        $id=$_GET['playlist'];
        $user=$_SESSION['username'];
        $playli= true;
        $result = $mysq->query("SELECT * FROM music WHERE id=$id") or die($mysq->error());
        if(count($result)==1){
           
            $row = $result->fetch_array();
            $song = $row['song'];
            $singer = $row['singer'];
            $album = $row['album'];
            $date_added = $row['date_added'];
        }
        $sql = "INSERT INTO playlist (user, song, singer, album, date_added,id)
        VALUES ('$user', '$song', '$singer', '$album', '$date_added', '$id')";
        
        if ($mysq->query($sql) === TRUE) {
            $_SESSION['message'] = "Record has been added..!";
            $_SESSION['msg_type'] = "success";
            echo "New record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysq->error;
        }
      
        header("location: user.php");
    }
    
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
        header("location: user.php");
    }

    if(isset($_GET['unplaylist'])){
        $id = $_GET['unplaylist'];
        
        $user = $_SESSION['username'];
        echo $user;
        echo $id;
        $mysq->query("DELETE FROM playlist WHERE user LIKE '%$user%' AND id=$id ") or die($mysq->error());
        $_SESSION['message'] = "Record has been removed..!";
        $_SESSION['msg_type'] = "danger";
        header("location: user.php");
    }

?>