<?php

include '../component/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `user` WHERE user_id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_users = $conn->prepare("DELETE FROM `user` WHERE user_id = ?");
      $delete_users->execute([$delete_id]);
      $success_msg[] = 'User deleted!';
   }else{
      $warning_msg[] = 'User deleted already!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_login.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../component/admin_header.php'; ?>
<!-- header section ends -->

<!-- users section starts  -->

<section class="grid">

   <h1 class="heading">users</h1>

   <div class="box-container">

   <?php
      $select_users = $conn->prepare("SELECT * FROM `user`");
      $select_users->execute();
      if($select_users->rowCount() > 0){
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>user id : <span><?= $fetch_users['user_id']; ?></span></p>
      <p>name : <span><?= $fetch_users['user_name']; ?></span></p>
      <p>email : <span><?= $fetch_users['email']; ?></span></p>
      <p>password : <span><?= $fetch_users['pass']; ?></span></p>
      <form action="" method="POST">
         <input type="hidden" name="delete_id" value="<?= $fetch_users['user_id']; ?>">
         <input type="submit" value="delete user" onclick="return confirm('delete this user?');" name="delete" class="btn">
      </form>
   </div>
   <?php
      }
   }else{
   ?>
   <div class="box" style="text-align: center;">
      <p>users not found!</p>
      <a href="dashboard.php" class="btn">go to home</a>
   </div>
   <?php
      }
   ?>

   </div>

</section>

<!-- users section ends -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../component/contact.php'; ?>

</body>
</html>