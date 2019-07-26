<?php
include("../init.php");
$obj = new base_class;

$status = 1;
$obj->customQuery("SELECT id FROM users WHERE status = ?", [$status]);
$online_users_count = $obj->countRows();
echo json_encode(["users" => $online_users_count]);
 

?>