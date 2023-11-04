<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/res.css">

    <title>Heaven Restaurant</title>
</head>
<body>
    <!-- header section -->
    <header class="header">
        <a href="#" class="logo">
            <img src="img/Logo_sub.png" alt="">
        </a>
            <a href="index.php#facilities" class="fas fa-angle-right" style="font-size: 30px; color: #223F49" id="right-btn"></a>
    </header>
    <!-- header section -->

    <!-- intro section -->
    <section class="intro" id="intro">
        <div class="row">
            <h1 class="title1">restaurant</h1>
            <div class="image">
                <img src="img/restaurant_png/img_1.png" alt="">
            </div>
        </div>
    </section>
    <!-- intro section -->

    <section class="box" id="our_sweet">
        <div class="row">
            <div class="content">
                <h3>our sweet</h3>
                <p>Indulge in our delectable sweet treats, perfect for satisfying your cravings and adding a touch of sweetness to your day.</p>
            </div>
            <div class="image">
                <img src="img/restaurant_png/img_2.png" alt="">
            </div>
        </div>

    </section>

    <!-- text box -->
    <section class="txt_box" id="txt_box">
        <div class="row">
            <div class="content">
                <h3>“ Tasty food, set inside  a lovely  coffee house .“</h3>
                <p>At my bakery, we pride ourselves on using only the highest quality ingredients and crafting each sweet treat with care and attention to detail, ensuring that every bite is a moment of pure indulgence.</p>
                <h4>Dominique Ansel.</h4>
            </div>
        </div>
    </section>
    <!-- text box -->

    <!-- description section -->
    <section class="box">
        <div class="row">
            <div class="content">
                <h2 class="txt">Tasty Breakfast</h2>
                <p>Start your day off right with our delicious and satisfying breakfast offerings, featuring a variety of fresh and flavorful options to suit every taste.</p>     
            </div>
            <div class="image">
                <img src="img/restaurant_png/img_3.png" alt="">
            </div>
        </div>

        <div class="row">
            <div class="image">
                <img src="img/restaurant_png/img_4.png" alt="">
            </div>
            <div class="content">
                <h2 class="txt">Asian Food</h2>
                <p>Experience the vibrant flavors of Asia with our authentic and delicious Asian cuisine, featuring a range of dishes inspired by the region's rich culinary traditions.</p>
            </div>
        </div>

        <div class="row">
            <div class="content">
                <h2 class="txt">Fresh Coffee</h2>
                <p>Indulge in a perfectly crafted cup of coffee at our hotel, where our skilled baristas use only the finest beans and brewing techniques to ensure a rich and satisfying coffee experience.</p>   
            </div>
            <div class="image">
                <img src="img/restaurant_png/img_5.png" alt="">
            </div>
        </div>
    </section>
    <!-- description section -->

    <?php
    include("component/footer.php");
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php
        include("component/contact.php");
    ?>


</body>
</html>