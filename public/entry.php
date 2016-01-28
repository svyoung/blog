<?php require_once("../includes/functions.php");
get_header();

    session_start();

    $id = $_GET['id'];
    $commentmsg = "";

    $q = connect()->prepare("SELECT * FROM posts JOIN users ON posts.userid = users.id WHERE postid = :postid AND active = 1 AND visible = 1");
    $q->execute(array(
        ':postid' => $id
    ));
    $post = $q->fetch();

    $title = $post['title'];
    $date = $post['date'];
    $content = $post['content'];
    $author = $post['name'];

    $num1 = mt_rand(0, 20);
    $num2 = mt_rand(0, 20);

    if(mt_rand(0, 1) == 1) {
        $math = "$num1 - $num2";
        $_SESSION['captcha'] = $math;
        $_SESSION['answer'] = $num1 - $num2;
    }
    else {
        $math = "$num1 + $num2";
        $_SESSION['captcha'] = $math;
        $_SESSION['answer'] = $num1 + $num2;
    }

    if(isset($_GET['cmsgerror'])) {
        $cmsg = "<div class='error'>Wrong answer. Try again</div>";
    } else {
        $cmsg = "";
    }

?>
<div id="main">
    <div id="blog">
        <div class="container">
            <div class="nf">
                <?php echo $commentmsg; ?>
                <div id="entry">
                    <h1><?php echo $title; ?></h1>                
                    <div class="content">
                        <?php echo $content; ?>
                    </div>
                    <h3><?php echo $date; ?></h3>
                    <!-- <span class="author">Posted by: <?php echo $author; ?></span> -->
                </div>

                

                <div id="disqus_thread">
                    <h2>Comments</h2>
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'samvyoung'; // Required - Replace example with your forum shortname

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
    
                    <!-- <div id="commentform">
                        <form method="post" action="postcomment.php">
                            <label for="name">Name: </label>
                            <input type="text" name="c_name" placeholder="Name" required><br />
                            <label for="email">Email (optional): </label>
                            <input type="text" name="c_email" placeholder="name@domain.com"><br />
                            <label for="website">Website (optional): </label>
                            <input type="text" name="c_website" placeholder="http://..."><br />
                            <textarea name="c_content" placeholder="Note: tags have been disabled" required></textarea><br />
                            <label for="captcha">What is <strong><?php echo $math; ?></strong>?</label> 
                            <input type="text" name="answer" required> <?php echo $cmsg; ?><br />
                            <button type="submit" name="comment_submit">submit</button>
                        </form>                       
                    </div> -->
                </div>
<!--                  <div id="commentlist">
                    <?php get_commentlist(); ?>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
