<?php require_once("../includes/functions.php");
session_start();

    get_adminheader();

?>
    <div id="main_wrapper">
        <?php get_admin_sidebar(); ?>
        <div class="main_content">
            <h1>All Posts</h1>
            <div id="published">
                <div style="overflow: hidden">
                    <h2 class="left">Published Posts</h2>
                    <a href="new-post.php" class="btn right">New Post</a>
                </div>
                <div id="posts-table">
                    <table style="width: 100%">
                        <thead>
                            <!-- <th style="width: 1%"></th> -->
                            <th style="width: 4%">ID</th>
                            <th style="width: 20%">Title</th>
                            <th style="width: 50%">Content</th>
                            <th style="width: 10%">Date</th>
                            <th>User</th>
                            <th>Action</th>
                        </thead>
                        <?php
                            $posts = connect()->prepare("SELECT * FROM posts JOIN users on posts.userid = users.id WHERE visible != 0 ORDER BY postid DESC");
                            $posts->execute();
                            $results = $posts->fetchAll();
                            foreach($results as $result) {
                                $postid = $result['postid'];
                                $title = $result['title'];
                                $content = $result['content'];
                                $date = date('n-j-Y', strtotime($result['date']));
                                $name = $result['name'];
                                echo '<tr>';
                                // echo '<td><input type="checkbox" name="item[]" value=""></td>';
                                echo '<td>' .$postid. '</td>';
                                echo '<td><a href="editpost.php?id='.$postid.'">' .$title. '</a></td>';
                                if(strlen($content) > 300) {
                                    $offset = (300 - 3) - strlen($content);
                                    $content = substr($content, 0, strrpos($content, ' ', $offset)) . '...';
                                    echo '<td>' .$content. '</td>';
                                }
                                else {
                                    echo '<td>' .$content. '</td>';
                                }
                                echo '<td>' .$date. '</td>';
                                echo '<td>' .$name. '</td>';
                                echo '<td><a href="editpost.php?id='.$postid.'">Edit</a><br><a href="entry.php?id='.$postid.'">View</a><br><a href="#">Disable</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>
            </div>

            <hr class="sep" />

            <div id="drafts" style="overflow: hidden">
                <h2>Saved Drafts</h2>
                <div id="posts-table">
                    <table style="width: 100%">
                        <thead>
                        <!-- <th style="width: 1%"></th> -->
                        <th style="width: 4%">ID</th>
                        <th style="width: 20%">Title</th>
                        <th style="width: 50%">Content</th>
                        <th style="width: 10%">Date</th>
                        <th>User</th>
                        <th>Action</th>
                        </thead>
                        <?php
                        $posts = connect()->prepare("SELECT * FROM posts JOIN users on posts.userid = users.id WHERE visible = 0 ORDER BY postid DESC");
                        $posts->execute();
                        $results = $posts->fetchAll();
                        foreach($results as $result) {
                            $postid = $result['postid'];
                            $title = $result['title'];
                            $content = $result['content'];
                            $date = date('n-j-Y', strtotime($result['date']));
                            $name = $result['name'];
                            echo '<tr>';
                            // echo '<td><input type="checkbox" name="item[]" value=""></td>';
                            echo '<td>' .$postid. '</td>';
                            echo '<td><a href="editpost.php?id='.$postid.'">' .$title. '</a></td>';
                            if(strlen($content) > 300) {
                                $offset = (300 - 3) - strlen($content);
                                $content = substr($content, 0, strrpos($content, ' ', $offset)) . '...';
                                echo '<td>' .$content. '</td>';
                            }
                            else {
                                echo '<td>' .$content. '</td>';
                            }
                            echo '<td>' .$date. '</td>';
                            echo '<td>' .$name. '</td>';
                            echo '<td><a href="editpost.php?id='.$postid.'">Edit</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php get_adminfooter(); ?>