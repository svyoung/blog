<?php require_once("../includes/functions.php");

session_start();

if(isset($_POST['contact'])) {

        $contactname = strip_html_tags($_POST['contactname']);
        $contactemail = strip_html_tags($_POST['contactemail']);
        $contactcontent = strip_html_tags($_POST['contactcontent']);
        
        if($_POST['answer'] != $_SESSION['answer'] ) {
            $captchamsg = "<span class='error'>Wrong answer. Try again.</span>";
        }       
        if(!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "<span class='error'>Please enter a valid email</span><br />";
        }
        if($contactname == "" ) {
            $errorname = "<span class='error'>Please enter your name</span><br />";
        }
        if($contactcontent == "") {
            $errorcontent = "<span class='error'>Dude, you gotta write something</span><br />";
        }
        
        if($_POST['answer'] == $_SESSION['answer'] && filter_var($contactemail, FILTER_VALIDATE_EMAIL) && $contactname != "" && $contactcontent != "") {
            $captchamsg = "";       

            $email = "truong.vee@gmail.com";
            $subject = $contactname . " wants to talk to you! It's from SVY dot com";
            $message = $contactcontent;
            $headers = "From: Samvyoung noreply@samvyoung.com\r\n";
            $headres = "Reply-To: ".$contactname." <".$contactemail.">\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($email, $subject, $message, $headers); 

            

            header("Location: contact.php?success=true");
        }
    }

?>