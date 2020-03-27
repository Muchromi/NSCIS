<?php
    $mysqli = new mysqli('localhost','root','password','melia');
    if ($mysqli -> connect_errno) {
    echo "Gagal";
    exit();
    }
?>