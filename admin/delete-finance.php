<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM pattycash WHERE id_pattycash = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: finance.php');
 ?>