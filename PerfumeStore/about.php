<?php
@include 'config.php';
session_start();

// الحصول على user_id إذا كان موجودًا في الجلسة
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>عننا</h3>
    <p> <a href="index.php">الرئيسية</a> / عننا </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about1.jpg" alt="">
        </div>

        <div class="content" dir="rtl">
    <h3>ماذا نقدم؟</h3>
    <p>نحن في MAY نقدم عطورًا فاخرة تعكس شخصيتكِ الفريدة، مع مزيج من الجودة الممتازة والتصميم الأنيق، لتمنحكِ تجربة عطرية استثنائية تعكس أسلوبكِ وثقتكِ.</p>
    
</div>

    </div>

    <div class="flex">

    <div class="content">
    <h3>من نحن؟</h3>
    <p>• نحن MAY، علامة تجارية متخصصة في تقديم العطور الفاخرة بأسعار معقولة. نحن نؤمن أن كل امرأة تستحق عطرًا يعكس شخصيتها الفريدة، ولهذا السبب ندمج الجودة الممتازة مع التصميم الأنيق.</p>

    <p>• هدفنا هو أن نقدم لك تجربة عطر استثنائية تمزج بين الفخامة واللمسة الشخصية—لأن عطرك ليس مجرد رائحة، بل هو قصة تُحكى.</p>
    <a href="index.php" class="btn">تسوق الآن</a>

</div>

        <div class="image">
            <img src="images/about2.jpg" alt="">
        </div>

    </div>


</section>

<!-- <section class="reviews" id="reviews">

    <h1 class="title">client's reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

    </div>

</section> -->

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>