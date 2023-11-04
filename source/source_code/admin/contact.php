<?php

include '../component/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `contact` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_bookings = $conn->prepare("DELETE FROM `contact` WHERE id = ?");
      $delete_bookings->execute([$delete_id]);
      $success_msg[] = 'Contact deleted!';
   }else{
      $warning_msg[] = 'Contact deleted already!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_login.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../component/admin_header.php'; ?>
<!-- header section ends -->

<!-- contact section starts  -->

<section class="grid">

   <h1 class="heading">contact</h1>

   <div class="box-container">

   <?php
      $select_contact = $conn->prepare("SELECT * FROM `contact`");
      $select_contact->execute();
      if($select_contact->rowCount() > 0){
         while($fetch_contact = $select_contact->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>name : <span><?= $fetch_contact['name']; ?></span></p>
      <p>email : <span><?= $fetch_contact['email']; ?></span></p>
      <p>number : <span><?= $fetch_contact['number']; ?></span></p>
      <form action="" method="POST">
         <input type="hidden" name="delete_id" value="<?= $fetch_contact['id']; ?>">
         <input type="submit" value="delete contact" onclick="return confirm('delete this contact?');" name="delete" class="btn">
      </form>
   </div>
   <?php
      }
   }else{
   ?>
   <div class="box" style="text-align: center;">
      <p>no contact found!</p>
      <a href="dashboard.php" class="btn">go to home</a>
   </div>
   <?php
      }
   ?>

   </div>

</section>

<!-- contact section ends -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../component/contact.php'; ?>

</body>
</html>