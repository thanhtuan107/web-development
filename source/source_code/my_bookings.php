<?php

include("component/connect.php");

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30, '/');
 }


if(isset($_POST['cancel'])){

    $booking_id = $_POST['booking_id'];
    $booking_id = filter_var($booking_id, FILTER_SANITIZE_STRING);
 
    $verify_booking = $conn->prepare("SELECT * FROM `booking` WHERE booking_id = ?");
    $verify_booking->execute([$booking_id]);
 
    if($verify_booking->rowCount() > 0){
       $delete_booking = $conn->prepare("DELETE FROM `booking` WHERE booking_id = ?");
       $delete_booking->execute([$booking_id]);
       $success_msg[] = 'booking cancelled successfully!';
    }else{
       $warning_msg[] = 'booking cancelled already!';
    } 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/booking.css">

    <title>Bookings</title>
    
</head>
<body>
   <header class="header">
        <a href="#" class="logo">
            <img src="img/Logo_sub.png" alt="">
        </a>
        <a href="home.php#room" class="fas fa-angle-right" style="font-size: 30px; color: #223F49" id="right-btn"></a>
    </header>
    <!-- booking section starts  -->

<section class="bookings">

<h1 class="heading">my bookings</h1>

<div class="box-container">

<?php
   $select_bookings = $conn->prepare("SELECT * FROM `booking` WHERE user_id = ?");
   $select_bookings->execute([$user_id]);
   if($select_bookings->rowCount() > 0){
      while($fetch_booking = $select_bookings->fetch(PDO::FETCH_ASSOC)){
?>
<div class="box">
   <p>name : <span><?= $fetch_booking['name']; ?></span></p>
   <p>email : <span><?= $fetch_booking['email']; ?></span></p>
   <p>number : <span><?= $fetch_booking['number']; ?></span></p>
   <p>check in : <span><?= $fetch_booking['check_in']; ?></span></p>
   <p>check out : <span><?= $fetch_booking['check_out']; ?></span></p>
   <p>rooms : <span><?= $fetch_booking['rooms']; ?></span></p>
   <p>childs : <span><?= $fetch_booking['childs']; ?></span></p>
   <p>room type : <span><?= $fetch_booking['room_type']; ?></span></p>
   <p>booking id : <span><?= $fetch_booking['booking_id']; ?></span></p>
   <form action="" method="POST">
      <input type="hidden" name="booking_id" value="<?= $fetch_booking['booking_id']; ?>">
      <input type="submit" value="cancel booking" name="cancel" class="btn" onclick="return confirm('cancel this booking?');">
   </form>
</div>
<?php
 }
}else{
?>   
<div class="box" style="text-align: center;">
   <p style="padding-bottom: .5rem; text-transform:capitalize;">no bookings found!</p>
   <a href="home.php#reservation" class="btn">book new</a>
</div>
<?php
}
?>
</div>

</section>

<!-- booking section ends -->
    <!-- booking section -->

    

    <script src="js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php
        include("component/contact.php");
    ?>
</body>
</html>