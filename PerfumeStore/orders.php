<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>طلباتك</h3>
    <p> <a href="index.php">الرئيسية</a> / الطلب </p>
</section>

<section class="placed-orders">

    <h1 class="title">الطلبات الموضوعة</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> تم وضعه في : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> الاسم : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> رقم الجوال : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> البريد الالكتروني : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> تفاصيل التغليف : <span><?php echo $fetch_orders['description']; ?></span> </p>
        <p> طلباتك : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
        <p> السعر الإجمالي : <span><?php echo $fetch_orders['total_price']; ?> ر.ي</span> </p>
        <p> حالة الطلب : <span style="color:<?php if($fetch_orders['payment_status'] == 'قيد الانتظار'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">لم يتم وضع أي طلبات بعد!</p>';
    }
    ?>
    </div>

</section>







<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>