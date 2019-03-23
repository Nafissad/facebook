<?php

require_once("database.php");
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $name = test_input($_POST["name"]);
    $pwd = md5(test_input($_POST["pwd"]));
    $sql = "SELECT id , user_fullname , email , avatar_path FROM facebook_table WHERE user_fullname = '$name' and user_password = '$pwd'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {

        // output data of each row
        $row = $result->fetch_assoc();

        $name = $row["user_fullname"];
        $_SESSION['message'] = "successfully entered !";
        $_SESSION['id'] = $row["id"];
        $_SESSION['name'] = $row["user_fullname"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['avatar'] = $row["avatar_path"];

        header("location: facebook_welcome.php");


    } else {

        $_SESSION['message'] = "account does'nt exist !";

    }


    $database->close_connection();

}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>sign in face book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="background-color">
    <div class="container">
        <div class="wrapper">
            <form action="" method="post" name="Login_Form" class="form-sign-in">
                <h3 class="form-sign-in-heading">Welcome Back! Please Sign In</h3>
                <hr class="colorgraph">
                <br>

                <input type="text" class="form-control" name="name" placeholder="Username" required="" autofocus=""/>
                <input type="password" class="form-control" name="pwd" placeholder="Password" required=""/>

                <button class="btn btn-lg btn-info btn-block" name="Submit" value="Login" type="Submit">Login
                </button>
            </form>

            <div class="center-align">

                <label class="form-signin-content-for-signup" for="sign_up_btn">have'nt signed up yet ?</label>
                <input type="button" class="btn btn-xs btn-primary" name="sign_up_btn"
                       onclick="location.href='facebook_sign_up.php';" value="Sign Up"/>
            </div>
        </div>
    </div>
</div>
</body>
</html>
