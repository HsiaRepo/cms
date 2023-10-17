<!-- Database -->
<?php

/** Fast Local DB Connection
 *
 * $connection = mysqli_connect('127.0.0.1', 'root','', 'cms');
 *
 * if ($connection) {
 *
 *    echo "Connected!";
 *
 * }
 *
 */

// TODO live server
$db['db_host'] = '127.0.0.1';
$db['db_user'] = 'root';
$db['db_pw'] = '';
$db['db_name'] = 'cms';

// defines constants from key-values converted to uppercase
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);

// Check $connection
if (mysqli_connect_errno()) {
    // Log the error or handle it in a way that doesn't expose details to the public
    die("Database connection failed: " . mysqli_connect_error());
}

?>