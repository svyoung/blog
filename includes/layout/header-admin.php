<?php

if(!isset($_SESSION['loggedin'])) {
    header("Location: noauth.php ");
}
else {
    $username = $_SESSION['username'];
    $adminname = $_SESSION['name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog - Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_main.css" />

</head>

<body>

<div id="wrapper">
    <div class="topnav">
        <span class="welcome">...there you are! Welcome to your own awesome blog, <strong><?php echo $adminname; ?></strong>!</span> 
    </div>