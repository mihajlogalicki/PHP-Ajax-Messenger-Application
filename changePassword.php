<?php
include("init.php");
include("security.php");

$obj = new base_class;
if(isset($_POST['change_password'])){
    $current_password = $obj->security($_POST['current_password']);
    $new_password = $obj->security($_POST['new_password']);
    $repeat_password = $obj->security($_POST['repeat_password']);

    // ** VALIDATION 
    $errors = 0;
    // !! CURRENT PASSWORD
    if(empty($current_password)){
        $current_password_error = "Current password is required!";
        $errors++;
    }
    // !! NEW PASSWORD 
    if(empty($new_password)){
        $new_password_error = "New password is required!";
        $errors++;
    } else if(strlen($new_password) < 5){
        $new_password_error = "New password is too short!";
        $errors++;
    }
    // !! REPEAT NEW PASSWORD
    if(empty($repeat_password)){
        $repeat_password_error = "Repeat new password is required!";
        $errors++;
    }  // !! NEW PASSWORD AND REPEAT PASSWORD 
     else if($new_password != $repeat_password){
        $repeat_password_error = "Password is not confirm!";
        $errors++;
    } 

    // ?? no errros
    if($errors == 0){
        // ** current online user with SESSION of course
        $user_id = $_SESSION['user_id'];
        $obj->customQuery("SELECT password FROM users WHERE id = ?", [$user_id]);
        if($obj->countRows() > 0){
            $row = $obj->singleResultFetch();
            $db_password = $row->password;
            if(password_verify($current_password, $db_password)){
                $obj->customQuery("UPDATE users SET password = ? WHERE id = ?", 
                [password_hash($new_password,PASSWORD_DEFAULT), $user_id]);
                // ** set success flash message for update password
                $obj->setSession("updated_password", "Your password is successfully updated!");
                header("location:index.php");
                
                
            } else {
               $current_password_error = "Please enter the correct password!";
            }
        }

    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new account</title>
   <?php include("components/css.php") ?>
</head>
<body>
<?php include("components/nav.php"); ?>
<div class="chat-container">

<?php include("components/sidebar.php");  ?>

    <section id="right-area">
    <div class="form-section">
      <div class="form-grid">
      <form method="POST" action="">
        <div class="group">
            <h2 class="form-heading">Change password</h2>
        </div>
        <div class="group">
            <input type="password" name="current_password" class="control" placeholder="Add Current Password">
            <div class="error">
                <?php echo isset($current_password_error) ?  $current_password_error : "";  ?>
            </div>
        </div>
        <div class="group">
            <input type="password" name="new_password" class="control" placeholder="Create New Password">
            <div class="error">
                <?php echo isset($new_password_error) ?  $new_password_error : "";  ?>
            </div>
        </div>
        <div class="group">
            <input type="password" name="repeat_password" class="control" placeholder="Repeat New Password">
            <div class="error">
                <?php echo isset($repeat_password_error) ?  $repeat_password_error : "";  ?>
            </div>
        </div>
        <div class="group">
            <input type="submit" name="change_password" class="btn signup-btn" value="Save Changes">
        </div>
        </form>
      </div>
    </div>
    </section>
</div>
<!-- Our jQuery library -->
<?php include("components/js.php"); ?>
</body>
</html>