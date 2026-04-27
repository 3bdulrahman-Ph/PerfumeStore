<?php
@include 'config.php';
session_start();

// تهيئة مصفوفة الرسائل إذا لم تكن موجودة
if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = [];
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// معالجة إضافة إلى قائمة الرغبات
if (isset($_POST['add_to_wishlist'])) {
    if (!$user_id) {
        $_SESSION['message'][] = 'Please login to add products to your wishlist.';
    } else {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);

        $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'");
        $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");

        if (mysqli_num_rows($check_wishlist) > 0) {
            $_SESSION['message'][] = 'Product already in wishlist.';
        } elseif (mysqli_num_rows($check_cart) > 0) {
            $_SESSION['message'][] = 'Product already in cart.';
        } else {
            mysqli_query($conn, "INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
            $_SESSION['message'][] = 'Product added to wishlist.';
        }
    }
}

// معالجة إضافة إلى العربة
if (isset($_POST['add_to_cart'])) {
    if (!$user_id) {
        $_SESSION['message'][] = 'Please login to add products to your cart.';
    } else {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
        $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

        $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
        
        if (mysqli_num_rows($check_cart) > 0) {
            $_SESSION['message'][] = 'Product already in cart.';
        } else {
            // حذف من قائمة الرغبات إذا موجود
            $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'");
            if (mysqli_num_rows($check_wishlist) > 0) {
                mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'");
            }
            
            mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
            $_SESSION['message'][] = 'Product added to cart.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php
if (!empty($_SESSION['message'])) {
    foreach ($_SESSION['message'] as $msg) {
        echo '<div class="message">
                <span>'.$msg.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
              </div>';
    }
    unset($_SESSION['message']);
}
?>
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>our shop</h3>
    <p> <a href="index.php">home</a> / shop </p>
</section>


<section class="products">
   <h1 class="title">latest products</h1>
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">YE <?php echo $fetch_products['price']; ?></div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
   </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>