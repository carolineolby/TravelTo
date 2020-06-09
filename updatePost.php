<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    // EDIT POST
    if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
        $getPost = getPost($connection,$_GET['editid']);
    }

    if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
        updatePost($connection);
        header("Location: yourjourney.php?editid=".$_POST['updateid']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Update Post </title>
</head>
<body class="YourJourney">
    <p class="Link_Signup_Login"><a href="yourjourney.php"> BACK </a></p>
    <h1 class="UpdatePost_Headline"> update post </h1>
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <h1 class="UpdatePost_Headline-Form"> <?php echo $getPost['postsTitle']; ?> </h1>
        <form class="Form_Index" action="updatePost.php" method="post">
            <input type="hidden" name="updateid" value="<?php echo $getPost['postsId']; ?>">
            <p><input class="YourJourney_Form-inputTitle" type="text" name="title" placeholder="Title" value="<?php echo $getPost['postsTitle']; ?>"></p>
            <p><input class="YourJourney_Form-inputContent" type="text" name="content" value="<?php echo $getPost['postsContent']; ?>"></p>
            <div class="Form_btn-Container">
                <button class="YourJourney_Btn" type="submit" value="login"> #update </button>
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