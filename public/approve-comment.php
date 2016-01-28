<?php require_once("../includes/functions.php");

session_start();

if(isset($_POST['approveawait'])) {
            $commentid = $_POST['commentid'];

            $approve_comment = connect()->prepare("UPDATE comments SET approved = 1 WHERE commentid = :commentid");
            $approve_comment->execute(array(
                    ':commentid' => $commentid
                ));

            header("Location: admin-comments.php?success=true");
        }