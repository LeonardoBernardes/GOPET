
<?php
/*
 * @Author: Leonardo Bernardes 
 * @Date: 2018-08-09 01:02:40 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-13 17:35:58
 */

$servername = "localhost:3306";

$username = "leonardobs";


$database = "gopet";
$password = "bernardes958796187";

$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
return $conn;

 ?>