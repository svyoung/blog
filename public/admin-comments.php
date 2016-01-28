<?php require_once("../includes/functions.php");
session_start();

    get_adminheader();
    $successmsg = "";

    if(isset($_GET['success'])) {
        if($_GET['success'] == true) {
            $successmsg = "<span class='success'>Comment approved!</span>";
        }
    }

?>
    <div id="main_wrapper">
        <?php get_admin_sidebar(); ?>
        <div class="main_content">
            <h1>All Comments</h1>
            <div id="approved_comments">
                <?php echo $successmsg; ?>
                <div style="overflow: hidden">
                    <h2 class="left">Approved Comments</h2>
                </div>
                <div id="comments-table">
                    <table style="width: 100%">
                        <thead>
<!--                             <th style="width: 1%"></th>
                            <th style="width: 4%">ID</th> -->
                            <th style="width: 15%">Commenter</th>
                            <th style="width: 35%">Content</th>
                            <th style="width: 10%">Date</th>
                            <th style="width: 25%">On Post</th>
                            <th>Action</th>
                        </thead>
                        <?php
                            //DISPLAY APPROVED COMMENTS
                            $posts = connect()->prepare("SELECT * FROM comments JOIN posts on comments.postid = posts.postid WHERE approved = 1 ORDER BY commentid DESC");
                            $posts->execute();
                            $results = $posts->fetchAll();
                            foreach($results as $result) {
                                $commentid = $result['commentid'];
                                $c_name = $result['c_name'];
                                $c_content = $result['c_content'];
                                $c_date = date('n-j-Y', strtotime($result['c_date']));
                                $c_email = $result['c_email'];
                                $c_website = $result['c_website'];
                                $posttitle = $result['title'];
                                $postid = $result['postid'];
                            ?>
                                <tr>
<!--                                     <td><input type="checkbox" name="item[]" value=""></td>
                                    <td><?php echo $id; ?></td> -->
                                    <td>        
                                        <strong><?php echo $c_name; ?></strong> <br />
                                        <a href="mailto:<?php echo $c_email; ?>">[email]</a> <a href="<?php echo $c_website; ?>">[website]</a>
                                    </td>
                                <?php 
                                if(strlen($c_content) > 300) {
                                    $offset = (300 - 3) - strlen($c_content);
                                    $c_content = substr($c_content, 0, strrpos($c_content, ' ', $offset)) . '...';
                                    ?>
                                    <td><?php echo $c_content; ?></td>
                                <?php }
                                else { ?>
                                    <td><?php echo $c_content; ?></td>
                                <?php } ?>
                                    <td><?php echo $c_date; ?></td>
                                    <td><a href="entry.php?id=<?php echo $postid;?>"><?php echo $posttitle; ?></a></td>
                                    <td>
                                        <a href="editcomment.php?id='.$postid.'">Edit</a><br />
                                        <form action="">
                                            <button type="submit" name="deleteapproved" onclick="confirm('Are you sure you want to delete?')" class="deletecomment">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>

            <hr class="sep" />

            <div id="awaiting" style="overflow: hidden">
                <h2>Awaiting Approval</h2>
                <div id="comments-table">
                    <table style="width: 100%">
                        <thead>
<!--                             <th style="width: 1%"></th>
                            <th style="width: 4%">ID</th> -->
                            <th style="width: 15%">Commenter</th>
                            <th style="width: 35%">Content</th>
                            <th style="width: 10%">Date</th>
                            <th style="width: 25%">On Post</th>
                            <th>Action</th>
                        </thead>
                        <?php
                            //DISPLAY COMMENTS AWAITING APPROVAL
                            $posts = connect()->prepare("SELECT * FROM comments JOIN posts on comments.postid = posts.postid WHERE approved = 0 ORDER BY commentid DESC");
                            $posts->execute();
                            $results = $posts->fetchAll();
                            foreach($results as $result) {
                                $commentid = $result['commentid'];
                                $c_name = $result['c_name'];
                                $c_content = $result['c_content'];
                                $c_date = date('n-j-Y', strtotime($result['c_date']));
                                $c_email = $result['c_email'];
                                $c_website = $result['c_website'];
                                $posttitle = $result['title'];
                                $postid = $result['postid'];

                                ?>
                                <tr>
<!--                                     <td><input type="checkbox" name="item[]" value=""></td>
                                    <td><?php echo $id; ?></td> -->
                                    <td>
                                        <strong><?php echo $c_name; ?></strong> <br />
                                        <a href="mailto:<?php echo $c_email; ?>">[email]</a> <a href="<?php echo $c_website; ?>">[website]</a>
                                    </td>
                                <?php 
                                    if(strlen($c_content) > 300) {
                                    $offset = (300 - 3) - strlen($c_content);
                                    $c_content = substr($c_content, 0, strrpos($c_content, ' ', $offset)) . '...';
                                    ?>
                                    <td><?php echo $c_content; ?></td>
                                <?php }
                                    else {
                                        ?>
                                    <td><?php echo $c_content; ?></td>
                                <?php } ?>
                                    <td><?php echo $c_date; ?></td>
                                    <td><a href="entry.php?id=<?php echo $postid;?>"><?php echo $posttitle; ?></a></td>
                                    <td>
                                        <form action="approve-comment.php" method="post">
                                            <input type="hidden" name="commentid" value="<?php echo $commentid; ?>" />
                                            <button type="submit" name="approveawait">Approve</button>
                                            <!-- <button type="submit" name="deleteawait" onclick="confirm('Are you sure you want to delete?')">Delete</button> -->
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php get_adminfooter(); ?>