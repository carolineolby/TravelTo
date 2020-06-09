<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    // EDIT BOOKING
    if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
        $getBooking = getBooking($connection,$_GET['editid']);
    }

    if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
        updateBooking($connection);
        header("Location: submitBooking.php?editid=".$_POST['updateid']);
    }

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
    <title> TravelTo - Update Booking </title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="Booking">
<p class="Link_Signup_Login"><a href="submitBooking.php"> BACK </a></p>
<h1 class="UpdateBooking_Headline"> update booking </h1>
    <?php if($_SESSION['status'] == "ok"){ ?>
        <?php echo submitBooking($typeOfDestination, $destination, $destinationLength); ?>
        <form class="Booking_Form" action="updateBooking.php" method="post">
            <input type="hidden" name="updateid" value="<?php echo $getBooking['bookingId']; ?>">
            <select name="typeOfDestination">
                <option value="<?php echo $getBooking['bookingType']; ?>" <?php echo $selected = ($_SESSION['typeOfDestination'] == "bookingType") ? "selected" : ""?>> Backpacking </option>
                <option value="<?php echo $getBooking['bookingType']; ?>" <?php echo $selected = ($_SESSION['typeOfDestination'] == "language") ? "selected" : ""?>> Language </option>
                <option value="<?php echo $getBooking['bookingType']; ?>" <?php echo $selected = ($_SESSION['typeOfDestination'] == "volunteer") ? "selected" : ""?>> Volunteer </option>
            </select>

            <select name="destination">
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "australia") ? "selected" : ""?>> Australia </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "canada") ? "selected" : ""?>> Canada </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "newzealand") ? "selected" : ""?>> New Zealand </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "barcelona") ? "selected" : ""?>> Barcelona </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "london") ? "selected" : ""?>> London </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "paris") ? "selected" : ""?>> Paris </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "costarica") ? "selected" : ""?>> Costa Rica </option>
                <option value="<?php echo $getBooking['bookingDestination']; ?>" <?php echo $selected = ($_SESSION['destination'] == "southafrica") ? "selected" : ""?>> South Africa </option>
            </select>
            
            <select name="destinationLength">
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "six-month") ? "selected" : ""?>> 6 month </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "twelve-month") ? "selected" : ""?>> 12 month </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "four-weeks") ? "selected" : ""?>> 4 weeks </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "eight-weeks") ? "selected" : ""?>> 8 weeks </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "ten-weeks") ? "selected" : ""?>> 10 weeks </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "two-month") ? "selected" : ""?>> 2 month </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "four-month") ? "selected" : ""?>> 4 month </option>
                <option value="<?php echo $getBooking['bookingLength']; ?>" <?php echo $selected = ($_SESSION['destinationLength'] == "eight-month") ? "selected" : ""?>> 8 month </option>
            </select>

            <div class="Form_btn-Container">
                <button class="UpdateBooking_Btn" type="submit" value="update"> #update </button>
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