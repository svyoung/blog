<?php require_once("../includes/functions.php");
   get_header();

   session_start();

   	$digit1 = mt_rand(1,20);
    $digit2 = mt_rand(1,20);
    if( mt_rand(0,1) === 1 ) {
    	$math = "$digit1 + $digit2";  
    	$_SESSION['answer'] = $digit1 + $digit2;                
    } else {
    	$math = "$digit1 - $digit2";           
        $_SESSION['answer'] = $digit1 - $digit2;           
    }

    $captchamsg = "";
    $errorname = "";
    $erroremail = "";
    $errorcontent = "";
    $errorcount = array();


if(isset($_POST['contact'])) {
    	if($_POST['contactname'] == "" ) {
			$errorname = "<span class='error'>Please supply a name</span><br />";
			$errorcount[] = "name";
		}
		if($_POST['contactemail'] == "" ) {
			$erroremail = "<span class='error'>Please supply an email</span><br />";
			$errorcount[] = "email";
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['contactemail'])) {
            $erroremail = "<span class='error'>Please enter a valid email address</span>";
            $errorcount[] = "valid email";
    	}
		if($_POST['contactcontent'] == "" ) {
			$errorcontent = "<span class='error'>You have to write something!</span><br />";
			$errorcount[] = "content";
		}
    	if($_POST['answer'] != $_SESSION['answer'] ) {
    		$captchamsg = "<span class='error'>Wrong answer. Try again.</span>";
    		$errorcount[] = "captcha";
    	}
    	if(count($errorcount) == 0) {
            
            $contactname = strip_html_tags($_POST['contactname']);
            $contactemail = strip_html_tags($_POST['contactemail']);
            $contactcontent = strip_html_tags($_POST['contactcontent']);

            $email = "truong.vee@gmail.com";
            $subject = $contactname . " contacted you through your website";
            $message = $contactcontent;
            $headers = "From: ". $contactname . " <" . strip_tags($_POST['contactemail']) . ">\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			mail($email, $subject, $message, $headers); 
        }
    }


?>

<div id="contact">
	<div class="container">
		<div id="contactform">
			<h1>Contact</h1>
			<form action="" method="post">
				<?php echo $errorname; ?>
				<input name="contactname" type="text" placeholder="Name"> <br />
				<?php echo $erroremail; ?>
				<input name="contactemail" type="text" placeholder="Email"> <br />
				<?php echo $errorcontent; ?>
				<textarea name="contactcontent" placeholder="Behind every great man is a woman rolling her eyes."></textarea><br />
				<strong>What's <?php echo $math; ?></strong>? <?php echo $captchamsg; ?><br />
				<input name="answer" type="text" /><br />
				<button type="submit" name="contact">Submit</button>
			</form>
		</div>
	</div>
</div>
<?php get_footer(); ?>