<?php require_once("../includes/functions.php");
   get_header();

   session_start();

   	if(isset($_SESSION['challenge'])) {
   		$math = $_SESSION['challenge'];
   	}
   	else {
   		$math = "0";
   	}

   	$digit1 = mt_rand(1,20);
    $digit2 = mt_rand(1,20);
    if( mt_rand(0,1) === 1 ) {
    	$math = "$digit1 + $digit2";  
    	$_SESSION['challenge'] = $math;
    	$_SESSION['answer'] = $digit1 + $digit2;                
    } else {
    	$math = "$digit1 - $digit2"; 
    	$_SESSION['challenge'] = $math;          
        $_SESSION['answer'] = $digit1 - $digit2;           
    }

    $captchamsg = "";

	$sentmsg = "";
	$errorname = "";
	$emailerror = "";
	$errorcontent = "";

	if(isset($_GET['success']) && $_GET['success'] == true) {
		$sentmsg = "<div class='msgsent'>Your message has been successfully submitted! Give me a sec to respond!</div>";
	}

	
?>

<div id="contact">
	<div class="container">
		<?php echo $sentmsg;?>
		<div id="contactform">							
			<h1>Contact</h1>	
			<form action="mail.php" method="post">
				<?php echo $errorname; ?>
				<input name="contactname" type="text" placeholder="Name"> <br />
				<?php echo $emailerror; ?>
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