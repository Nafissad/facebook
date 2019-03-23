<?php

require_once"database.php";
require_once "user_session.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $text = $_POST["comment_textarea"];
    $post_id = (int)$_POST["post_id"];
    $username = $_SESSION['name'];
    $database->query("
    INSERT comments(text,post_id,username)
    VALUE ('$text','$post_id','$username')
    
    ");

}

header("location:facebook_home.php");