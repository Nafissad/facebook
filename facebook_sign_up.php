<?php

require_once("database.php");

session_start();
$_SESSION['message'] = $_SESSION['name'] = $_SESSION['avatar'] = $_SESSION['email'] = "";
$name = $email = $pwd = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['pwd'] == $_POST['confirmpwd']) {

        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $pwd = md5(test_input($_POST["pwd"]));

        $avatar_path = $database->build_avatar_path('image/' . $_FILES['avatar']['name']);


        if (preg_match("!image!", $_FILES['avatar']['type'])) {

            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {

                $_SESSION['name'] = $name;
                $_SESSION['avatar'] = $avatar_path;
                $_SESSION['email'] = $email;
                $sql = "INSERT INTO facebook_table ( user_fullname , email , user_password,avatar_path)
            VALUES ( '$name','$email','$pwd','$avatar_path')";

                //if the query is successful redirect to facebook_welcome.php

                if ($database->query($sql) === TRUE) {
                    $_SESSION['message'] = "registration successful! added $name to the data base";
                    header("location: facebook_welcome.php");
                }
            }
        }}

    $sql = "SELECT id FROM facebook_table WHERE user_fullname = '$name' and user_password = '$pwd'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {

        // output data of each row
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row["id"];
    }


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
    <title>sign up facebook</title>
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
        </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data" name="Login_Form" class="form-sign-in" autocomplete="off">
        <h3 class="form-sign-in-heading">please Sign Up </h3>
        <hr class="colorgraph">
        <br>

        <input type="text" class="form-control" name="name" placeholder="name" required="" autofocus=""/>
        <input type="email" class="form-control" name="email" placeholder="email" required="" autofocus=""/>
        <input type="password" class="form-control" name="pwd" placeholder="password" required="" autofocus=""/>
        <input type="password" class="form-control" name="confirmpwd" placeholder="confirm password" required="" autofocus=""/>
        <div><label>select your avatar:</label> <input type="file"  name="avatar" accept="image/*"></div>
        <button class="btn btn-lg btn-info btn-block" name="Submit" value="Login" type="Submit">Sign Up</button>
    </form>
    <div class="center-align">

        <label class="form-signin-content-for-signup" for="sign_in_btn">signed up already??</label>
        <input type="button" class="btn btn-xs btn-primary" name="sign_in_btn"
               onclick="location.href='facebook_sign_in.php';" value="Sign In"/>
    </div>

</div>


</body>
</html>