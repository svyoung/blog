<?php require_once("../includes/functions.php");

session_start();
get_adminheader();

    $adminname = $_SESSION['name'];
    $id = $_SESSION['id'];
    // var_dump($id);

    $pwmsg = "";

    $account = connect()->prepare("SELECT * FROM users WHERE id = :id");
    $account->execute(array(
            ':id' => $id
        ));
    $user = $account->fetch();

    $adminname = $user['name'];
    $email = $user['email'];
    $username = $user['username'];

?>


<div id="main_wrapper">
    <?php get_admin_sidebar(); ?>
    <div class="main_content">
        <h1>Account Settings</h1>
        <div id="account">
            <h3>&#187; Account Information</h3>
            <form method="post" action="" class="account">
                <label for="name">Name: </label>
                <input type="text" name="name" class="name" value="<?php echo $adminname; ?>"><br />
                <label for="username">Username:</label>
                <input type="text" name="username" class="username" value="<?php echo $username; ?>"><br />
                <label for="email">Email: </label>
                <input type="text" name="email" class="email" value="<?php echo $email; ?>"><br />
                <button type="submit" name="update" class="submit">Submit</button>
            </form>
        </div>
        <div id="chgpw">
            <h3>&#187; Change Password</h3>
            <form method="post" action="" class="chgpw">
                <label for="newpw">New Password</label>
                <input type="password" name="password"><br />
                <label for="retypepw">Re-type Password</label>
                <input type="password" name="password2"><br />
                <button type="submit" name="chgpw" class="submit">Change Password</button> <?php echo $pwmsg; ?>
            </form>
        </div>
    </div>
</div>

<?php

    if(isset($_POST['update'])) {
        $new_adminname = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        // var_dump($id, $u_name, $u_username, $u_email);

        $update = connect()->prepare("UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id");
        $update->execute(array(
                ':name' => $new_adminname,
                ':username' => $username,
                ':email' => $email,
                ':id' => $id
            ));
    }

    if(isset($_POST['chgpw'])) {
        if($_POST['password'] == $_POST['password2']) {
            $password = $_POST['password'];
            $changepw = connect()->prepare("UPDATE users SET password = (SELECT sha1(:password)) WHERE id = :id");
            $changepw->execute(array(
                    ':password' => $password,
                    ':id' => $id
                ));
            $pwmsg = "<span class='success'>Password saved</span>";
        }
        else {
            $pwmsg = "<span class='error'>Password does not match</span>";
        }
    }
?>

<? get_adminfooter(); ?>