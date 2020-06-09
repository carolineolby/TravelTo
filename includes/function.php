<?php
    function createUser($connection) {
        $username = escapeInsert($connection,$_POST['txtUsername']);
        $password = escapeInsert($connection,$_POST['txtPassword']);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "INSERT INTO users
                (usersname,userspassword)
                VALUES('$username','$passwordHash')";
    
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        $insId = mysqli_insert_id($connection);
    
        return $insId;
    }



    //BOOKING
    function createBooking($connection) {
        $typeOfDestination = mysqli_real_escape_string($connection,$_POST['typeOfDestination']);
        $destination = mysqli_real_escape_string($connection,$_POST['destination']);
        $destinationLength = mysqli_real_escape_string($connection,$_POST['destinationLength']);
       
        $typeOfDestination = $_SESSION['typeOfDestination'];
        $destination = $_SESSION['destination'];
        $destinationLength = $_SESSION['destinationLength'];
        
        $query = "INSERT INTO booking
                        (bookingType,bookingDestination, bookingLength)
                        VALUES('$typeOfDestination','$destination', '$destinationLength')";
    
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        $insId = mysqli_insert_id($connection);

        $bookingUserId = $_SESSION['usersId'];  
        $query = "INSERT INTO usersBooking
                        (usersBookingUId,usersBookingBId)
                        VALUES($bookingUserId,$insId)";
                        
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        return $insId;
    }

    function readAllBookings($connection) {
        $query = "SELECT users.usersname as usersname, booking.bookingType, booking.bookingDestination, booking.bookingLength, booking.bookingId as bookingId
            FROM booking
            INNER JOIN usersBooking
            ON usersBooking.usersBookingBId = booking.bookingId
            INNER JOIN users
            ON usersBooking.usersBookingUId = users.usersId
            WHERE users.usersId = ". $_SESSION['usersId'];

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
        return $result; 
    }

    function getBooking($connection, $bookingId) {
        $query = "SELECT * FROM booking
            WHERE bookingId=".$bookingId;

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
        $row = mysqli_fetch_array($result); 

        return $row;
    }

    function deleteBooking($connection, $bookingId) {
        $query = "DELETE FROM usersBooking WHERE usersBookingBId=". $bookingId;
        $result = mysqli_query($connection,$query) or die("Query failed: $query");

        $query = "DELETE FROM booking WHERE bookingId=". $bookingId;
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    }
    
    function updateBooking($connection) {
        $typeOfDestination = mysqli_real_escape_string($connection,$_POST['typeOfDestination']);
        $destination = mysqli_real_escape_string($connection,$_POST['destination']);
        $destinationLength = mysqli_real_escape_string($connection,$_POST['destinationLength']);
        $editid = $_POST['updateid'];


        echo " typeOfDestination = ".$typeOfDestination;
        echo " destination = ".$destination;
        echo " destinationLength = ".$destinationLength;
        echo " editid = ".$editid;
        
        $query = "UPDATE booking
        SET bookingType='$typeOfDestination', bookingDestination='$destination', bookingLength='$destinationLength'
        WHERE bookingId=". $editid;


        $result = mysqli_query($connection,$query) or die("Query failed: $query");

    }

    function submitBooking($typeOfDestination, $destination, $destinationLength){
        $typeOfDestination = $_SESSION['typeOfDestination'];
        $destination = $_SESSION['destination'];
        $destinationLength = $_SESSION['destinationLength'];

        return "<p class='Resume' >Type of destination:  $typeOfDestination  </p> "  .  "<p class='Resume'>Destination: $destination </p> " .  " <p class='Resume'>Length of destination: $destinationLength </p> "; 
    }



    //POSTS
    function createPost($connection) {
        $title = mysqli_real_escape_string($connection,$_POST['title']);
        $content = mysqli_real_escape_string($connection,$_POST['content']);

        $query = "INSERT INTO posts
                (postsTitle,postsContent)
                VALUES('$title','$content')";

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
        $insId = mysqli_insert_id($connection);

        $postsUserId = $_SESSION['usersId'];  
        $query = "INSERT INTO usersPost
                        (usersPostUId,usersPostPId)
                        VALUES($postsUserId,$insId)";
                        
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        return $insId;
    }

    function readAllPost($connection) {
        $query = "SELECT users.usersname as usersname, posts.postsTitle, posts.postsContent, posts.postsId as postsId
        FROM posts
        INNER JOIN usersPost
        ON usersPost.usersPostPId = posts.postsId
        INNER JOIN users
        ON usersPost.usersPostUId = users.usersId
        WHERE users.usersId = ". $_SESSION['usersId'];

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
        return $result; 
    }

    function getPost($connection, $postId) {
        $query = "SELECT * FROM posts
            WHERE postsId=".$postId;

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
        $row = mysqli_fetch_array($result); 

        return $row;
    }

    function deletePost($connection, $postId) {
        $query = "DELETE FROM usersPost WHERE usersPostPId=". $postId;
        $result = mysqli_query($connection,$query) or die("Query failed: $query");

        $query = "DELETE FROM posts WHERE postsId=". $_POST['isdeleteid'];
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    }

    function updatePost($connection) {
        $title = mysqli_real_escape_string($connection,$_POST['title']);
        $content = mysqli_real_escape_string($connection,$_POST['content']);
        $editid = $_POST['updateid'];

        $query = "UPDATE posts
                SET postsTitle='$title', postsContent='$content'
                WHERE postsId=". $editid;

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    }

?>
