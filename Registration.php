<?php

require_once('database.php');
$db = db_connect();

// Handle form values sent by new.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
  $name = $_POST['name']; // access the form data
  $username = $_POST['username']; // access the form data
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  //prepare your query string
  $sql = "INSERT INTO user (name, username,email,phone, password) VALUES ('$name','$username','$email', '$phone', '$password')";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false

  $id = mysqli_insert_id($db); //the mysqli_insert_id() function returns the id (generated with AUTO_INCREMENT) 
  //redirect to show page with generated id as a parameter
  header("Location: Login.php");
} else {
  header("Location: Registration.html");
}

// 1. It's checking to see if the form was submitted.
// 2. If it was, it's grabbing the form data and storing it in variables.
// 3. It's preparing a query string to insert the data into the database.
// 4. It's executing the query.
// 5. It's grabbing the