<?php
    include "connect.php";
    session_start();

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE national_id = ? AND passwd = ?");
    $stmt->bindParam(1, $_POST["user_national_id"]);
    $stmt->bindParam(2, $_POST["user_password"]);
    $stmt->execute();
    $row = $stmt->fetch();

    // ถ้ามีข้อมูล user
    if(!empty($row)){
        $_SESSION["national_id"] = $row["national_id"];
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["lastname"] = $row["lastname"];   
        $_SESSION["user_category"] = $row["user_cate_id"];
        $_SESSION["role"] = $row["user_role"];
        // echo "successful";
        header("location: homepage.php");
    }
    else{ //ถ้าไม่มีข้อมูล user ให้แจ้งเตือนว่่า login ไม่สำเร็จ 
        echo "เลขบัตรประชาชนหรือรหัสผ่านไม่ถูกต้อง";            
    }