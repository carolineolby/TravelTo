<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();
    
    $isSubmit = 0; 

    if(isset($_POST['issubmit']) && $_POST['issubmit'] == 1){
        $destinationLength = $_POST['destinationLength']; 
        $isSubmit = 1; 
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] == "ok"){ 

        if(!isset($_SESSION['destinationLength'])){ 
            $_SESSION['destinationLength']="";
        }
        if($isSubmit){
            $_SESSION['destinationLength']=$_POST['destinationLength']; 
        }
    }

    (isset($_POST['destinationLength'])) ? $_SESSION["destinationLength"] = $_POST["destinationLength"] : $_SESSION["destinationLength"] = "default"; 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Booking / Backpacking / Length </title>
</head>
<body class="Backpacking">
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="Backpacking_Section">
            <p class="Booking_Paragraph"> destination #backpacking #length </p>
        </section>
        <p class="Link_Signup_Login"><a href="backpacking.php"> BACK </a></p>
        <p class="Booking_Form-Paragraph"> FOR HOW LONG? </p>
            <form class="Booking_Form" action="backpackingLength.php" method="post">
                <input type="hidden" name="isnew" id="isnew" value="1">
                <select name="destinationLength">
                    <option value="six-month" <?php echo $selected = ($_SESSION['destinationLength'] == "six-month") ? "selected" : ""?>> 6 month </option>
                    <option value="twelve-month" <?php echo $selected = ($_SESSION['destinationLength'] == "twelve-month") ? "selected" : ""?>> 12 month </option>
                </select>
                <button class="Booking_Form-Btn" type="submit" name="submitLengthOfDestination"> #select </button>
            </form>
            <?php if(isset($_POST['destinationLength'])) {
                $destinationLength =  $_SESSION['destinationLength'] ;
                    if($destinationLength == "six-month"){ ?>
                        <form class="ToNextPage_Form" action="submitBooking.php" method="post">
                            <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                        </form>
                        <?php echo "<p class='Choice'>You have choosed 6 month</p>"; 
                        } 
                        elseif($destinationLength == "twelve-month"){ ?>    
                            <form class="ToNextPage_Form" action="submitBooking.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>
                        <?php echo "<p class='Choice'>You have choosed 12 month</p>"; 
                        }
                    else {
                        echo "<p> choose please. </p>"; 
                    }
                } ?>

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