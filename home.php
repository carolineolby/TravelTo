<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Home </title>
</head>
<body class="Home">
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <nav>
            <a class="NavLink_Home-Destination" href="booking.php"> BOOKING </a>
            <a class="NavLink_Home-YourJourney" href="yourjourney.php"> YOUR JOURNEY </a>
            <a class="NavLink_Home-GetInspo" href="getinspo.php"> GET INSPO </a>
        </nav>
        <h1 class="Home_Headline"> explore. <h1>
        <p class="Link_Signup_Login"><a href="logout.php"> LOGOUT </a></p>
    <?php } else{
        echo "<br>";
        echo "<br>";
        echo "<p class='Echo'> DU MÅSTE LOGGA IN </p>";
        echo "<p class='Echo'><a class='Echo' href='index.php'>HÄR</a></p>";
    }
    ?>
</body>
</html>