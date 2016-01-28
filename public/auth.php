<?php require_once('../includes/functions.php'); 

session_start();

if(isset($_POST['username'])) {
    $errmsg = array();
    $errflag = false;

    $username = $_POST['username'];
    $password = $_POST['password'];

    //if username is empty
    if($username == "") {
        $errmsg[] = "You must enter a username";
        $errflag = true;
    }

    //if password is empty
    if($password == "") {
        $errmsg[] = "You must enter a password";
        $errflag = true;
    }

    $stmt = connect()->prepare("SELECT * FROM users WHERE username = :username AND password = (SELECT sha1(:password))");
    $stmt->execute(array(
        ':username' => $username,
        ':password' => $password
    ));
    $result = $stmt->fetchColumn();

    $adminname = $result['name'];
    $id = $result['id'];

    if($result > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $adminname;
        $_SESSION['id'] = $id;
        header("location: admin.php");
    }
    else {
        $loginErrMsg = "Login failed.";
    }

}

?>

Logging in...