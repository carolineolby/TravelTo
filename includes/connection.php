<?php 
    function dbConnect(){
        $connection = mysqli_connect("db", "root", "password", "TravelTo")
            or die("Could not connect");

        mysqli_select_db($connection,"TravelTo") or die("Could not select database");
        return $connection;
    }

    function dbDisconnect($connection){
        mysqli_close($connection);
    }
?>