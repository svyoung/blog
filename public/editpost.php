<?php require_once("../includes/functions.php");
session_start();

    get_adminheader();

?>


    <div id="main_wrapper">
        <?php get_admin_sidebar(); ?>
        <div class="main_content">
            <h1>Edit Post</h1>
            <div id="post">
                <?php
                $id = $_GET['id'];

                $query = connect()->prepare("SELECT * FROM posts WHERE postid = :postid");
                $query->execute(array(
                    ':postid' => $id
                ));
                $post = $query->fetch();

                $title = $post['title'];
                $content = $post['content'];
                $date = $post['date'];

                ?>
                <form action="savepost.php" method="post">
                    <input type="hidden" name="postid" value="<?php echo $id ;?>">
                    <input type="text" name="title" class="title" value="<?php echo $title; ?>"><br />
                    <input type="date" name="date" class="date" value="<?php echo $date; ?>"><br />
                    <textarea name="content" class="content"><?php echo $content; ?></textarea><br />
                    <button type="submit" name="publish" class="publish">Publish</button>
                    <button type="submit" name="draft" class="draft">Save Draft</button>
                </form>
            </div>
        </div>
    </div>


<?php get_adminfooter(); ?>