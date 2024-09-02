<?php 
// Hostname
$host = "localhost";
// Username
$uname = "root";
// Password
$pw = "@123456789";
// Database Name
$dbname = "invoice2";

try{
    $conn = new MySQLi($host, $uname, $pw, $dbname);
}catch(Exception $e){
    echo "Database Connection Failed: <br>";
    print_r($e->getMessage());
    exit;
}
?>