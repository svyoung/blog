<?php require_once("../includes/functions.php");

session_start();

 // submit comment for approval
    if(isset($_POST['comment_submit'])) {

        $c_name = strip_html_tags($_POST['c_name']);
        $c_email = strip_html_tags($_POST['c_email']);
        $c_website = strip_html_tags($_POST['c_website']);
        $c_date = date('Y-m-d');
        $c_content = strip_html_tags($_POST['c_content']);

        if($_POST['answer'] == $_SESSION['answer']) {
        	// $query = connect()->prepare("INSERT INTO comments (c_name, c_email, c_website, c_date, c_content, approved, postid) VALUES (:c_name, :c_email, :c_website, :c_date, :c_content, :approved, :postid)"); 
        // $query->execute(array(
        //         ':c_name' => $c_name,
        //         ':c_email' => $c_email,
        //         ':c_website' => $c_website,
        //         ':c_date' => $c_date,
        //         ':c_content' => $c_content,
        //         ':approved' => 0,
        //         ':postid' => $id
        //     ));

        $email = "truong.vee@gmail.com";
        $subject = $c_name . " commented on your blog";
        $message = $c_content;
        $headers = "From: Samvyoung noreply@samvyoung.com\r\n";
        $headres = "Reply-To: ".$c_name." <".$c_email.">\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // mail($email, $subject, $message, $headers); 

        $commentmsg = "<div id='commentmsg'>Your submission was successful and is awaiting approval.</div>";
        }
        else {
            
        }

        
    }