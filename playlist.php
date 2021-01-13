<?php
session_start();

$_SESSION['play']=$_SESSION['username'];
$role=$_SESSION['role'];
echo $role;
if($role == 'user') header("location: user.php");
if($role == 'dev') header("location: dev.php");
else header("location: crud.php");
?>