<?php

include("init.php");
$obj = new base_class;
$status = 0;
$user_id = $_SESSION['user_id'];
$obj->customQuery("UPDATE users SET status = ? WHERE id = ?", [$status, $user_id]);
session_destroy();
header("location:login.php");

?>