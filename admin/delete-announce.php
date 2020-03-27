<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM announce WHERE id_announce = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: announce.php');
 ?>