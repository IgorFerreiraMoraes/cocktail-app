<?php
    include 'database.php';

    $payload = file_get_contents('php://input');

    $connection = open_connection();
    $sql_query = "INSERT INTO `orders` (`drink`) VALUES ('$payload')";
    if ($connection->query($sql_query) == TRUE) {

    }
    close_connection($connection);
?>