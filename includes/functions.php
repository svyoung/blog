<?php
define("DB_HOST_DB_NAME", "mysql:host=localhost;dbname=blog");
define("USERNAME", "root");
define("PASSWORD", "");

// connect to db
function connect() {
    
    try {
        $conn = new PDO(DB_HOST_DB_NAME, USERNAME, PASSWORD);
        // echo "successfully connected";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

function is_loggedin() {
    if(isset($_SESSION['loggedin'])) {
        return true;
    }
    else {
        header("Location: noauth.php ");
    }
}

// get header
function get_header() {
   include_once '../public/header.php';
}

//get footer
function get_footer() {
    include_once '../public/footer.php';
}

// get admin header

function get_adminheader() {
    include_once 'layout/header-admin.php';
}

//get admin footer

function get_adminfooter() {
    include_once 'layout/footer-admin.php';
}

// get admin sidebar
function get_admin_sidebar() {
    include_once '../public/sidebar.php';
}

// get admin page
function get_adminpage($page) {
    include_once '../public/'.$page.'.php';
}

function post_new_entry($title, $date, $content, $userid) {
    $query = connect()->prepare("INSERT INTO posts (title, date, content, userid,visible, active) VALUES (:title, :date, :content, :userid, :visible, :active)");
    $query->execute(array(
        ':title' => $title,
        ':date' => $date,
        ':content' => $content,
        ':userid' => $userid,
        ':visible' => 1,
        ':active' => 1
    ));
}

function save_draft($title, $date, $content, $userid) {
    $query = connect()->prepare("INSERT INTO posts (title, date, content, userid,visible) VALUES (:title, :date, :content, :userid, :visible)");
    $query->execute(array(
        ':title' => $title,
        ':date' => $date,
        ':content' => $content,
        ':userid' => $userid,
        ':visible' => 0
    ));
}

function get_published_posts() {
    $posts = connect()->prepare("SELECT * FROM posts JOIN users on posts.userid = users.id WHERE visible != 0 ORDER BY postid DESC");
    $posts->execute();
    $results = $posts->fetchAll();

    return $results;
}

function get_commentlist() {
    include_once '../public/commentlist.php';
}

function get_side() {
    include_once '../public/side.php';
}

function strip_html_tags( $text )
{
    // PHP's strip_tags() function will remove tags, but it
    // doesn't remove scripts, styles, and other unwanted
    // invisible text between tags.  Also, as a prelude to
    // tokenizing the text, we need to insure that when
    // block-level tags (such as <p> or <div>) are removed,
    // neighboring words aren't joined.
    $text = preg_replace(
        array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',

            // Add line breaks before & after blocks
            '@<((br)|(hr))@iu',
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $text );

    // Remove all remaining tags and comments and return.
    return strip_tags( $text );
}


