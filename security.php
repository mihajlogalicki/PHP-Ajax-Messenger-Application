<?php
// !! Unauthorized user can not access on index.php page
if(!isset($_SESSION['user_id'])){
    $obj = new base_class;
    $obj->setSession("unauthorized_message", "You need to login first!");
    header("location:login.php");
}
?>