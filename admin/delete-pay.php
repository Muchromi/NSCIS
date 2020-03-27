<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM payment WHERE id_payment = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: pay.php');
 ?>