<?php 
include_once('../include/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM member WHERE id_member = '{$id}'";

$result = mysqli_query($mysqli, $sql);

header('Location: member.php');
 ?>