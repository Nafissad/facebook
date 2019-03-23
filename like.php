<?php
require_once('config.php');
require_once('database.php');
require_once('user_session.php');


if (isset($_GET['type'], $_GET['id'])) {

    $type = $_GET['type'];
    $post_id = (int)$_GET['id'];
    $user_fullname = $_SESSION['name'];

    switch ($type) {

        case'post':
            $check_like = $database->query("
            SELECT id 
            FROM posts_likes
            WHERE user_fullname = '$user_fullname' AND post_id = '$post_id'
            ");

            if($check_like->num_rows < 1){

                $database->query("
                INSERT INTO posts_likes (user_fullname , post_id)
                VALUES('$user_fullname' , '$post_id')
                ");
            }

            break;
    }

    $database->close_connection();

    header('location: facebook_home.php');
}