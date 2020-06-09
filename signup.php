<?php
    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
        $username = mysqli_real_escape_string($connection,$_POST['txtUsername']);
        $password = mysqli_real_escape_string($connection,$_POST['txtPassword']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "INSERT INTO users
                (usersname,userspassword)
                VALUES('$username','$passwordHash')";
    
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        $insId = mysqli_insert_id($connection);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TravelTo - SignUp </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="SignUp">
    <p class="Link_Signup_Login"><a href="index.php"> LOGIN </a></p>
    <h1 class="SignUp_Headline"> TravelTo </h1>
    <p class="Link_Getinspo"><a href="getinspo.php"> GET INSPO </a></p>
    <p class="SignUp_Paragraph"> SignUp </p>
    <form class="Form_SignUp" method="post">
        <input type="hidden" name="isnew" id="isnew" value="1">
        <p><input type="text" name="txtUsername" placeholder="username"></p>
        <p><input type="password" name="txtPassword" placeholder="password"></p>
        <div class="Form_btn-Container">
            <button class="Signup_Btn" type="submit" value="signup"> #signup </button>
        </div>
    </form>
</body>
</html>