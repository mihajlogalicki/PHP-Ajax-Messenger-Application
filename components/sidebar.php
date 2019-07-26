<section id="sidebar">
        <div class="left-ul">
            <ul>
                <li><a href="javascript:void(0);"><img src="assets/img/<?php echo $_SESSION["user_image"]; ?>" class="image" alt=""></a></li>
                <li><a href="index.php"><?php echo $_SESSION['user_name'] ?></a></li>
                <li><a href="changeName.php">Change Name</a></li>
                <li><a href="changePassword.php">Change Password</a></li>
                <li><a href="changeImage.php">Change Photo</a></li>
                <li><a href="#"><i class="fas fa-user-friends"></i> Online <span class="online_users"></span></a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
</section>