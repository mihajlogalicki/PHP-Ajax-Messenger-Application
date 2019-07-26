<?php
include("init.php");
$obj = new base_class;

if(isset($_POST['login'])){
    $email =  $obj->security($_POST['email']);
    $password =  $obj->security($_POST['password']);

    $errors = 0;
    // !! EMAIL VALIDATION 
    if(empty($email)){
        $email_error = "Email is required!";
        $errors++;
    }
    // !! PASSWORD VALIDATION 
    if(empty($password)){
        $password_error = "Password is required!";
        $errors++;
    }
    // ?? no errors
    if($errors == 0){
        $obj->customQuery("SELECT * FROM users WHERE email = ?", array($email));
        if($obj->countRows() > 0){
            // if user with this email exist fetch him!
            $row = $obj->singleResultFetch();
            $db_email = $row->email;
            $db_password = $row->password;
            $user_id = $row->id;
            $user_name = $row->name;
            $user_image = $row->image;
            $clean_status = $row->clean_status;
            // if user form password and db password match
            if(password_verify($password, $db_password)){
                // ** VALID password - exist in db! REDIRECT him and set SESSION
                    $obj->setSession("user_name", $user_name);
                    $obj->setSession("user_id", $user_id);
                    $obj->setSession("user_image", $user_image);
                    header("location:index.php");
                // ** update user status to 1 its mean user is ONLINE
                $status = 1;
                $obj->customQuery("UPDATE users SET status = ? WHERE id = ?", [$status, $user_id]);
                $login_time = time();
                $obj->customQuery("SELECT * FROM users_activities WHERE user_id = ?", [$user_id]);
                $activity_row = $obj->singleResultFetch();
                if($activity_row == 0){
                    $obj->customQuery("INSERT INTO users_activities (user_id, login_time) VALUES (?,?)",
                    [$user_id, $login_time]);
                }
            } else {
                $password_error = "Please enter correct password!";
            }
        } else {
            $email_error = "Please enter correct email!";
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
    <?php include("components/css.php");  ?>
</head>
<body>

<?php if(isset($_SESSION["unauthorized_message"])):  ?>
<div class="flash error-flash">
<span class="remove">&times;</span>
 <div class="flash-heading">
    <h3><span>&#x2715;</span> Error: you have error!</h3>
 </div>
 <div class="flash-body">
    <p><?php echo $_SESSION["unauthorized_message"]; ?></p>
 </div>
</div> 
<?php endif;unset($_SESSION["unauthorized_message"]);?>

<div class="signup-container">
    <div class="account-left">
    
    </div>
    <div class="account-right">
     <div class="form-area">
        <?php
            if(isset($_SESSION["account_success"])){
                echo $_SESSION["account_success"];
                unset($_SESSION["account_success"]);
            }
        ?>
        <form method="POST" action="">
            <div class="group">
                <h2 class="form-heading">User Login</h2>
            </div>
            <div class="group">
                <input type="email" name="email" class="control" placeholder="Enter email..">
                <div class="group">
                <div class="email-error error">
                    <?php echo isset($email_error) ?  $email_error : "";  ?>
                </div>
            </div>
            </div>
            <div class="group">
                <input type="password" name="password" class="control" placeholder="Enter password..">
                <div class="group">
                <div class="password-error error">
                    <?php echo isset($password_error) ?  $password_error : "";  ?>
                </div>
            </div>
            </div>
            <div class="group">
                <input type="submit" name="login" class="btn signup-btn" value="User login">
            </div>
            <div class="group">
                <a href="signup.php" class="link">Create account?</a>
            </div>
        </form>
     </div>
    </div>
</div>

<!-- Our jQuery library -->
<?php include("components/js.php"); ?>

</body>
</html>