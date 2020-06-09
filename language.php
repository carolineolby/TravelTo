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
    <title> TravelTo - Booking / Language </title>
</head>
<body class="Language">
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="Backpacking_Section">
            <p class="Booking_Paragraph"> destination #language </p>
        </section>
        <p class="Link_Signup_Login"><a href="booking.php"> BACK </a></p>
        <p class="Booking_Form-Paragraph"> CHOOSE DESTINATION? </p>
            <form class="Booking_Form" action="language.php" method="post">
                <input type="hidden" name="isnew" id="isnew" value="1">
                <select name="destination">
                    <option value="barcelona" <?php echo $selected = ($_SESSION['destination'] == "barcelona") ? "selected" : ""?>> Barcelona </option>
                    <option value="london" <?php echo $selected = ($_SESSION['destination'] == "london") ? "selected" : ""?>> London </option>
                    <option value="paris" <?php echo $selected = ($_SESSION['destination'] == "paris") ? "selected" : ""?>> Paris </option>
                </select>
                <button class="Booking_Form-Btn" type="submit" name="submittypeOfDestination"> #select </button>
            </form>
            <?php if(isset($_POST['destination'])) {
                $destination =  $_SESSION['destination'] ;
                    if($destination == "barcelona"){ ?>
                        <form class="ToNextPage_Form" action="languageLength.php" method="post">
                            <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                        </form>
                        <?php echo "<p class='Choice'>You have choosed Barcelona</p>";
                        } 
                        elseif($destination == "london"){ ?>    
                            <form class="ToNextPage_Form" action="languageLength.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>
                        <?php echo "<p class='Choice'>You have choosed London</p>";
                        }
                        elseif($destination == "paris"){ ?>
                            <form class="ToNextPage_Form" action="languageLength.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>
                        <?php echo "<p class='Choice'>You have choosed Paris</p>";   
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