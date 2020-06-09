<?php
    session_start();

    require("includes/connection.php");
    require("includes/function.php");

    $connection = dbConnect();

    $isSubmit = 0; 

    if(isset($_POST['issubmit']) && $_POST['issubmit'] == 1){
        $destination = $_POST['typeOfDestination']; 
        $isSubmit = 1; 
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] == "ok"){ 

        if(!isset($_SESSION['typeOfDestination'])){ 
            $_SESSION['typeOfDestination']="";
        }
        if($isSubmit){
            $_SESSION['typeOfDestination']=$_POST['typeOfDestination']; 
        }
    }

    (isset($_POST['typeOfDestination'])) ? $_SESSION["typeOfDestination"] = $_POST["typeOfDestination"] : $_SESSION["typeOfDestination"] = "default"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> TravelTo - Booking </title>
</head>
<body class="Booking">
    <p class="Link_Signup_Login"><a href="home.php"> HOME </a></p>
    <h1 class="Booking_Headline"> booking. </h1>
    <p class="Link_Signup_Login"><a href="submitbooking.php"> YOUR BOOKING </a></p>
    <?php
    if($_SESSION['status'] == "ok"){ ?>
        <section class="Booking_Section">
            <p class="Booking_Paragraph"> destination type </p>
        </section>
        <section class="Booking_Section-Form">
        <p class="Booking_Form-Paragraph"> CHOOSE DESTINATION TYPE? </p>
            <form class="Booking_Form" action="booking.php" method="post">
                <input type="hidden" name="usersId" id="usersId" value="<?php echo $row['usersId'];?>">
                <select name="typeOfDestination">
                    <option value="backpacking" <?php echo $selected = ($_SESSION['typeOfDestination'] == "backpacking") ? "selected" : ""?>> Backpacking </option>
                    <option value="language" <?php echo $selected = ($_SESSION['typeOfDestination'] == "language") ? "selected" : ""?>> Language </option>
                    <option value="volunteer" <?php echo $selected = ($_SESSION['typeOfDestination'] == "volunteer") ? "selected" : ""?>> Volunteer </option>
                </select>
                <button class="Booking_Form-Btn" type="submit" name="submittypeOfDestination"> #select </button>
            </form>
            <?php if(isset($_POST['typeOfDestination'])) {
                $typeOfDestination =  $_SESSION['typeOfDestination'];
                    if($typeOfDestination == "backpacking"){ ?>
                        <form class="ToNextPage_Form" action="backpacking.php" method="post">
                            <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                        </form>
                        <?php echo "<p class='Choice'>You have choosed backpacking</p>"; 
                            } 
                        elseif($typeOfDestination == "language"){ ?>    
                            <form class="ToNextPage_Form" action="language.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>
                            <?php echo "<p class='Choice'>You have choosed language</p>"; 
                            }
                        elseif($typeOfDestination == "volunteer"){ ?>
                            <form class="ToNextPage_Form" action="volunteer.php" method="post">
                                <button class="ToNextPage_Form-Button" type="submit"> #next step </button>
                            </form>   
                        <?php echo "<p class='Choice'>You have choosed volunteer</p>"; 
                            }
                    else {
                        echo "<p> choose please. </p>"; 
                    }
                } ?>
        </section>
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