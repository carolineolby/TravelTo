<?php
    session_start();
    
    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
        $isDeleteid = $_GET['deleteid'];
    }

    if(isset($_POST['isdeleteid']) && $_POST['isdeleteid'] > 0){
        deletePost($connection, $_POST['isdeleteid']); 

        header("Location: yourjourney.php");
    }
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BLOG - Delete Post </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="YourJourney">
<p class="Link_Signup_Login"><a href="yourjourney.php"> BACK </a></p>
<h1 class="DeletePost_Headline"> delete post </h1>
<?php if($_SESSION['status'] == "ok"){ ?>
    <p class="Delete_Post-paragraph" <?php echo $row['postsTitle']; ?>></p>
    <form action="deletePost.php" method="post">
        <input type="hidden" name="isdeleteid" value="<?php echo $isDeleteid; ?>">
        <div class="Form_btn-Container">
                <button class="DeletePost_Btn" type="submit" value="delete"> #here </button>
        </div>
    </form>
    <?php } else{
        echo "<br>";
        echo "<br>";
        echo "<p class='Echo'> DU MÅSTE LOGGA IN </p>";
        echo "<p class='Echo'><a class='Echo' href='index.php'>HÄR</a></p>";
    }
    ?>
<?php
    dbDisconnect($connection);
?>
</body>
</html>