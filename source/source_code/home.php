<?php

include("component/connect.php");

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30, '/');
    header('location:home.php');
 }
 
 if(isset($_POST['check'])){
 
    $check_in = $_POST['check_in'];
    $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);
 
    $total_rooms = 0;
 
    $check_bookings = $conn->prepare("SELECT * FROM `booking` WHERE check_in = ?");
    $check_bookings->execute([$check_in]);
 
    while($fetch_booking = $check_bookings->fetch(PDO::FETCH_ASSOC)){
       $total_rooms += $fetch_bookings['rooms'];
    }
 
    // if the hotel has total 30 rooms 
    if($total_rooms >= 30){
       $warning_msg[] = 'rooms are not available';
    }else{
       $success_msg[] = 'rooms are available';
    }
 
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Heaven Hotels</title>
    
</head>
<body>
    
    <!-- header section -->
    <header class="header">
        <a href="#" class="logo">
            <img src="img/Logo_sub.png" alt="">
        </a>
        <nav class="navbar">
            <a href="home.php#sup-header">home</a>
            <a href="home.php#about">about</a>
            <a href="home.php#reservation">book</a>
            <a href="home.php#room">catalogues</a>
            <a href="my_bookings.php">my bookings</a>
            <a href="home.php#contact">contact</a>
            <a href="user_logout.php">logout</a>
        </nav>
    
        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>
    
    </header>


<!-- header section -->

    <!-- support header section -->
    <section class="sup-header" id="sup-header">
        
            <div class="content">
                <h1 class="title1">HEAVEN CYPRUS HOTEL</h1>
                <p>E ʻimi i kou noho maikaʻi loa, i kēlā me kēia manawa, ma nā wahi āpau - puke me ka maʻalahi ma kā mākou kahua hoʻopaʻa hōkele.</p>
                <div class="image">
                    <img src="img/BANNER.png" alt="">
                </div>
            </div>
    </div>
    </section>
    <!-- support header section -->

    <!-- about section -->
    <section class="about" id="about">
        <h1 class="txt_about">about us</h1>
        <div class="row">
            <div class="image">
                <img src="img/about_us.jpg" alt="">
            </div>
            <div class="txt_content">
                <h3>What are the special things in here?</h3>
                <p>Our hotel offers a delightful experience for travelers seeking a comfortable and memorable stay. The contemporary design and modern amenities provide a perfect blend of comfort and convenience.</p>
                <p>From the warm welcome upon arrival to the attentive service throughout the stay, our team ensures a pleasant and hassle-free experience. The well-appointed rooms, top-notch facilities, and delicious dining options cater to the needs of both leisure and business travelers.</p>
                <p>Whether it's a relaxing getaway or a productive business trip, our hotel promises a pleasant stay with excellent hospitality and a touch of luxury.</p>
                <a href="learn_more.php" class="btn">learn more</a>
            </div>
        </div>
    </section>
    <!-- about section -->

    <!-- overview rooms section -->
    <section class="room" id="room">
        <h1 class="heading"> check our latest </h1>

	    <div class="box-container">
            <!-- couple room box -->
			<div class="box">
					<div class="image">
						<img src="img/couple_room.png" alt="">
					</div>
					<div class="star_icon">
						<a href="#" class="fa fa-star">4.5</a>
					</div>
					<div class="price">$150</div>
					<div class="content">
						<a href="#" class="title">couple room</a>
						<p>couple</p>
						<div class="icons">
							<a href="couple_room.php" class="fas fa-heart"></a>
							<a href="couple_room.php" class="fas fa-clock"></a>
							<a href="couple_room.php" class="fas fa-eye"></a>
						</div>
						<div class="sub-room">
							<a href="couple_room.php" class="btn">book now</a>
						</div>
					</div>
			</div>
            <!-- single room box -->
			<div class="box">
					<div class="image">
						<img src="img/single_room.png" alt="">
					</div>
					<div class="star_icon">
						<a href="#" class="fa fa-star">5.0</a>
					</div>
					<div class="price">$100</div>
					<div class="content">
						<a href="#" class="title">single room</a>
						<p>single</p>
						<div class="icons">
							<a href="single_room.php" class="fas fa-heart"></a>
							<a href="single_room.php" class="fas fa-clock"></a>
							<a href="single_room.php" class="fas fa-eye"></a>
						</div>
						<div class="sub-room">
							<a href="single_room.php" class="btn">book now</a>
						</div>
					</div>
			</div>
            <!-- basic room box -->
			<div class="box">
					<div class="image">
						<img src="img/basic_room.png" alt="">
					</div>
					<div class="star_icon">
						<a href="#" class="fa fa-star">4.7</a>
					</div>
					<div class="price">$70</div>
					<div class="content">
						<a href="#" class="title">basic room</a>
						<p>single</p>	
						<div class="icons">
							<a href="basic_room.php" class="fas fa-heart"></a>
							<a href="basic_room.php" class="fas fa-clock"></a>
							<a href="basic_room.php" class="fas fa-eye"></a>
						</div>
						<div class="sub-room">
							<a href="basic_room.php" class="btn">book now</a>
						</div>
					</div>
					
			</div>
        </div>
    </section>
    <!-- overview rooms section -->

    <!-- facilities section -->
    <section class="facilities" id="facilities">
        <h1 class="heading1">our most popular facilities loved by all</h1>
	    <div class="box-container">
            <!-- gym box -->
		    <div class="box">
			    <div class="image">
				    <img src="img/gym.png" alt="">
			    </div>
			<div class="content">
				    <h3>GYM center</h3>				
				    <p>The first California Fitness club was established in 1996 in the business district of Hong Kong near Lan Kwai Fong.</p>
				    <a href="Gym.php" class="btn">visit now</a>
			    </div>
		    </div>
            <!-- restaurant box -->
		    <div class="box">
		        <div class="image">
			        <img src="img/restaurants.png" alt="">
		        </div>
		        <div class="content">
			        <h3>restaurant</h3>
			        <p>Heaven architecture immediately stands out from the neighboring Vietnamese shophouses in the trendy Dakao Ward. The restaurant is a tribute to Northern Europe.</p>
			        <a href="Restaurant.php" class="btn">visit now</a>
		        </div>
	        </div>
            <!-- swimming pool section -->
	        <div class="box">
		        <div class="image">
			        <img src="img/swimming_pool.png" alt="">
		        </div>
		        <div class="content">
			        <h3>swimming pool</h3>
			        <p>Expecting nothing less, Heaven’s swimming pool is just as sumptuous and high-end as expected.</p>
			        <a href="SwimmingPool.php" class="btn">visit now</a>
			    </div>
	        </div>
	    </div>
    </section>
    <!-- facilities section -->

    <!-- reservation section starts  -->

<section class="reservation" id="reservation">

<form action="" method="post">
   <h3>make a reservation</h3>
   <div class="flex">
      <div class="box">
         <p>your name <span>*</span></p>
         <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
      </div>
      <div class="box">
         <p>your email <span>*</span></p>
         <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="input">
      </div>
      <div class="box">
         <p>your number <span>*</span></p>
         <input type="number" name="number" maxlength="10" min="0" max="9999999999" required placeholder="enter your number" class="input">
      </div>
      <div class="box">
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
      <div class="box">
         <p>check in <span>*</span></p>
         <input type="date" name="check_in" class="input" required>
      </div>
      <div class="box">
         <p>check out <span>*</span></p>
         <input type="date" name="check_out" class="input" required>
      </div>
      <div class="box">
         <p>childs <span>*</span></p>
         <select name="childs" class="input" required>
            <option value="0" selected>0 child</option>
            <option value="1">1 child</option>
            <option value="2">2 childs</option>
            <option value="3">3 childs</option>
            <option value="4">4 childs</option>
            <option value="5">5 childs</option>
            <option value="6">6 childs</option>
         </select>
      </div>
      <div class="box">
        <p>room type <span>*</span></p>
        <select name="room_type" class="input" required>
           <option value="basic room" selected>basic room</option>
           <option value="single room">single room</option>
           <option value="couple room">couple room</option>
        </select>
     </div>
   </div>
   <input type="submit" value="book now" name="book" class="btn">
</form>

</section>

<!-- reservation section ends -->
<!-- review section -->
<section class="review" id="review">
    <h1 class="heading">our most popular facilities loved by all</h1>
        <div class="review-slider">
    
            <div class="wrapper">
        <!-- 1st review -->
            <div class="box">            
                    <img src="img/feedback_1.png" alt="">       
                    <h3>harry cavil</h3>
                    <p class="job">journalist</p>
                    <p>Your hotel exceeded my expectations with exceptional service and luxurious amenities.</p>      
            </div>
        <!-- 2nd review -->
        <div class="box">   
               <img src="img/feedback_2.png" alt="">   
               <h3>kamala harris</h3>
               <p class="job">youtuber</p>
               <p>I was thoroughly impressed with the impeccable service and stunning accommodations provided by your hotel.</p>    
       </div>
       <!-- 3rd review -->
       <div class="box"> 
               <img src="img/feedback_3.png" alt="">
               <h3>marilyn monroe</h3>
               <p class="job">singer</p>
               <p>I had a wonderful stay at your hotel. The staff was incredibly helpful and the facilities were top-notch. Thank you for making my trip so enjoyable!</p>
       </div>
    </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- review section -->

    <!-- contact section -->
    <section class="contact" id="contact">
        <h1 class="heading">contact us</h1>
        <div class="row">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7949.442380205766!2d106.70215489873897!3d10.73447657370579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b2747a81a3%3A0x33c1813055acb613!2zxJDhuqFpIGjhu41jIFTDtG4gxJDhu6ljIFRo4bqvbmc!5e0!3m2!1svi!2s!4v1682186469316!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <form action="" method="post">
                <h3>get in touch</h3>

                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="name" placeholder="Name">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" name="number" placeholder="Number">
                </div>

                <input type="submit" value="contact now" name="send" class="btn">
            </form>
       </div>
    </section>
    <!-- contact section -->
    <script src="js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   
   
    <section class="footer">

	<div class="share">
			<a href="#" class="fab fa-facebook-f"></a>
			<a href="#" class="fab fa-twitter"></a>
			<a href="#" class="fab fa-chrome"></a>
			<a href="#" class="fab fa-linkedin"></a>
			<a href="#" class="fab fa-pinterest"></a>
	</div>

	<div class="links">
			<a href="home.php#home">home</a>
			<a href="home.php#about">about</a>
			<a href="home.php#room">catalogues</a>
			<a href="home.php#reservation">booking</a>
			<a href="home.php#contact">contact</a>
			<a href="home.php#user_login">login</a>
	</div>
	<div class="credit">
		created by 
		<span class="developer-info"> <a href="" class="mail">lenguyntuyetnhi@gmail.com</a></span> | Design by <a href="" class="mail">ngthtuana123@gmail.com</a> <br> <br>
		 <p class="orignal">+(68) 232 231 334 | 320/14 St. 7 District</p>
	</div>
</section>

    <?php
        include("component/contact.php");
    ?>

</body>
</html>