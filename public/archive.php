<?php require_once("../includes/functions.php");

get_header();

	$getmonth = $_GET['month'];
	$year = $_GET['year'];
	$month = date("m", strtotime($getmonth));
?>

<div id="main">
	<div id="blog">
		<div class="container">
			<div id="posts">
				<!-- IF querystring has month AND year -->
				<?php 
					if(isset($year) && isset($month)) {
					$showpostsbymonthyear = connect()->prepare("SELECT * FROM posts WHERE YEAR(date) = :year AND MONTH(date) = :month AND visible = 1 ORDER BY date DESC");
					$showpostsbymonthyear->execute(array(
						':year' => $year,
						':month' => $month
						));
				?>
				<h1 class="archive">Posts for <?php echo $getmonth; ?> <?php echo $year; ?></h1>
				<?php 
					while($allpostsbymonthyear = $showpostsbymonthyear->fetch(PDO::FETCH_ASSOC)) {
						$title = $allpostsbymonthyear['title'];
						$date = $allpostsbymonthyear['date'];
						$content = $allpostsbymonthyear['content'];
						$id = $allpostsbymonthyear['postid'];
				?>
				<div id="entry" class="post-<?php echo $id; ?>">
					<h1><?php echo "<a href='entry.php?id=".$id."'>" .$title. "</a>"; ?></h1>
					<div class="entry_content">
                        <?php 
                            if(strlen($content) > 2000) {
                                $contentCut = substr($content, 0, 2000);

                                $content = substr($contentCut, 0, strrpos($contentCut, " ")).'...<p><a href="entry.php?id='.$id.'" class="readmore">Read the rest &#x21aa;</a></p>';
                                echo $content; 
                            } else {
                                echo $content; 
                            }
                        ?>
                        <hr class="sep" />
                        <span class="author"><?php echo $date;?></span>
                       <?php 
                            $cquery = connect()->prepare("SELECT COUNT(commentid) as commentno FROM comments WHERE postid='".$id."' AND approved = 1");
                             $cquery->execute();
                             $result = $cquery->fetch(PDO::FETCH_ASSOC);
                             $commentno = $result['commentno'];
                        ?>
                        <span class="comments"><a href="entry.php?id=<?php echo $id; ?>#comments">Comments (<?php echo $commentno; ?>)</a></span>
                    </div>
				</div>
				<?php } } ?>
			</div>	
			<div id="side">
            	<?php get_side(); ?>
        	</div>
		</div>
		
	</div>
</div>

<?php get_footer(); ?>