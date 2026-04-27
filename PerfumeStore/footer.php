<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>روابط سريعة</h3>
            <a href="index.php">الرئيسية</a>
            <a href="about.php">عننا</a>
            <!-- <a href="contact.php">تواصل معنا</a> -->
            <!-- <a href="shop.php">shop</a> -->
        </div>

        <div class="box">
            <h3>روابط إضافية</h3>
            <a href="orders.php">طلباتي</a>
            <a href="cart.php">عربتي</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="login.php">تسجيل الدخول</a>
                <a href="register.php">إنشاء حساب</a>
            <?php else: ?>
                <a href="logout.php">تسجيل الخروج</a>
            <?php endif; ?>
        </div>

        <div class="box">
            <h3>معلومات التواصل</h3>
            <p> <i class="fas fa-phone"></i> 782861053 967+ </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> example@domain.com </p>

        </div>

        <div class="box">
            <h3>تابعنا</h3>
            <a href="https://www.instagram.com/mayofficial.u?igsh=a29yOTJqcjJ1b2Nw"><i class="fab fa-instagram"></i> instagram</a>
        </div>
    </div>

    <div class="credit">&copy; copyright @ <?php echo date('Y'); ?> by <span>May</span></div>
</section>