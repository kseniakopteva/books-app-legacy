<?php

function OpenCon()
{
    $dbhost = "books-app";
    $dbuser = "root";
    $dbpass = "";
    $db = "books_app";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
