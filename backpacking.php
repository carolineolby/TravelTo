<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();
    
    $isSubmit = 0; 

    if(isset($_POST['issubmit']) && $_POST['issubmit'] == 1){
        $destination = $_POST['destination']; 
        $isSubmit = 1; 
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] == "ok"){ 

        if(!isset($_SESSION['destination'])){ 
            $_SESSION['destination']="";
        }
        if($isSubmit){
            $_SESSION['destination']=$_POST['destination']; 
        }
    }

    (isset($_POST['destination'])) ? $_SESSION["destination"] = $_POST["destination"] : $_SESSION["destination"] = "default"; 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Booking / Backpacking </title>
</head>
<body class="Backpacking">
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="Backpacking_Section">
            <p class="Booking_Paragraph"> destination #backpacking </p>
        </section>
        <p class="Link_Signup_Login"><a href="booking.php"> BACK </a></p>
        <p class="Booking_Form-Paragraph"> CHOOSE DESTINATION? </p>
            <form class="Booking_Form" action="backpacking.php" method="post">
                <input type="hidden" name="isnew" id="isnew" value="1">
                <select name="destination">
                    <option value="australia" <?php echo $selected = ($_SESSION['destination'] == "australia") ? "selected" : ""?>> Australia </option>
                    <option value="canada" <?php echo $selected = ($_SESSION['destination'] == "canada") ? "selected" : ""?>> Canada </option>
                    <option value="newzealand" <?php echo $selected = ($_SESSION['destination'] == "newzealand") ? "selected" : ""?>> New Zealand </option>
                </select>
                <button class="Booking_Form-Btn" type="submit" name="submittypeOfDestination"> #select </button>
            </form>
            <?php if(isset($_POST['destination'])) {
                $destination =  $_SESSION['destination'];
                    if($destination == "australia"){ ?>
                        <form class="ToNextPage_Form" action="backpackingLength.php" method="post">
                            <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                        </form>
                        <?php echo "<p class='Choice'>You have choosed Australia</p>"; 
                            } 
                        elseif($destination == "canada"){ ?>    
                            <form class="ToNextPage_Form" action="backpackingLength.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>
                            <?php echo "<p class='Choice'>You have choosed Canada</p>"; 
                            }
                        elseif($destination == "newzealand"){ ?>
                            <form class="ToNextPage_Form" action="backpackingLength.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>   
                        <?php echo "<p class='Choice'>You have choosed New Zealand</p>"; 
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