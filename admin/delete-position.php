<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM position WHERE id_position = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: position.php');
 ?>