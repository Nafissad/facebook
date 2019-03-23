<?php
require_once("user_session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1.css?v=1">
</head>

<body>


<!--
<h1> welcome to my facebook !</h1>

<div>

    <div class="alert alert-success">   <?= $_SESSION['message'] ?> </div>
    <span> <img src='<?= $_SESSION['avatar'] ?>' class="img_profile" width="300" height="300" style="display:block"> </span>
    welcome <span> <?= $_SESSION['name'] ?>! </span><br>
    your email is: <span> <?= $_SESSION['email'] ?> </span>

</div>


<form action="facebook_home_page.php">
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-12">
            <button type="submit" class="btn btn-xs" >home page </button>
        </div>
    </div>
</form>





-->

<div class="frame flex">
    <div class="center">

        <div class="profile">
            <div class="image">
                <div class="circle-1"></div>
                <div class="circle-2"></div>
                <img src='<?= $_SESSION['avatar'] ?>' alt="Jessica Potter" width="70" height="70">
            </div>

            <div class="name"><?= $_SESSION['name'] ?></div>
            <div class="job">Web developer</div>
            <input >



            <div class="actions">
                <button class="btn hvr-underline-from-center" onclick="location.href='facebook_home.php';">Posts</button>
            </div>
        </div>

        <div class="stats">
            <div class="box box1 hvr-underline-from-right">
                <span class="value">523</span>
                <span class="parameter">Posts</span>
            </div>
            <div class="box box2 hvr-underline-from-right">
                <span class="value">1387</span>
                <span class="parameter">Likes</span>
            </div>
            <div class="box box3 hvr-underline-from-right">
                <span class="value">146</span>
                <span class="parameter">Followers</span>
            </div>
        </div>
    </div>
</div>




</body>
</html>