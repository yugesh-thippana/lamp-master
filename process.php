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
    if(isset($_POST['save'])){
        $song=$_POST['song'];
        $singer=$_POST['singer'];
        $album=$_POST['album'];
        $date_added=$_POST['date_added'];
        
        //echo "bghgkh";
        //echo "$date_added";
        $sql = "INSERT INTO music (song, singer, album, date_added)
        VALUES ('$song', '$singer', '$album', '$date_added')";
        
        if ($mysq->query($sql) === TRUE) {
            $_SESSION['message'] = "Record has been saved..!";
            $_SESSION['msg_type'] = "success";
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysq->error;
        }
        //echo "grrr";
        header("location: crud.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysq->query("DELETE FROM music WHERE id=$id") or die($mysq->error()); 
        $_SESSION['message'] = "Record has been deleted..!";
        $_SESSION['msg_type'] = "danger";
        header("location: crud.php");
    }
    if(isset($_GET['unplaylist'])){
        $id = $_GET['unplaylist'];
        
        $user = $_SESSION['username'];
        $mysq->query("DELETE FROM playlist WHERE user LIKE '%$user%' AND id=$id ") or die($mysq->error());
        $_SESSION['message'] = "Record has been removed..!";
        $_SESSION['msg_type'] = "danger";
        header("location: crud.php");
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
        header("location: crud.php");
    }
    if(isset($_GET['accept'])){
        $id=$_GET['accept'];
        $mysq->query("UPDATE users SET status='yes' WHERE id=$id") or die($mysq->error()); 
        header("location: crud.php");
    }
    if(isset($_GET['del'])){
        $id=$_GET['del'];
        $mysq->query("DELETE FROM users WHERE id=$id") or die($mysq->error());
        header("location: crud.php");
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
      
        header("location: crud.php");
    }
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $update= true;
        $result = $mysq->query("SELECT * FROM music WHERE id=$id") or die($mysq->error());
        if(count($result)==1){
            $row = $result->fetch_array();
            $song = $row['song'];
            $singer = $row['singer'];
            $album = $row['album'];
            $date_added = $row['date_added'];
        }
    }

    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $song=$_POST['song'];
        $singer=$_POST['singer'];
        $album=$_POST['album'];
        $date_added=$_POST['date_added'];
        //echo "bghgkh";
        //echo "2+$date_added+2";
        //echo "$date_added";
        $sql = "UPDATE music SET song= '$song', singer='$singer', album='$album', date_added='$date_added' WHERE id=$id ";

        if ($mysq->query($sql) === TRUE) {
            echo "New record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysq->error;
        }
        //echo "grrr";
        header("location: crud.php");
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
        header("location: crud.php");
    }

?>