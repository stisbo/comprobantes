<?php

namespace App;

require_once('config/database.php');

// include_once('./autoload.php');
use App\Config\Database;
use \PDO;

$con = Database::getInstace();

$con1 = Database::getInstace();

var_dump($con);


$stmt = $con->prepare("SELECT * FROM tblAsientos", []);
$stmt->execute();
var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
echo "<br>";
