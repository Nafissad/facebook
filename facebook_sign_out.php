<?php
session_start();
session_destroy();
session_unset();
unset($_SESSION['username']);
header("location:facebook_sign_in.php");
?>