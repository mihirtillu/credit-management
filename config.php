<?php
    $conn=mysqli_connect("localhost","root","","credit");
    if (!$conn) {
        echo("Connection failed".mysqli_connect_error());
    }
    return $conn;