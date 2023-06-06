/* student name：Maha Fouda */
<?php
session_start();

require_once('database.php');
$db = db_connect();

// Handle form values sent by new.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //make sure we submit the data
  $username = $_POST['username']; // access the form data
  $password = $_POST['password'];
  //prepare your query string
  $sql = "SELECT * FROM user "; //query string
  $sql.= "where username = '$username' and password = '$password'";
  $result_set = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  $id = '';
  foreach($result_set as $user)
  {
    $id = $user['id'];
    $_SESSION["id"] = $user['id'];
  }

  //$id = mysqli_insert_id($db); //the mysqli_insert_id() function returns the id (generated with AUTO_INCREMENT) 
  //redirect to show page with generated id as a parameter


  if(strlen($id) > 0 && $id != 0)
  {
    header("Location: home.php");
  }
  else
  {
    header("Location: Login.php?issuccessful=false");
  }

} else {
  header("Location: Login.php");
}


# this php file do the following:
# 1. The code checks if the request method is POST.
# 2. If it is, it gets the username and password from the form.
# 3. It then prepares a query string to select the user from the database.
# 4. It then executes the query and gets the result set.
# 5. It then loops through the result set and gets the id of the user.
# 6. If the id is not empty, it redirects the user to the home page.
# 7. If the id is empty, it redirects the user to the login page with a query string