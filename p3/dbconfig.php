<?php

session_start();

$DB_host = "sql2.njit.edu";
$DB_user = "rjf26";
$DB_pass = "chamber73";
$DB_name = "rjf26";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'class.user.php';
$user = new USER($DB_con);

?>