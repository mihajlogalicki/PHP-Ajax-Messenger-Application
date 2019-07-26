<?php
include("../init.php");

$obj = new base_class;
if(isset($_FILES['send_file']['name'])){
    $file_name = $_FILES['send_file']['name'];
    $tmp_name = $_FILES['send_file']['tmp_name'];
    $target_directory = "../assets/img";
    $extension = ["jpg", "png", "jpeg", "pdf", "docx", "zip"];
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

    if(!in_array($file_type, $extension)){
        echo "error";
    } else {
         $user_id = $_SESSION['user_id'];
         move_uploaded_file($tmp_name, "$target_directory/$file_name");
         $obj->customQuery("INSERT INTO messages (message, msg_type, user_id) 
         VALUES (?,?,?)", [$file_name, $file_type, $user_id]);
         echo "success";
    }
}

?>