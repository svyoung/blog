<?php require_once("../includes/functions.php");
if(!isset($_SESSION['loggedin'])) {
    header("Location: noauth.php ");
}
else {

    function selected($uri = "") {
        $currentfile = basename($_SERVER['REQUEST_URI'], ".php");

        if($currentfile == $uri) {
            echo "class='selected'";
        }
    }
}
?>

<div class="sidebar">
    <ul id="sidemenu">
        <?php

        ?>

        <li <?php selected("admin-posts"); ?>>
            <a href="admin-posts.php">Manage Posts</a>
            <ul>
                <li <?php selected("new-post"); ?>><a href="new-post.php">New Post</a></li>
                <!-- <li <?php selected("admin-posts"); ?>><a href="admin-posts.php">Manage Posts</a></li> -->
            </ul>
        </li>
        <li <?php selected("admin-comments"); ?>><a href="admin-comments.php">Manage Comments</a></li>
        <!-- <li <?php selected(); ?>>
            <a href="#">Pages</a>
            <ul>
                <li <?php selected(); ?>><a href="#">New Page</a></li>
                <li <?php selected(); ?>><a href="#">Manage Pages</a></li>
            </ul>
        </li> -->
        <li <?php selected("account"); ?>><a href="account.php">Account Settings</a></li>
        <li <?php selected(); ?>><a href="logout.php">Log Out</a></li>
    </ul>
     <a href="index.php" target="_blank" class="button">View Blog</a>
</div>

