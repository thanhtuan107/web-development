<?php

require_once "../Final/component/connect.php";

if(isset($_POST['submit'])){

  
   $user_id = create_unique_id();
   $user_name = $_POST['user_name'];
   $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

  

   $select_user = $conn->prepare("SELECT * FROM `user` WHERE user_name = ?");
   $select_user->execute([$user_name]);

   
   if($select_user->rowCount() > 0){
      $warning_msg[] = 'Useruser_name already taken!';
   }else{
      if($pass != $cpass){
         $warning_msg[] = 'Password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `user`(user_id, user_name, email, pass, user_type) VALUES(?,?,?,?,?)");
         $insert_user->execute([$user_id,$user_name, $email, $cpass, $user_type]);
         $success_msg[] = 'Sign up successfully!';
         header('Location:user_login.php');
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta user_name="viewport" content="width=device-width, initial-scale=1.0">
   <title>sign up form</title>

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
      <h3>sign up now</h3>
      <input type="text" name="user_name" required placeholder="enter your user_name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="password" name="password" required placeholder="enter your password" class="box">
      <input type="password" name="cpassword" required placeholder="confirm your password" class="box">
      <select name="user_type" class="box">
         <option value="user">user</option>
      </select>
      <input type="submit" name="submit" value="sign up now" class="btn">
      <p>already have an account? <a href="user_login.php">login now</a></p>
   </form>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



</body>
</html>