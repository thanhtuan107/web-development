<?php

// include '../connect/connect.php';
require "../Final/component/connect.php";


if(isset($_POST['submit'])){

   $user_name = $_POST['user_name'];
   $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   
   $select_user = $conn->prepare("SELECT * FROM `user` WHERE user_name = ? AND pass = ? LIMIT 1");
   $select_user->execute([$user_name, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);


   if($select_user->rowCount() > 0){
      header('location:home.php');

   }else{
      $warning_msg[] = 'Incorrect username or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta user_name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/admin_login.css">

</head>
<body>

<header class="header">
   <section class="flex">
   <a href="user_login.php" class="logo">WELCOME.</a>

<nav class="navbar">
    <a href="index.php#sup-header">home</a>
    <a href="index.php#about">about</a>
    <a href="index.php#room">catalogues</a>
    <a href="my_booking.php">my bookings</a>
    <a href="index.php#contact">contact</a>
    <a href="user_login.php">login</a>
</nav>

<div class="icons">
    <div class="fas fa-bars" id="menu-btn"></div>
</div>
   </section>

</header>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <p>default name = <span>user</span> & password = <span>123456</span></p>
      <input type="text" name="user_name" placeholder="enter username" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">
      <p>don't have an account? <a href="user_signup.php">sign up now</a></p>
   </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


</body>
</html>