<?php require_once("../includes/functions.php");
session_start();


    if(isset($_POST['draft'])) {
        $e_title = $_POST['title'];
        $e_date = $_POST['date'];
        $e_content = $_POST['content'];
        $e_id = $_POST['postid'];

            $errormsg[0] = "";
            $errormsg[1] = "";
            $errormsg[2] = "";
            $update = connect()->prepare("UPDATE posts SET title = :title, date = :date, content = :content, visible = :visible WHERE postid = :postid");
            $update->execute(array(
                ':title' => $e_title,
                ':date' => $e_date,
                ':content' => $e_content,
                ':visible' => 0,
                ':postid' => $e_id
            ));

            header("Location: admin-posts.php");
            
    } else if(isset($_POST['publish'])) {
        $e_title = $_POST['title'];
        $e_date = $_POST['date'];
        $e_content = $_POST['content'];
        $e_id = $_POST['postid'];

        $update = connect()->prepare("UPDATE posts SET title = :title, date = :date, content = :content, visible = :visible WHERE postid = :postid");
        $update->execute(array(
            ':title' => $e_title,
            ':date' => $e_date,
            ':content' => $e_content,
            ':visible' => 1,
            ':postid' => $e_id
        ));
        $editsuccess = "Edit success!";
        header("Location: admin-posts.php");
    }

?>