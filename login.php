<?php
    include "connect.php";
?>
<!-- แก้ให้แล้วงับ front -->
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/9703a87d5d.js" crossorigin="anonymous"></script>
    
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <div class="logo">
        <img src="imgs/Student_Loan_logo.svg">
        <h1>เข้าสู่ระบบ</h1>
        <form action="login_validation.php" method="post">
            <input type="text" class="input-login-user" id="user_stdID" name="user_stdID" placeholder="เลขบัตรประชาชน" pattern="[0-9]{13}" required><br>
            <input type="password" class="input-login-password" id="password" name="password" placeholder="รหัสผ่าน" pattern="\w{8,}" required><br>
            <button type="submit" class="login-btn">เข้าสู่ระบบ</button><br>
        </form>
        <div class="register">
            ยังไม่มีสมาชิก ? <a href="register.php">สมัครสมาชิก</a>
        </div>
    </div>
    
</body>
</html>