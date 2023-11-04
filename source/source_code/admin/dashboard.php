<?php

include '../component/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_login.css">

</head>
<body>
   
<!-- header section starts  -->
   <?php
      include '../component/admin_header.php';
   ?>
<!-- header section ends -->


<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $select_bookings = $conn->prepare("SELECT * FROM `booking`");
         $select_bookings->execute();
         $count_bookings = $select_bookings->rowCount();
      ?>
      <h3><?= $count_bookings; ?></h3>
      <p>total bookings</p>
      <a href="booking.php" class="btn">view bookings</a>
   </div>

   <div class="box">
      <?php
         $select_user = $conn->prepare("SELECT * FROM `user`");
         $select_user->execute();
         $count_user = $select_user->rowCount();
      ?>
      <h3><?= $count_user; ?></h3>
      <p>total users</p>
      <a href="user.php" class="btn">view user</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admins`");
         $select_admins->execute();
         $count_admins = $select_admins->rowCount();
      ?>
      <h3><?= $count_admins; ?></h3>
      <p>total admins</p>
      <a href="admin.php" class="btn">view admins</a>
   </div>


   <div class="box">
      <?php
         $select_contact = $conn->prepare("SELECT * FROM `contact`");
         $select_contact->execute();
         $count_contact = $select_contact->rowCount();
      ?>
      <h3><?= $count_contact; ?></h3>
      <p>total contact</p>
      <a href="contact.php" class="btn">view contact</a>
   </div>

   <div class="box">
      <h3>quick select</h3>
      <p>login or register</p>
      <a href="login.php" class="btn" style="margin-right: 1rem;">login</a>
      <a href="register.php" class="btn" style="margin-left: 1rem;">register</a>
   </div>

   </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../component/contact.php'; ?>

</body>
</html>