<?php

include("init.php");
include("security.php");

$obj = new base_class;
if(isset($_POST['change_image_button'])){

        $img_name = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $user_id = $_SESSION["user_id"];
        // paths, extensions
        $target_directory = "assets/img/" ;
        $extensions = ["jpg", "png", "jpeg"];
        $file_type = pathinfo($img_name, PATHINFO_EXTENSION);

        if(empty($img_name)){
         $image_error = "Please choose the image";
         // !! if type of file not in our extension[] array jpg, jpeg DISPLAY ERROR!!!
        } else if(!in_array($file_type, $extensions)){
          $image_error = "Only JPG, JPEG, PNG files are allowed!";
        } else {
            move_uploaded_file($img_tmp, "$target_directory/$img_name");
            $obj->customQuery("UPDATE users SET image = ? WHERE id = ?", [$img_name, $user_id]);
            $obj->setSession("updated_image", "Your image changed successfully!");
            // ** UPDATE change image on FRONT-END
            $obj->setSession("user_image", $img_name);
            header("location:index.php");
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
<?php include("components/nav.php"); ?>
<div class="chat-container">

    <?php include("components/sidebar.php");  ?>

    <section id="right-area">
    <div class="form-section">
      <div class="form-grid">
      <form method="POST" action=""  enctype="multipart/form-data">
        <div class="group">
            <h2 class="form-heading">Change Photo</h2>
        </div>
        <div class="group">
                <label for="file" id="file-label"><i class="fas fa-cloud-upload-alt"></i> Update image</label>
                <input type="file" name="img" class="file" id="file">
                <div class="file-error error">
                    <?php echo isset($image_error) ?  $image_error : "";  ?>
                </div>
            </div>
        <div class="group">
            <input type="submit" name="change_image_button" class="btn signup-btn" value="Change Photo">
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