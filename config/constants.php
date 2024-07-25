<?php 

    ob_start();
    // Start Session
    session_start();

    // Creat Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/colagencomi/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'colagencomi');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting database

?>