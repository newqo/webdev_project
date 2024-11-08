<?php
    include "connect.php";
    session_start();
?>
<!-- แก้ให้แล้วงับ front -->
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/9703a87d5d.js" crossorigin="anonymous"></script>
    <script src="javascript/login_ajax.js"></script>
</head>
<body>
    <div class="logo">
        <img src="imgs/logo_kmutnb_final.png">
        <h1>เข้าสู่ระบบ</h1>
        <div class="login-warning">
            <div id="result"></div>
        </div>
        <form action="login_validation.php" method="post">
            <input type="text" class="input-login-user" id="user_national_id" name="user_national_id" placeholder="เลขบัตรประชาชน" pattern="([A-Za-z0-9]{1,13}|Admin-[A-Za-z0-9]{1,})" maxlength="13" required><br>
            <input type="password" class="input-login-password" id="user_password" name="user_password" placeholder="รหัสผ่าน" pattern=".{8,100}" required><br>
            <button type="button" class="login-btn" onclick="login_validation()">เข้าสู่ระบบ</button><br>
        </form>
        <div class="register">
            ยังไม่มีสมาชิก ? <a href="register.php">สมัครสมาชิก</a>
        </div>
    </div>
</body>
</html>