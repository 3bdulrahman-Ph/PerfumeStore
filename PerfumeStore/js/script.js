// تعريف المتغيرات أولاً
let userBox = document.querySelector('.header .flex .account-box');
let navbar = document.querySelector('.header .flex .navbar');

// حدث زر اليوزر
document.querySelector('#user-btn').onclick = () => {
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

// حدث زر المنيو
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

// عند التمرير، إخفاء كلا العنصرين
window.onscroll = () => {
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}

// تحديث تلقائي للheader كل 3 ثواني (تنبيه: سيؤدي ذلك إلى فقدان أحداث الجافاسكريبت)
// function updateHeader() {
//     fetch(window.location.href)
//         .then(response => response.text())
//         .then(data => {
//             const tempDiv = document.createElement('div');
//             tempDiv.innerHTML = data;
//             const newHeader = tempDiv.querySelector('header').innerHTML;
//             document.querySelector('header').innerHTML = newHeader;
//             // بعد تحديث الهيدر يجب إعادة ربط الأحداث (إذا استمر استخدام هذه الطريقة)
//             userBox = document.querySelector('.header .flex .account-box');
//             navbar = document.querySelector('.header .flex .navbar');
//         });
// }

// setInterval(updateHeader, 3000);
