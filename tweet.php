<?php
// Start the session
session_start();
$_SESSION['page']= 'tweet';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fatter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/fatter.css?id=3">
        <script src="js/fatter.js?id=3"></script>
    </head>
    <body>
        <?php
        require_once('database.php');    
        $db = db_connect(); //my connection

        $del = '';
        if(!empty($_GET['del']))
        {
            $del = $_GET['del'];
            $sql = "DELETE FROM post WHERE id ='$del'";
            $result = mysqli_query($db, $sql);
        }

        $sql = "SELECT * FROM post "; //query string
        $sql .= "ORDER BY Id DESC";
        $result_set = mysqli_query($db, $sql);
        $i = 0;

        function renderHtml()
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

        function renderAvata()
        {
            return $_SESSION["id"];
        }
        ?>
        <div class="homeTemplate">
                <div class="section1">
                    <img class="logo" src="img/blue-bird.jpg" alt="Avatar"/>    
                    <nav>
                        <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="tweet.php">Tweet</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                    <div class="line">
                    </div>
                </div>
                <article>
                    <h2>Tweet</h2>
                    <form action="createPost.php" method="post" >
                        <div class="message">
                            <div>
                                <img class="icon" src="img/<?php echo renderAvata(); ?>.jpg" alt="Avatar"/>
                            </div>
                            <div class="content">
                                <textarea id="fatterContent" name="comment" rows="2" cols="45" placeholder="What's happening"></textarea>
                                <br>
                                <input type="submit" name="submit" class="fatterButton" diabled>
                            </div>
                        </div>
                    </form>                  
                    <?php while ($results = mysqli_fetch_assoc($result_set)) { ?>
                        <div class="content">
                        <!--  show posts of logged in user  -->
                        <?php if(strval($results['userid']) == strval($_SESSION["id"])){
                        ?>
                        <div class="message">
                            <div>
                                <img class="icon" src="/assignment22/img/<?php echo $results['userid']; ?>.jpg" alt="Avatar"/>
                            </div>
                            <div class="content">
                                <b><?php echo $results['username']; ?></b><img class="verify" src="img/verify.jpg" />
                                <?php echo $results['date']; ?>
                                <p><?php echo $results['message']; ?></p>
                                <img class="pic" src="img/<?php echo $results['img']; ?>.jpg" />
                                <a class="delete" href="tweet.php?del=<?php echo $results['id']; ?>"">delete</a>
                            </div>
                        </div>
                        <hr>
                        <?php
                        }
                        ?>
                    </div>                    
                    <?php } ?>
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
                    echo renderHtml();
                ?>
            </section>
        </div>    

    </body>
</html>

