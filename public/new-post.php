<?php require_once("../includes/functions.php");
session_start();
if(!isset($_SESSION['loggedin'])) {
    header("Location: noauth.php ");
}
else {
    get_adminheader();

    $name = $_SESSION['name'];
    $id = $_SESSION['id'];

    $errormsg[0] = "";
    $errormsg[1] = "";
    $errormsg[2] = "";

    if(isset($_POST['publish'])) {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $content = $_POST['content'];

        if(empty($title)) {
            $errormsg[0] = "Please enter a title";
        }
        if(empty($date)) {
            $errormsg[1] = "Please pick a date";
        }
        if(empty($content)) {
            $errormsg[2] ="Gotta write something!";
        }

        $errormsg = array_filter($errormsg);
        //var_dump($errormsg);

        if(empty($errormsg)) {
            $errormsg[0] = "";
            $errormsg[1] = "";
            $errormsg[2] = "";
            post_new_entry($title, $date, $content, $id);
        }
    }
    if(isset($_POST['draft'])) {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $content = $_POST['content'];

        if(empty($title)) {
            $errormsg[0] = "Please enter a title";
        }
        if(empty($date)) {
            $errormsg[1] = "Please pick a date";
        }
        if(empty($content)) {
            $errormsg[2] ="Gotta write something!";
        }

        $errormsg = array_filter($errormsg);

        if(empty($errormsg)) {
            $errormsg[0] = "";
            $errormsg[1] = "";
            $errormsg[2] = "";
            save_draft($title, $date, $content, $id);
        }
    }

    $newdate = date('m/d/Y');
}
?>
    <div id="main_wrapper">
        <?php get_admin_sidebar(); ?>
        <div class="main_content">
            <h1>New Post</h1>
            <div id="post">
                <form method="post" action="" class="newpost">
                    <input type="text" name="title" class="title" placeholder="Title"><br />
                    <span class="error"><?php echo $errormsg[0]; ?></span>
                    <input type="date" name="date" class="date" value="s"><br />
                    <span class="error"><?php echo $errormsg[1];?></span>
                    <textarea name="content" class="content" placeholder="howdy"></textarea><br />
                    <span class="error"><?php echo $errormsg[2]; ?></span>
                    <button type="submit" name="publish" class="publish">Publish</button>
                    <button type="submit" name="draft" class="draft">Save Draft</button>
                </form>
            </div>
        </div>
    </div>

<?php get_adminfooter(); ?>