<!-- 
function OpenCon()
{
    $dbhost = "books-app";
    $dbuser = "root";
    $dbpass = "";
    $db = "books_app";
    // define('DB_SERVER', 'books-app');
    // define('DB_USERNAME', 'root');
    // define('DB_PASSWORD', '');
    // define('DB_NAME', 'books_app');

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
} -->


<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'books-app');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'books_app');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Connect failed: %s\n" . $mysqli->error);

// Check connection
if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>