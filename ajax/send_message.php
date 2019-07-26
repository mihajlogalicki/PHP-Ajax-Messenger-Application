<?php
include("../init.php");

$obj = new base_class;
if(isset($_POST['textMessage'])){
    $text_message = $_POST['textMessage'];
    $msg_type = "text";
    $user_id = $_SESSION['user_id'];
    $obj->customQuery("INSERT INTO messages (message, msg_type, user_id)
     VALUES (?,?,?)", [$text_message, $msg_type, $user_id]);
     echo "status";
}

?>