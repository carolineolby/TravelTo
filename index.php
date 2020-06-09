<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TravelTo - LogIn </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="Index">
    <div class="Box"></div>
    <p class="Link_Signup_Login"><a href="signup.php"> SIGNUP </a></p>
    <h1 class="Index_Headline"> TravelTo </h1>
    <p class="Link_Getinspo"><a href="getinspo.php"> GET INSPO </a></p>
    <p class="Index_Paragraph"> LogIn </p>
    <form class="Form_Index" action="checklogin.php" method="post">
        <p><input type="text" name="txtUsername" placeholder="username"></p>
        <p><input type="password" name="txtPassword" placeholder="password"></p>
        <div class="Form_btn-Container">
            <button class="Index_Btn" type="submit" value="login"> #login </button>
        </div>
    </form>
</body>
</html>