<?php
    session_start();
    header("Location: home.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CkeckLogin </title>
</head>
<body>
    <?php
        require("includes/connection.php");
        require("includes/function.php");
    
        $connection = dbConnect();

        $checkUsername = mysqli_real_escape_string($connection,$_POST['txtUsername']);
        $checkPassword = mysqli_real_escape_string($connection,$_POST['txtPassword']);

        $query = "SELECT * FROM users
        WHERE usersname = '$checkUsername'";

        $result = mysqli_query($connection,$query) or die("Query failed: $query");

        $row = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);

        if($count == 1) {
            if (password_verify($checkPassword, $row["userspassword"])) {
                $_SESSION['status'] = "ok";
                $_SESSION['usersId'] = $row["usersId"];
                exit;
            } else {
                echo "<p class='Echo'>Du har inte fyllt i rätt användare och lösenord</p>";
                header("Location: index.php");
            }
        }
    ?>
</body>
</html>