<?php
    session_start();
    
    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();


    if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
        $isDeleteid = $_GET['deleteid'];
    }

    if(isset($_POST['isdeleteid']) && $_POST['isdeleteid'] > 0){
        deleteBooking($connection, $_POST['isdeleteid']); 

        header("Location: submitBooking.php");
    }
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TravelTo - Delete Booking </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="Booking">
<p class="Link_Signup_Login"><a href="submitBooking.php"> BACK </a></p>
<h1 class="DeleteBooking_Headline"> delete booking </h1>
<?php if($_SESSION['status'] == "ok"){ ?>
    <p class="Delete_Post-paragraph" <?php echo $row['bookingDestination']; ?>></p>
    <form action="deleteBooking.php" method="post">
        <input type="hidden" name="isdeleteid" value="<?php echo $isDeleteid; ?>">
        <div class="Form_btn-Container">
            <button class="DeleteBooking_Btn" type="submit" value="delete"> #here </button>
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