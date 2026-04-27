<?php
// إضافة session_start() في الأعلى
session_start();
$_SESSION['lang'] = 'ar';
@include 'config.php';

// تحديث عدد العناصر مباشرة من قاعدة البيانات
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // تحديث عدد الأمنيات
    $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'");
    $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
    $_SESSION['wishlist_count'] = $wishlist_num_rows;
    
    // تحديث عدد العربة
    $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
    $cart_num_rows = mysqli_num_rows($select_cart_count);
    $_SESSION['cart_count'] = $cart_num_rows;
}
?>
<?php
// عرض الرسائل في أعلى الصفحة
if (isset($message) && is_array($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

?>
<?php
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    foreach ($_SESSION['message'] as $msg) {
        echo '<div class="message">
                <span>' . $msg . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
    }
    // حذف الرسائل بعد عرضها
    $_SESSION['message'] = [];
}
?>

<script>
// أضف هذا الكود في نهاية قسم الرسائل
document.addEventListener('DOMContentLoaded', function() {
    // تحديد جميع عناصر الرسائل
    let messages = document.querySelectorAll('.message');
    
    // إخفاء كل رسالة بعد 5 ثواني
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 500); // تأثير التلاشي
        }, 5000);
    });
});
</script>

<style>
/* إضافة تأثير انتقالي */
.message {
    transition: all 0.3s ease-in-out;
}
</style>

<header class="header">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');
</style>

    <div class="flex">


    <div class="logo-container">
         <img src="images/logo.png" alt="Logo" class="logo-img">
         <a href="index.php" class="logo">May</a>
      </div>
        <!-- <a href="index.php" class="logo">flowers.</a> -->

        <nav class="navbar">
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <!-- <li><a href="#">الصفحات +</a>
                    <ul>
                        <li><a href="contact.php">التواصل</a></li>
                    </ul>
                </li> -->
                <!-- <li><a href="shop.php">shop</a></li> -->
                <li><a href="orders.php">الطلبات</a></li>
                <li><a href="about.php">عننا</a></li>
            </ul>
        </nav>

        <div class="icons">
    <!-- أيقونة القائمة -->
    <div id="menu-btn" class="fas fa-bars"></div>

    <!-- أيقونة المستخدم -->
    <div id="user-btn" class="fas fa-user"></div>

    <div class="account-box">
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>اسم المستخدم : <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>البريد الالكتروني : <span><?php echo $_SESSION['user_email']; ?></span></p>
        <a href="logout.php" class="delete-btn">تسجيل الخروج</a>
    <?php else: ?>
        <p>يرجى تسجيل الدخول لمتابعة التسوق!</p>
        <div class="btn-box">
            <a href="login.php" class="option-btn">تسجيل الدخول</a>
            <a href="register.php" class="option-btn">إنشاء حساب</a>
        </div>
    <?php endif; ?>
</div>

    <!-- أيقونة قائمة الأمنيات -->
    <div class="icon-wrapper">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="wishlist.php">
                <i class="fas fa-heart"></i>
                <span class="count-badge"><?= $_SESSION['wishlist_count'] ?? 0 ?></span>
            </a>
        <?php else: ?>
            <a href="#" onclick="alert('الرجاء تسجيل الدخول لعرض قائمة الأمنيات');">
                <i class="fas fa-heart"></i>
            </a>
        <?php endif; ?>
    </div>

    <!-- أيقونة عربة التسوق -->
    <div class="icon-wrapper">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="count-badge"><?= $_SESSION['cart_count'] ?? 0 ?></span>
            </a>
        <?php else: ?>
            <a href="#" onclick="alert('الرجاء تسجيل الدخول لعرض عربة التسوق');">
                <i class="fas fa-shopping-cart"></i>
            </a>
        <?php endif; ?>
    </div>
</div>


    </div>
</header>




