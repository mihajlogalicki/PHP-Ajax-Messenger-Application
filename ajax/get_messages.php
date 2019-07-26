<?php
include("../init.php");
error_reporting(0);


// ** FETCH MESSAGES ** //

$obj = new base_class;

$user_id = $_SESSION['user_id'];

// join two tables
$obj->customQuery("SELECT * FROM messages INNER JOIN users ON messages.user_id = users.id
   ORDER BY messages.msg_id ASC");
$messages = $obj->fetch_all();

if($obj->countRows() == 0){
   echo "Lets start conversation to your friends";
} else {
   foreach ($messages as $message) {

      $full_name = ucwords($message->name);
      $user_image = $message->image;
      $user_status = $message->status;

      $msg = $message->message;
      $msg_type =  $message->msg_type;
      $db_user_id = $message->user_id;
      $msg_time = $message->msg_time;

      // ?? logged USER
      if($db_user_id == $user_id){

         // ** right user messages (YOU)
         if($msg_type == "text"){
            echo '
            <div class="right-messages common-margin">
                  <div class="right-msg-area">
                     <span class="date-time right-time">
                        '.$msg_time.'
                     </span>
                     <div class="right-msg">
                     <p>'. $msg .'</p>
                     </div>
                  </div>
            </div>';
         } else if ($msg_type == "jpeg" || $msg_type == "png" || $msg_type == "jpg"){
            echo '
            <div class="right-messages common-margin">
                  <div class="right-msg-area">
                     <span class="date-time right-time">
                        '.$msg_time.'
                     </span>
                     <div class="right-msg">
                        <img src="assets/img/'.$msg.'" class="common-images">
                     </div>
                  </div>
            </div>';
         } else if ($msg_type == "docx"){
            echo '
            <div class="right-messages common-margin">
                  <div class="right-msg-area">
                     <span class="date-time right-time">
                        1 day ago
                     </span>
                     <div class="right-msg">
                        <a href="assets/img/'.$msg.'">'. $msg .'</a>
                     </div>
                  </div>
            </div>';
         }
      } else {
         // ** left users messages (FRIEND)
         if($msg_type == "text"){
            echo '
            <div class="left-message common-margin">
            <div class="sender-img-block">
               <img src="assets/img/'.$user_image.'" style="width:80px; height:80px; border-radius: 3px;" class="sender-img" alt="">
               <span class="online-icon"></span>
            </div>
            <div class="left-msg-area">
               <div class="user-name-date">
                  <span class="sender-name">
                     '. $full_name.'
                  </span>
                  <span class="date-time">
                     '.$msg_time.'
                  </span>
               </div>
               <div class="left-msg">
                  <p>'. $msg.'</p>
               </div>
            </div>
      </div>';
         } else if ($msg_type == "jpeg" || $msg_type == "png" || $msg_type == "jpg"){
            echo '
            <div class="right-messages common-margin">
                  <div class="right-msg-area">
                     <span class="date-time right-time">
                        '.$msg_time.'
                     </span>
                     <div class="right-msg">
                        <img src="assets/img/'.$msg.'" class="common-images">
                     </div>
                  </div>
            </div>';
         } else if ($msg_type == "docx"){
            echo '
            <div class="right-messages common-margin">
                  <div class="right-msg-area">
                     <span class="date-time right-time">
                        '.$msg_time.'
                     </span>
                     <div class="right-msg">
                        <a href="assets/img/'.$msg.'">'. $msg .'</a>
                     </div>
                  </div>
            </div>';
         }
      }

   }
}



?>