<?php
  include "connect.php";
  
//   session_start();

//   $stmt = $pdo->prepare("SELECT * FROM Users WHERE national_id = ? AND passwd = ?");
//   $stmt->bindParam(1, $_POST["national_id"]);
//   $stmt->bindParam(2, $_POST["passwd"]);
//   $stmt->execute();
//   $row = $stmt->fetch();

//   // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
//   if (!empty($row)) { 
//     // นำข้อมูลผู้ใช้จากฐานข้อมูลเขียนลง session 2 ค่า
//     $_SESSION["fullname"] = $row["name"];   
//     $_SESSION["username"] = $row["username"];
//     $_SESSION["admin"] = $row["admin"]

//     // แสดง link เพื่อไปยังหน้าต่อไปหลังจากตรวจสอบสำเร็จแล้ว
//     echo "เข้าสู่ระบบสำเร็จ<br>";
//     echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช้</a>"; 

//   // กรณี username และ password ไม่ตรงกัน
//   } else {
//     echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
//     echo "<a href='login-form.php'>เข้าสู่ระบบอีกครัง</a>"; 
//   }
// ?>
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
        <input type="text" class="input-login-user" id="user_stdID" name="user_stdID" placeholder="เลขบัตรประชาชน" pattern="[0-9]{13}" required><br>
        <input type="password" class="input-login-password" id="password" name="password" placeholder="รหัสผ่าน" pattern="\w{8,}" required><br>
        <button type="submit" class="login-btn">เข้าสู่ระบบ</button><br>
        <div class="register">
            ยังไม่มีสมาชิก ? <a href="register.php">สมัครสมาชิก</a>
        </div>
    </div>

    
</body>
</html>