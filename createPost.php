<?php
session_start();
require_once('database.php');
$db = db_connect();
$userid = $_SESSION["id"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ //make sure we submit the data
    $sql = "SELECT * FROM user "; 
    $sql.= "where id = '$userid'";
    $result_set = mysqli_query($db, $sql);
    $username = '';
    // pick random pic id
    $img_id = rand(1118,1125);
    foreach($result_set as $user)
    {
        $username = $user['username'];
    }
    $comment = $_POST['comment']; 
    $today = date("Y-m-d");
    //$j = $_SESSION[""];
    $insertSql = "INSERT INTO post (userid, message, date, username, img) VALUES ('$userid','$comment', '$today', '$username', '$img_id')";
    $result = mysqli_query($db, $insertSql);    
    $id = mysqli_insert_id($db); 
    if($_SESSION['page']== 'tweet'){
      header("Location:tweet.php?id=$id");
    }
    elseif($_SESSION['page']== 'home'){
    header("Location:home.php?id=$id");}

} else {
  header("Location: home.php");
}

