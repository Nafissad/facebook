<?php
require_once('user_session.php');
require_once('database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_name = $_SESSION['name'];
    $text = $_POST["text"];

    $sql = "INSERT INTO posts ( user_fullname , text)
            VALUES ( '$user_name' , '$text') ";


    $database->query($sql);
}

$postsQuery = $database->query("
SELECT 
posts.id,
posts.user_fullname,
posts.text
FROM posts
");


while ($row = $postsQuery->fetch_object()) {

    $posts[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="style.css?v=1">
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>


<div class="background-color">

    <nav class="navbar navbar-inverse" id="nav-overrides">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Face Book</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#" id="active-override">Posts</a></li>
                <li><a href="facebook_welcome.php">Home</a></li>
                <li><a href="facebook_sign_out.php">Sign out</a></li>
            </ul>
        </div>
    </nav>


    <div class="textarea-wrapper">
        <form action="facebook_home.php" method="post">
            <textarea name="text" placeholder="write your new post here ..." rows="10" cols="45"
                      style=" resize: none;"></textarea>
            <input type="submit" class="btn-post" value="post!">
        </form>

    </div>


    <div class="container">
        <div class="wrapper">
            <?php foreach ($posts as $post):
            $id = (int)$post->id;
            $result_likes_count = $database->query("
                SELECT COUNT(id) AS total
                FROM posts_likes
                WHERE post_id = '$id'
                ");
            $likes_count = $result_likes_count->fetch_assoc();

            $result_comments = $database->query("
                SELECT text , username 
                FROM comments
                WHERE post_id = '$post->id'
                ");


            ?>

            <div class='posts-style'>
                <div class='posts-username-format'> Posted by: <?php echo $post->user_fullname; ?> </div>
                <hr class="colorgraph">
                <br>
                <div class='posts-font-format'><?php echo $post->text ?>
                </div>

                <a class='btn-like'
                   href="like.php?type=post&id=<?php echo $post->id ?>"><?php echo $likes_count['total']; ?>
                    like </a>
                <form action="comment.php" method="post" name="Login_Form">
                    <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
                    <textarea name="comment_textarea" class="textarea-comment-style"></textarea>
                    <button type="submit" name="submit" class="btn-comment">Comment</button>
                </form>


                <?php while ($comment = $result_comments->fetch_assoc()) { ?>
                    <div class="comment-style">
                        <span> <?php echo $comment['username']?> :</span>
                        <?php echo $comment['text']; ?>
                    </div>

                <?php }?>


                </div>
                    <?php endforeach; ?>
            </div>
        </div>

</body>
</html>
