<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/pool.css">

    <title>Heaven Pool</title>

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
    <section class="title">
        <h1 class="title">Pool</h1>
    </section>
    <section class="intro" id="intro">
        <div class="row">
            <!-- <div class="image">
                <img src="images/PGN_web/pool_png/img_1.png" alt="">
            </div> -->
            <div class="content">
                <h2>heaven's <p>pool</p></h2>
            </div>
        </div>
    </section>
    <!-- intro section -->


    <!-- description -->
    <section class="box1">
        <div class="content">
            <h2> Relax and unwind in our refreshing pool oasis</h2>
        </div>
        <div class="image">
            <img src="img/pool_png/img_3.png" alt="">
        </div>
     </section>

     <section class="box2" id="box2">
        <div class="row">
            <div class="content">
                <h2 class="title2">home pool</h2>
                <p> Introducing our brand new 50-tub pool, perfect for swimming enthusiasts seeking a refreshing and invigorating experience in a luxurious setting.</p>
            </div>
            <div class="image">
                <img src="img/pool_png/img_4.png" alt="">
            </div>
        </div>
    </section>
    <!-- description -->

    <?php
    include("component/footer.php");
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php
        include("component/contact.php");
        ?>
</body>
</html>