<?php

/* Fast Local DB Connection

$connection = mysqli_connect('127.0.0.1', 'root','', 'cms');

if ($connection) {

    echo "Connected!";

}

*/

// TODO move this local host to live server and serve to public
// TODO PCP: hardcoded and exposed and only at the start of the project
$db['db_host'] = '127.0.0.1';
$db['db_user'] = 'root';
$db['db_pw'] = '';
$db['db_name'] = 'cms';

// defines constants from key-values converted to uppercase
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

// warning about upper case constants
$connection = mysqli_connect(DB_HOST, DB_USER,DB_PW, DB_NAME);

// check $connection
if ($connection) {

    echo "";
    // echo "connected..";

}

?>