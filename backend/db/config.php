<?php
/* Database credentials
-- secure access to file before final rollout
*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'test1234');
define('DB_NAME', 'musicdb');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/* Attempt to connect to database */
try{
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
} catch(mysqli_sql_exception $ex){
    die("Cannot connect to the database! \n".$ex);
}

?>
