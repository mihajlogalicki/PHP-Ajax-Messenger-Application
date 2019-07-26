<?php

include("init.php");
include("security.php");

$obj = new base_class;
if(isset($_POST['change_name'])){

    $change_name = $obj->security($_POST['name']);
    $user_id = $_SESSION['user_id'];

    // !! validation
    $errors = 0;
    if(empty($change_name)){
        $change_name_error = "Name is required!";
        $errors++;
    } else if (strlen($change_name) < 5){
        $change_name_error = "Name can not be less than 5 characters!";
        $errors++;
    } else {
        $obj->customQuery("UPDATE users SET name = ? WHERE id = ?", [$change_name, $user_id]);
        $obj->setSession("name_updated", "Your name is successfully updated");
        // ** UPDATE change name on FRONT-END
        $obj->setSession("user_name", $change_name);
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
      <form method="POST" action="">
        <div class="group">
            <h2 class="form-heading">Change name</h2>
        </div>
        <div class="group">
            <input type="text" name="name" class="control" value="<?php echo $_SESSION['user_name']; ?>" placeholder="Name...">
        </div>
        <div class="group">
            <input type="submit" name="change_name" class="btn signup-btn" value="Change name">
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