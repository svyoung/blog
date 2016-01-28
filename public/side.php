<?php require_once("../includes/functions.php"); ?>
<div id="sam">
	<div id="bio">
		<span class="sam">svy</span>
		<h2>Sam</h2>
		<p>Software Engineer. Foodie. Dog lover. Travel far and travel often. </p>
		<p>samxyoung[at]gmail.com</p>
	</div>
	<div id="buddies">
		<h2>Buddies</h2>
		<ul>
			<li><a href="http://rogerngo.com">Roger Ngo</a></li>
			<li><a href="http://calvinkwan.net">Calvin Kwan</a></li>
			<li><a href="http://derekdho.com">Derek Ho</a></li>
		</ul>
	</div>
	<!-- <div id="recentposts">
		<h2>Recent Posts</h2>	
		<ul>
			<?php 
				$query = connect()->prepare("SELECT title, postid FROM posts WHERE active = 1 AND visible =1 ORDER BY postid DESC LIMIT 5");
				$query->execute();
				$recentposts = $query->fetchAll();   

				foreach($recentposts as $recentpost) {	
					$title = $recentpost['title'];	
					$postid = $recentpost['postid'];	
			?>
			<li><a href="entry.php?id=<?php echo $postid; ?>"><?php echo $title; ?></a></li>
			<?php } ?>
		</ul>
	</div>
	<div id="archive">
		<h2>Archive</h2>
		<ul>
		<?php 
			$yquery = connect()->prepare("SELECT DISTINCT YEAR(date) as year FROM posts WHERE visible = 1 AND active = 1");
			$yquery->execute();
				while($yearArchive = $yquery->fetch(PDO::FETCH_ASSOC)) {

					$year = $yearArchive['year'];
		 ?>
		 	<li><a href="#"><?php echo $year; ?></a>
		 		<ul>
		 			<?php 
		 				$mquery = connect()->prepare("SELECT MONTH(date) as month,count(*) as postcount FROM posts WHERE YEAR(date)=".$yearArchive['year']." AND visible = 1 AND active = 1 GROUP BY MONTH(date)");
		 				$mquery->execute();

		 				while($monthArchive = $mquery->fetch(PDO::FETCH_ASSOC)) {

		 					$monthNum = $monthArchive['month'];
		 					$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		 					$month = $dateObj->format('F');

		 			?>
		 			<li><a href="archive.php?month=<?php echo $month; ?>&year=<?php echo $year;?>"><?php echo $month; ?> (<?php echo $monthArchive['postcount']; ?>)</a></li>
		 			<?php } ?>
		 		</ul>
		 	</li>
		 <?php } ?>
		 <!-- <li><a href="#">All archive</a></li> 
		</ul>
	</div> -->
	<p class="quote">"It's too bad that stupidity isn't painful" - Anton LaVey</p> 
</div>