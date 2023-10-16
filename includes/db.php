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

// check $connection
if ($connection) {

    echo "";
    // echo "connected..";

}

?>