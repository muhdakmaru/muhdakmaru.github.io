<?php
session_start();

  if (isset($_POST['acceptBooking'])) {
    acceptBooking($_POST['acceptBooking']);
} else if (isset($_POST['rejectBooking'])) {
    rejectBooking($_POST['rejectBooking']);
} else if (isset($_POST['finishBooking'])) {
    finishBooking($_POST['finishBooking']);
} else if (isset($_POST['deleteBooking'])) {
    deleteBooking($_POST['deleteBooking']);
}
?>


<?php

function acceptBooking()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (!$con) {
        echo "Error";
    } else {
        $bookingID = $_POST['appToAccept'];

        $sql = "UPDATE bookings SET status = 1 WHERE bookingID = '$bookingID' ";

        if ($con->query($sql) === TRUE) {
            header("refresh:0; url=viewbooking.php");
        } else {
            echo "error";
        }
    }
}

function rejectBooking()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);


    if (!$con) {
        echo "Error";
    } else {
        $bookingID = $_POST['appToReject'];

        $sql = "UPDATE bookings SET status = 2 WHERE bookingID = '$bookingID' ";

        if ($con->query($sql) === TRUE) {
            header("refresh:0; url=viewbooking.php");
        } else {
            echo "error";
        }
    }
}

function finishBooking()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);


    if (!$con) {
        echo "Error";
    } else {
        $bookingID = $_POST['appToFinish'];

        $sql = "UPDATE bookings SET status = 3 WHERE bookingID = '$bookingID' ";

        if ($con->query($sql) === TRUE) {
            header("refresh:0; url=viewbooking.php");
        } else {
            echo "error";
        }
    }
}

function deleteBooking()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (!$con) {
        echo "Error";
    } else {
        $bookingID = $_POST['appToDelete'];
        $sql = "DELETE FROM bookings WHERE bookingID='" . $bookingID . "'";

        if ($con->query($sql) === TRUE) {
            header("Location: viewbooking.php");
        } else {
            echo "error";
        }
    }
}
?>