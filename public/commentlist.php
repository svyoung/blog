<?php require_once("../includes/functions.php");

$postid = $_GET['id'];

$query = connect()->prepare("SELECT * FROM comments WHERE approved = :approved AND postid = :postid ORDER BY commentid DESC");
$query->execute(array(
		':approved' => 1,
		':postid' => $postid
	));
//$comment = $query->fetchAll();
//var_dump($comment)
?>
<?php
   while($comment = $query->fetch(PDO::FETCH_ASSOC)) {
   	//	var_dump($comment);

	    $c_name = $comment['c_name'];
		$c_email = $comment['c_email'];
		$c_website = $comment['c_website'];
		$c_date = $comment['c_date'];
		$c_content = $comment['c_content'];
    ?>
<div id="comment">
	<div class="c_name">
		<span class="author"><?php echo $c_name; ?></span> [<a href="mailto:<?php echo $c_email;?>">@</a>] [<a href="<?php echo $c_website;?>">www</a>]
	</div>
	<div class="bubble">
		<span><?php echo $c_content; ?></span> <br/>
		<span class="date"><?php echo $c_date; ?></span>
	</div>
</div>
<?php } ?>