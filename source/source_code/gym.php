<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/gym.css">

    <title>Heaven Gym</title>

</head>
<body>
    <header class="header">
        <a href="#" class="logo">
            <img src="img/Logo_sub.png" alt="">
        </a>
            <a href="index.php#facilities" class="fas fa-angle-right" style="font-size: 30px; color: #223F49" id="right-btn"></a>
    </header>

    <section class="intro" id="intro">
        <div class="row">
            <h1 class="title1">gym</h1>
            <div class="image">
                <img src="img/gym_png/img_1.png" alt="">
            </div>
        </div>
    </section>


    <section class="box" id="des_box">
        <div class="content">
            <h2 class="title">Transform your body, uplift your soul - with our premier fitness services at the gym.</h2>
        </div>

        <div class="row">
            <div class="content">
                <h2 class="txt">Walking</h2>
                <p>Get your heart pumping and enjoy the beauty of nature on our top-notch running track, suitable for all levels of runners.</p>
                </div>
            <div class="image">
                <img src="img/gym_png/img_3.png" alt="">
            </div>
        </div>

        <div class="row">
            <div class="image">
                <img src="img/gym_png//img_4.png" alt="">
            </div>
            <div class="content">
                <h2 class="txt">Gym</h2>
                <p>Experience the ultimate fitness journey at our state-of-the-art gym, tailored to help you achieve your health and wellness goals.</p>
            </div>
        </div>

        <div class="row">
            <div class="content">
                <h2 class="txt">Yoga</h2>
                <p>Unwind and find inner peace in our serene yoga studio, designed to elevate your mind, body, and spirit.</p>
            </div>
            <div class="image">
                <img src="img/gym_png//img_5.png" alt="">
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