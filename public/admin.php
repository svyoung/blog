<?php require_once("../includes/functions.php");
session_start();

if(!isset($_SESSION['loggedin'])) {
    header("Location: noauth.php ");
}
else {
    get_adminheader();
}
?>
    <div id="main_wrapper">
        <?php get_admin_sidebar(); ?>
        <div class="main_content">
<!--            --><?php //get_adminpage("admin_dashboard"); ?>
            Ryan Gosling and Andrew Moss rocks!
        </div>
    </div>

<?php get_adminfooter(); ?>