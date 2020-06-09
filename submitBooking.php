<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    // CREATE BOOKING
    if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
        $createBooking = createBooking($connection);

        header("Location: submitBooking.php");
    }

    // READ BOOKING
    $readAllBookings = readAllBookings($connection); 

    $isSubmit = 0; 
    if(isset($_POST['issubmit']) && $_POST['issubmit'] == 1){
        $typeOfDestination = $_POST['typeOfDestination']; 
        $destination = $_POST['destination']; 
        $destinationLength = $_POST['destinationLength']; 
        $isSubmit = 1; 
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] == "ok"){         
        if(!isset($_SESSION['typeOfDestination']) && $_SESSION['destination'] && $_SESSION['destinationLength']) { 
            $_SESSION['typeOfDestination']="";
            $_SESSION['destination']="";
            $_SESSION['destinationLength']="";
        }
        if($isSubmit){
            $_SESSION['typeOfDestination']=$_POST['typeOfDestination']; 
            $_SESSION['destination']=$_POST['destination']; 
            $_SESSION['destinationLength']=$_POST['destinationLength']; 
        }
    }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Submit Booking </title>
</head>
<body class="Booking">
    <p class="Link_Signup_Login"><a href="home.php"> HOME </a></p>
    <h1 class="SubmitBooking_Headline"> booking. </h1>
    <p class="Link_Signup_Login"><a href="booking.php"> BOOK HERE </a></p>
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="Booking_Section">
            <p class="Booking_Paragraph"> submit your booking </p>
        </section>
            <form class="Booking_Form" action="submitBooking.php" method="post">
            <input type="hidden" name="isnew" id="isnew" value="1">
                <div class="Form_btn-Container">
                    <button class="SubmitBooking_Btn" type="submit" name="submitBooking" value="submitBooking"> #BOOK NOW </button>
                </div>
            </form>
        <section class="YourJourney_Section-ReadPosts">
            <p class="SubmitBooking_Paragraph"> All bookings </p>
            <div class="YourJourney_Post">
                <?php 
                    while($row = mysqli_fetch_array($readAllBookings)){
                ?>
                <div class="YourJourney_Post_Container">
                    <h1 class="YourJourney_Post-Headline"><?php echo $row['bookingDestination'];?></h1>
                    <div class="YourJourney_Post_Link-Container">
                        <a class="SubmitBooking_Post-LinkUD" href="updateBooking.php?editid=<?php echo $row['bookingId'];?>"> #Update </a> 
                        <a class="SubmitBooking_Post-LinkUD" href="deleteBooking.php?deleteid=<?php echo $row['bookingId'];?>"> #Delete </a>
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