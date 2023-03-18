<?php
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
    die();
    }

    header('Access-Control-Allow-Origin:  *');
    header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');

    header('Content-Type: application/json');

    function open_connection() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "cocktail";

        $connection = new mysqli($host, $user, $password, $database) or die ("Failed");

        return $connection;
    }
    function close_connection($connection) {
        $connection -> close();
    }
?>