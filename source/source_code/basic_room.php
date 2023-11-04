<?php

include("component/connect.php");

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30, '/');
    header('location:home.php');
 }


if(isset($_POST['book'])){
    $booking_id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $rooms = $_POST['rooms'];
    $rooms = filter_var($rooms, FILTER_SANITIZE_STRING);
    $check_in = $_POST['check_in'];
    $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);
    $check_out = $_POST['check_out'];
    $check_out = filter_var($check_out, FILTER_SANITIZE_STRING);
    $room_type = $_POST['room_type'];
    $room_type = filter_var($room_type, FILTER_SANITIZE_STRING);
    $childs = $_POST['childs'];
    $childs = filter_var($childs, FILTER_SANITIZE_STRING);

    $total_rooms = 0;

    $check_bookings = $conn->prepare("SELECT * FROM `booking` WHERE check_in = ?");
    $check_bookings->execute([$check_in]);
    
    while($fetch_bookings = $check_bookings->fetch(PDO::FETCH_ASSOC)){
        $total_rooms += $fetch_bookings['room'];
    }

    if($total_rooms >= 30){
        $warning_msg[] = 'rooms are not available';
    }else{
        $verify_bookings = $conn->prepare("SELECT * FROM `booking` WHERE user_id = ? AND name = ? AND email = ? AND number = ? AND rooms = ? AND check_in = ? AND check_out = ? AND childs = ? AND room_type=?");
        $verify_bookings->execute([$user_id, $name, $email, $number, $rooms, $check_in, $check_out, $childs, $room_type]);

        if($verify_bookings->rowCount() > 0){
            $warning_msg[] = 'room booked already!';
         }else{
            $book_room = $conn->prepare("INSERT INTO `booking`(booking_id, user_id, name, email, number, rooms, check_in, check_out, childs, room_type) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $book_room->execute([$booking_id, $user_id, $name, $email, $number, $rooms, $check_in, $check_out, $childs, $room_type]);
            $success_msg[] = 'Room booked successfully!';
         }
    }
}

if(isset($_POST['send'])){

    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
 
    $verify_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ?");
    $verify_contact->execute([$name, $email, $number]);
 
    if($verify_contact->rowCount() > 0){
       $warning_msg[] = 'Contact sent already!';
    }else{
       $insert_contact = $conn->prepare("INSERT INTO `contact`(id, name, email, number) VALUES(?,?,?,?)");
       $insert_contact->execute([$id, $name, $email, $number]);
       $success_msg[] = 'We will contact you as soon as possible, thanks!';
    }
 }
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Basic Room</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/room.css">
    </head>
<body>

    <header class="header">
        <a href="#" class="logo">
            <img src="img/Logo_sub.png" alt="">
        </a>
        <a href="index.php#room" class="fas fa-angle-right" style="font-size: 30px; color: #223F49" id="right-btn"></a>
    </header>

    <section class="intro">
        <h2>heaven basic room</h2>
        <div class="row">
            <div class="pic">
                <img src="img/basic_room.png" alt="">
                <p>70$ / day</p>
            </div>
        </div>
    </section>


    <section class="describe">
        <div class="heading">describe heaven's basic room</div>
        <div class="row">
            <div class="image">
                <img src="img/room_png/basic_room.png" alt="">
            </div>
            <div class="txt_content">
                <p>Welcome to our Basic's Room, a luxurious and cozy space perfect for a romantic getaway or honeymoon. As you step inside, you'll be greeted by a warm and inviting atmosphere, with soft lighting and tasteful decor to set the mood</p>
                <p>Our basic room is a simple and functional space, perfect for those on a budget or looking for a no-frills option. The room features a comfortable bed with clean linens, a work desk and chair, and a flat-screen TV. Complimentary Wi-Fi is available, and the room is equipped with a basic bathroom and shower facilities. Although it may not have all the luxurious amenities of our other rooms, our basic room provides everything you need for a comfortable and affordable stay.</p>
            </div>
        </div>
    </section>

    <section class="reservation" id="reservation">

<form action="" method="post">
   <h3 class="heading">make a reservation</h3>
   <div class="flex">
      <div class="row">
         <p>your name <span>*</span></p>
         <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
      </div>
      <div class="row">
         <p>your email <span>*</span></p>
         <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="input">
      </div>
      <div class="row">
         <p>your number <span>*</span></p>
         <input type="number" name="number" maxlength="10" min="0" max="9999999999" required placeholder="enter your number" class="input">
      </div>
      <div class="row">
         <p>rooms <span>*</span></p>
         <select name="rooms" class="input" required>
            <option value="1" selected>1 room</option>
            <option value="2">2 rooms</option>
            <option value="3">3 rooms</option>
            <option value="4">4 rooms</option>
            <option value="5">5 rooms</option>
            <option value="6">6 rooms</option>
         </select>
      </div>
      <div class="row">
         <p>check in <span>*</span></p>
         <input type="date" name="check_in" class="input" required>
      </div>
      <div class="row">
         <p>check out <span>*</span></p>
         <input type="date" name="check_out" class="input" required>
      </div>
      <div class="row">
         <p>childs <span>*</span></p>
         <select name="childs" class="input" required>
            <option value="0" selected>0 child</option>
            <option value="1">1 child</option>
            <option value="2">2 childs</option>
            <option value="3">3 childs</option>
         </select>
      </div>
      <div class="row">
        <p>room type <span>*</span></p>
        <select name="room_type" class="input" required>
           <option value="basic room" selected>basic room</option>
        </select>
     </div>
   </div>
   <input type="submit" value="book now" name="book" class="btn">
</form>

</section>

<!-- reservation section ends -->
   
    <section class="fac">
        <div class="heading">facilities in heaven hotel</div>
            <div class="row">
                <div class="image">
                    <img src="img/restaurants.png" alt="">
                </div>
                <div class="content">
                    <p>Nestled in the heart of the city, our restaurant offers a warm and inviting atmosphere, perfect for a romantic dinner or a night out with friends. Our menu features a range of delicious dishes, crafted from the freshest ingredients and served with flair. With attentive service and a welcoming ambiance, we're sure you'll enjoy a memorable dining experience with us.</p>
                </div>             
            </div>
    
            <div class="row">
                <div class="content">
                    <p>Our gym is a spacious and well-equipped space, perfect for achieving your fitness goals. With state-of-the-art cardio and strength-training equipment, as well as a range of free weights and functional training areas, you'll find everything you need to stay in shape. Our experienced trainers are on hand to provide personalized guidance and support, ensuring you get the most out of your workout. And with a motivating atmosphere and vibrant community, you'll feel inspired to push yourself to the next level.                    </p>
                </div>
                <div class="image">
                    <img src="img/gym.png" alt="">
                </div>
            </div>
    
            <div class="row">
                <div class="image">
                    <img src="img/swimming_pool.png" alt="">
                </div>
                <div class="content">
                    <p>Our pool is a serene and refreshing oasis, perfect for relaxation and exercise. With crystal-clear waters and a spacious layout, you'll feel invigorated as you swim laps or simply float on the surface. Our poolside lounge chairs and umbrellas provide the ideal spot for sunbathing and taking in the beautiful surroundings. Whether you're looking for a peaceful retreat or an energizing workout, our pool is the perfect destination.</p>
                </div>
            </div>
    </section>

    <?php
    include("component/footer.php");
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php
        include("component/contact.php");
        ?>
    
</body>
</html>