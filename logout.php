<?php
    session_start();

    unset($_SESSION['status']);
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - LogOut </title>
</head>
<body class="Home">
    <h1 class="LogOut_Headline"> TravelTo </h1>
    <p class="Link_Signup_Login"><a href="index.php"> LOGIN </a></p>
</body>
</html>