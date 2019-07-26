<?php
include "init.php";
$obj = new base_class();

if(isset($_POST['signup'])){

    $full_name = $obj->security($_POST['full_name']);
    $email = $obj->security($_POST['email']);
    $password = $obj->security($_POST['password']);
    // set paths, names for files
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $file_size = $_FILES['img']['size'];
    // paths, extensions
    $target_directory = "assets/img/" ;
    $extensions = ["jpg", "png", "jpeg"];
    $file_type = pathinfo($img_name, PATHINFO_EXTENSION);

    // ** VALIDATION 
    $errors = 0;
    if(empty($full_name)){
        $name_error = "Full name is required!";
        $errors++;
    }
    // ** EMAIL VALIDATION 
    if(empty($email)){
        $email_error = "Email is required!";
        $errors++;
    } 
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error = "Email not valid format!";
        $errors++;
    } else {
        $obj->customQuery("SELECT email FROM users WHERE email = ?", array($email));
        if($obj->countRows() > 0){
            $email_error = "Sorry this Email exist!";
            $errors++;
        } 
    }
    // ** PASSWORD VALIDATION 
    if(empty($password)){
        $password_error = "Password is required!";
        $errors++;
    } else if(strlen($password) < 5){
        $password_error = "Password is to short!";
        $errors++;
    }
    // ** IMAGE VALIDATION 
    if(empty($img_name)){
        $image_error = "Image is required";
        $errors++;
    } else if(!in_array($file_type, $extensions)){
        $image_error = "Only JPG, JPEG, PNG files are allowed!";
        $errors++;
    } else if($file_size > 1024000){
        $image_error = "File must be less than 1 MB in size";
        $errors++;
    }

    // ?? No errors  
    if($errors == 0){
        move_uploaded_file($img_tmp, "$target_directory/$img_name");
        $status = 0;
        $clean_status = 0;
        $obj->customQuery("INSERT INTO users (name, email, password, image, status, clean_status)
        VALUES (?,?,?,?,?,?)", array($full_name, $email, password_hash($password, PASSWORD_DEFAULT), $img_name, $status, $clean_status));
        $obj->setSession("account_success", "<div class='alert alert-success'>Your account is successfully created</div>");
        header("location:login.php");
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
<div class="signup-container">
    <div class="account-left">
    
    </div>
    <div class="account-right">
     <div class="form-area">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="group">
                <h2 class="form-heading">Create account</h2>
            </div>
            <div class="group">
                <input type="text" name="full_name" class="control" placeholder="Enter Full name..">
                <div class="name-error error">
                    <?php echo isset($name_error) ?  $name_error : "";  ?>
                </div>
            </div>
            <div class="group">
                <input type="email" name="email" class="control" placeholder="Enter email..">
                <div class="email-error error">
                    <?php echo isset($email_error) ?  $email_error : "";  ?>
                </div>
            </div>
            <div class="group">
                <input type="password" name="password" class="control" placeholder="Enter password..">
                <div class="password-error error">
                    <?php echo isset($password_error) ?  $password_error : "";  ?>
                </div>
            </div>
            <div class="group">
                <label for="file" id="file-label"><i class="fas fa-cloud-upload-alt"></i> Choose image</label>
                <input type="file" name="img" class="file" id="file">
                <div class="file-error error">
                    <?php echo isset($image_error) ?  $image_error : "";  ?>
                </div>
            </div>
            <div class="group">
                <input type="submit" name="signup" class="btn signup-btn" value="Create account">
            </div>
            <div class="group">
                <a href="login.php" class="link">Already have an account?</a>
            </div>
        </form>
     </div>
    </div>
</div>

<!-- Our jQuery library -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/file_label.js"></script>
</body>
</html>