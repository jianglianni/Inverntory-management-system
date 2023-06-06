<?php
// Start the session
session_start();     // creates a session or resumes the current one based on a session identifier passed via a GET or POST
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fatter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/fatter.css?id=3">
        <script src="js/search.js?id=1"></script>
    </head>
    <body>
        <?php
        require_once('database.php');    // used to embed PHP code from another file
        $db = db_connect(); //my connection

        $order = 'DESC';
        $userid = 0;

        // Begenning of two-way selection statement:

        if(empty($_GET))
        {
            $order = 'DESC';
        }
        else if(!empty($_GET['order']) && $_GET['order'] == 'a')
        {
            $order = 'ASC';
        }
        else if(!empty($_GET['order']) && $_GET['order'] == 'd')
        {
            $order = 'DESC';
        }

        if(!empty($_GET['user']))
        {
            $userid = $_GET['user'];
        }

        
         
        $search = '';
        $sql = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST')   // global variable which holds information about headers, paths, and script locations
        { 
            $search = $_POST['search']; // access the form data
            $sql = "SELECT * FROM post where message like '%$search%' "; //query string
        }
        else if(!empty($userid))
        {
            $sql = "SELECT * FROM post "; //query string
            $sql.= "where userid = '$userid'";
        }
        else
        {
            $sql = "SELECT * FROM post "; //query string
        }
        
        $sql.= "ORDER BY date ";
        $sql.= $order;
        $result_set = mysqli_query($db, $sql);  // represents the result set returned by a fetch query in MySQL
        function renderHtml() //PHP script is executed, the output is built on the server, and the result sent as HTML to the client browser for rendering.
        {
            if(is_null($_SESSION["id"]))
            {     
                return "<div class=\"footerTemplate\">
                <div>
                    <h1>Don't miss what's happening<h1>
                    <span>People on Twitter are the first to know</span>  
                </div>
                <div class=\"footerButtons\">
                    <a class=\"login\" href=\"Login.php\">Log in</a>
                    <a class=\"registration\" href=\"Registration.html\">Sign up</a>
                </div>
            </div>";
            }
            else
            {
                return "";
            }
        }

        function renderAvata() //PHP script is executed, the output is built on the server, and the result sent as HTML to the client browser for rendering2.
        {
            return $_SESSION["id"];
        }
        ?> <!--html:-->
        <div class="homeTemplate">
                <div class="section1">
                    <img class="logo" src="img/blue-bird.jpg" alt="Avatar"/>    
                    <nav>
                        <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Notification</a></li>
                        </ul>
                    </nav>
                    <div class="line">
                    </div>
                </div>
                <article> <!-- represents a complete, or self-contained, composition --> 
                    <ul class="nav">
                        <li><a href="search.php">Home</a></li>
                        <li><a href="search.php?order=d">Latest</a></li>
                        <li><a href="search.php?order=a">Oldest</a></li>
                    </ul>    
                    <hr>   
                    <div class="top">             
                        <?php 
                        while ($results = mysqli_fetch_assoc($result_set)) { ?>
                            <div class="message">
                                <div>
                                    <img class="icon" src="img/<?php echo $results['userid']; ?>.jpg" alt="Avatar"/>
                                </div>
                                <div class="content">
                                    <b><?php echo $results['username']; ?></b><img class="verify" src="img/verify.jpg" />
                                    <?php echo $results['date']; ?>
                                    <p><?php echo $results['message']; ?></p>
                                    <img class="pic" src="img/<?php echo $results['img']; ?>.jpg" />
                                </div>
                            </div>
                            <hr>
                        <?php } 
                        ?>
                    </div>  
                </article>
                <nav class="navRight">
                    <div class="search">
                        <form name="search" action="search.php" method="POST">
                            <input type="text" placeholder="Search Fatter" name="search" id="search">
                        </form>
                    </div>
                    <div class="followSide">
                        <h2 class="follerTitle">Who to follow</h2>

                        <?php 
                        $sql = "SELECT * FROM user "; //query string

                        $result_set = mysqli_query($db, $sql);
                        while ($results = mysqli_fetch_assoc($result_set)) { ?>
                            <div class="follow">
                                <div>
                                    <img class="followIcon" src="img/<?php echo $results['id']; ?>.jpg" />
                                </div>
                                <div class="follower">
                                    <b><?php echo $results['name']; ?></b>    
                                    <div class="light">
                                    <?php echo $results['username']; ?>
                                    </div>
                                </div>
                                <div class="filter">
                                    <a href="search.php?user=<?php echo $results['id']; ?>" id="followButton">View</a>
                                </div>
                            </div>
                            <hr>
                        <?php } 
                        ?>
                </nav>
                <?php
                    echo renderHtml(); // turning HTML code into an interactive page that website visitors expect to see when clicking on a link.
                ?>
            </section> <!-- creating standalone sections in a web page -->
        </div>    

    </body>
</html>

