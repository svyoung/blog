<?php require_once("../includes/functions.php");

    $query = connect()->prepare(
        "SELECT * FROM posts JOIN users on posts.userid = users.id WHERE visible = 1 ORDER BY date DESC");
    $query->execute();

    get_header();
?>

<div id="main">    
    <div id="blog">        
        <div class="container">
            <div id="posts">
                <?php
                   while($posts = $query->fetch(PDO::FETCH_ASSOC)) {

                    $id = $posts['postid'];
                    $title = $posts['title'];
                    $date = $posts['date'];
                    $content = $posts['content'];
                    $name = $posts['name'];
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
                        <span class="author"><?php  echo $date;?></span>
                       <?php 
                            $cquery = connect()->prepare("SELECT COUNT(commentid) as commentno FROM comments WHERE postid='".$id."' AND approved = 1");
                             $cquery->execute();
                             $result = $cquery->fetch(PDO::FETCH_ASSOC);
                             $commentno = $result['commentno'];
                        ?>
                        <span class="comments"><?php echo "<a href='entry.php?id=".$id."#disqus_thread'></a>"; ?></span> 
                    </div>
                </div>
                <?php } ?>
            </div>
            <div id="side">
                <?php include_once 'side.php' ?>
            </div>
        </div>        
    </div>
</div>

<?php get_footer(); ?>