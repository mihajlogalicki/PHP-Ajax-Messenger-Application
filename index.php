<?php

include("init.php");
include("security.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new account</title>
    <?php include("components/css.php");  ?>
</head>
<body>

<!-- ------------------------------------------------------------------- -->

<!-- START display success flash session message for PASSWORD -->
<?php if(isset($_SESSION["updated_password"])):  ?>

<div class="flash success-flash">
<span class="remove">&times;</span>
 <div class="flash-heading">
    <h3><span>&#10004;</span> Success:  Success: you have done!!</h3>
 </div>
 <div class="flash-body">
    <p><?php echo $_SESSION["updated_password"]; ?></p>
 </div>
</div>

<?php endif; unset($_SESSION["updated_password"]); ?>
<!-- END  display success flash session message PASSWORD -->

<!-- ------------------------------------------------------------------- -->

<!-- START display success flash session message for NAME -->
<?php if(isset($_SESSION["name_updated"])):  ?>

<div class="flash success-flash">
<span class="remove">&times;</span>
 <div class="flash-heading">
    <h3><span>&#10004;</span> Success:  Success: you have done!!</h3>
 </div>
 <div class="flash-body">
    <p><?php echo $_SESSION["name_updated"]; ?></p>
 </div>
</div>

<?php endif; unset($_SESSION["name_updated"]); ?>
<!-- END  display success flash session message NAME -->

<!-- ------------------------------------------------------------------- -->

<!-- START display success flash session message for IMAGE CHANGE -->
<?php if(isset($_SESSION["updated_image"])):  ?>

<div class="flash success-flash">
<span class="remove">&times;</span>
 <div class="flash-heading">
    <h3><span>&#10004;</span> Success:  Success: you have done!!</h3>
 </div>
 <div class="flash-body">
    <p><?php echo $_SESSION["updated_image"]; ?></p>
 </div>
</div>

<?php endif; unset($_SESSION["updated_image"]); ?>
<!-- END  display success flash session message IMAGE CHANGE -->

<!-- navbar -->
<?php include("components/nav.php"); ?>

<div class="chat-container">

    <!-- sidebar -->
    <?php include("components/sidebar.php"); ?>

    <!-- -->
    <section id="right-area">
    <?php include("components/messages.php"); ?>
    
    <!-- chat form -->
    <?php include("components/chat_form.php"); ?>
    </section>
</div>
<!-- Our jQuery library -->
<?php include("components/js.php"); ?>
</body>
</html>