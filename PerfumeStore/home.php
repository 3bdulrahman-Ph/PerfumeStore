<?php
@include 'config.php';
session_start();


if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = [];
}

if (isset($_POST['add_to_wishlist']) || isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        if (!in_array('.يرجى تسجيل الدخول أو إنشاء حساب للمتابعة', $_SESSION['message'])) {
            $_SESSION['message'][] = '.يرجى تسجيل الدخول أو إنشاء حساب للمتابعة';
        }
    } else {
        $user_id = $_SESSION['user_id'];
    }
}

if (isset($_POST['add_to_wishlist']) && isset($user_id)) {
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    
    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        if (!in_array('المنتج موجود بالفعل في قائمة الأمنيات الخاصة بك.', $_SESSION['message'])) {
            $_SESSION['message'][] = 'المنتج موجود بالفعل في قائمة الأمنيات الخاصة بك.';
        }
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        if (!in_array('المنتج موجود بالفعل في سلتك.', $_SESSION['message'])) {
            $_SESSION['message'][] = 'المنتج موجود بالفعل في سلتك.';
        }
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $_SESSION['message'][] = 'تمت إضافة المنتج إلى قائمة الأمنيات الخاصة بك.';
        
        // تحديث عدد الأمنيات في الجلسة
        $_SESSION['wishlist_count'] = mysqli_num_rows(mysqli_query($conn, 
        "SELECT * FROM `wishlist` WHERE user_id = '$user_id'"));
    }
}

if (isset($_POST['add_to_cart']) && isset($user_id)) {
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        if (!in_array('المنتج موجود بالفعل في سلتك.', $_SESSION['message'])) {
            $_SESSION['message'][] = 'المنتج موجود بالفعل في سلتك.';
        }
    } else {
        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        
        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }
        
        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $_SESSION['message'][] = 'تمت إضافة المنتج إلى سلتك.';
        
        // تحديث عدد العربة في الجلسة
        $_SESSION['cart_count'] = mysqli_num_rows(mysqli_query($conn, 
            "SELECT * FROM `cart` WHERE user_id = '$user_id'"));
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    foreach ($_SESSION['message'] as $msg) {
        echo '<div class="message">
        <span>' . $msg . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
    }
    $_SESSION['message'] = [];
}
@include 'header.php';
?>

<section class="index">
   <div class="content">
      <h3>اكتشف مجموعتنا الجديدة!</h3>
      <p>تصاميم أنيقة، وروائح آسرة، ومكونات فاخرة تجسد الأنوثة والتميّز. دعي عطرك يعكس شخصيتك مع أحدث إصداراتنا الحصرية.</p>
      <a href="about.php" class="btn">اكتشف المزيد</a>
   </div>
</section>

<section class="products">
   <h1 class="title">أحدث المنتجات</h1>
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="fas fa-eye"></a>
         <div class="price"><?= $fetch_products['price'] ?> ر.ي</div>
         <img src="uploaded_img/<?= $fetch_products['image'] ?>" alt="" class="image">
         <div class="name"><?= $fetch_products['name'] ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
         <input type="hidden" name="product_name" value="<?= $fetch_products['name'] ?>">
         <input type="hidden" name="product_price" value="<?= $fetch_products['price'] ?>">
         <input type="hidden" name="product_image" value="<?= $fetch_products['image'] ?>">
         <input type="submit" value="أضف إلى قائمة الأمنيات" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="أضف إلى السلة" name="add_to_cart" class="btn">
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">!لم يتم إضافة أي منتجات بعد</p>';
         }
      ?>
   </div>
   <!-- <div class="more-btn">
      <a href="shop.php" class="option-btn">load more</a>
   </div> -->
</section>

<!-- <section class="index-contact">
   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio officia aliquam quis saepe? Quia, libero.</p>
      <a href="contact.php" class="btn">contact us</a>
   </div>
</section> -->

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>