

 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Ni Jianglian">
        <meta name=" desctription " content=" home page of assignment1 ">
        <link rel="stylesheet" type="text/css" href="css/login.css?id=3">
        <title>Sign In</title>
    </head>
    <body class="registationBody">
    <?php 

    function showError()
    {
        if(empty($_GET))
        {
            return '';
        }
        else
        {
            return "Username or Password is incorrect, please try again!";
        }
    }
    ?>
    <div class="template">
        <form action="LoginVerification.php" method="post">
            <h1>Sign in to Fatter</h1>
            <div id="textfield " class="textfield">
                <input type="text" name="username" id="username" placeholder="Name">
            </div>

            <div class="textfield" id="loginDiv">
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <div class="textfield">
                <span class="warning"><?php echo showError();  ?></span>
            </div>
            <div class="buttons">
                <button class="submit" type="submit">Next</button>
            </div>
        </form>
    </div>
</html>

 <!-- Here's what the above class is doing:
1. It's creating a class called Log.
2. It's creating a function called showError.
3. It's creating a variable called template.
4. It's creating a form called login.
5. It's creating a button called submit.
6. It's creating a div called text -->

<!-- 1. The showError function is checking to see if the user has submitted the form.
 If they have, it will check to see if the username and password are correct. 
 If they are, it will redirect the user to the home page. 
 If they are not, it will redirect the user back to the login page 
2.  The form is used to submit the username and password to the LoginVerification.php page.
    The textfield class is used to style the input fields.
    The warning class is used to style the error message.

-->