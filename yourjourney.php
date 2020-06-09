<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    // CREATE POST
    if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
        $createPost = createPost($connection);

        header("Location: yourjourney.php");
    }

    // READ POST
    $readAllPost = readAllPost($connection); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Your Journey </title>
</head>
<body class="YourJourney">
    <p class="Link_Signup_Login"><a href="home.php"> HOME </a></p>
    <h1 class="YourJourney_Headline"> your journey. </h1>
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="YourJourney_Section">
            <p class="YourJourney_Paragraph"> share it </p>
        </section>
        <form class="Form_Index" action="yourjourney.php" method="post">
            <input type="hidden" name="isnew" id="isnew" value="1">
            <p><input class="YourJourney_Form-inputTitle" type="text" name="title" placeholder="Title"></p>
            <p><input class="YourJourney_Form-inputContent" type="text" name="content"></p>
            <div class="Form_btn-Container">
                <button class="YourJourney_Btn" type="submit" value="login"> #publish </button>
            </div>
        </form>
        <section class="YourJourney_Section-ReadPosts">
            <p class="YourJourney_Paragraph"> All posts </p>
            <div class="YourJourney_Post">
                <?php 
                    while($row = mysqli_fetch_array($readAllPost)){
                ?>
                <div class="YourJourney_Post_Container">
                    <h1 class="YourJourney_Post-Headline"><?php echo $row['postsTitle'];?></h1>
                    <div class="YourJourney_Post_Link-Container">
                        <a class="YourJourney_Post-LinkUD" href="updatePost.php?editid=<?php echo $row['postsId'];?>"> #Update </a> 
                        <a class="YourJourney_Post-LinkUD" href="deletePost.php?deleteid=<?php echo $row['postsId'];?>"> #Delete </a>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </section>
    <?php } else{
        echo "<br>";
        echo "<br>";
        echo "<p> DU MÅSTE LOGGA IN </p>";
        echo '<p><a href="index.php">HÄR</a></p>';
    }
    ?>

<?php
    dbDisconnect($connection);
?>
</body>
</html>