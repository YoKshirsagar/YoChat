<?php
    include "db_connect.php";
    $msg = $_POST["text"];
    $user = $_POST["user"];
    $ip = $_POST["ip"];

    $query = "INSERT INTO `chat` (`srno`, `msg`, `user`, `ctime`, `ip`) VALUES (NULL, '$msg', '$user', current_timestamp(), '$ip');";
    mysqli_query($conn,$query);
    mysqli_close($conn);
?>