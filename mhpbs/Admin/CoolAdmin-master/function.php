<?php
session_start();

  if (isset($_POST['closeAppointment'])) {
    closeAppointment($_POST['closeAppointment']);
} else if (isset($_POST['openAppointment'])) {
    openAppointment($_POST['openAppointment']);
} else if (isset($_POST['deleteRoom'])) {
    deleteRoom($_POST['deleteRoom']);
}
?>


<?php

function closeAppointment()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (!$con) {
        echo "Error";
    } else {
        $room_number = $_POST['appToClose'];

        $sql = "UPDATE rooms SET status = 1 WHERE room_number = '$room_number' ";

        if ($con->query($sql) === TRUE) {
            header("refresh:0; url=viewroom.php");
        } else {
            echo "error";
        }
    }
}

function openAppointment()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);


    if (!$con) {
        echo "Error";
    } else {
        $room_number = $_POST['appToOpen'];

        $sql = "UPDATE rooms SET status = 0 WHERE room_number = '$room_number' ";

        if ($con->query($sql) === TRUE) {
            header("refresh:0; url=viewroom.php");
        } else {
            echo "error";
        }
    }
}

function deleteRoom()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "MHPBS";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (!$con) {
        echo "Error";
    } else {
        $room_number = $_POST['RoomToDelete'];
        $sql = "DELETE FROM rooms WHERE room_number='" . $room_number . "'";

        if ($con->query($sql) === TRUE) {
            header("Location: viewroom.php");
        } else {
            echo "error";
        }
    }
}
?>