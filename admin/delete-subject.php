<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM subject WHERE id_subject = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: subject-matrial.php');
 ?>