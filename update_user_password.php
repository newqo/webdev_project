<?php
    include 'connect.php';
    
    $current_pw = $_POST['password'];
    $new_pw = $_POST['new_password'];
    $re_new_pw = $_POST['re_new_password'];
    $nid = $_POST['nid'];

    $stmt = $pdo->prepare("SELECT passwd FROM Users WHERE Users.national_id = ?");
    $stmt->bindParam(1,$nid);
    $stmt->execute();
    $user_pw = $stmt->fetch();

    if($user_pw['passwd'] == $current_pw){
        if($new_pw == $re_new_pw){
            $changing = $pdo->prepare("UPDATE Users SET passwd = ? WHERE national_id = ?");
            $changing->bindParam(1,$new_pw);
            $changing->bindParam(2,$nid);
            if($changing->execute()){
                header("Location: successful.php?status=success"); // เมื่อรหัสผ่านใหม่ถูกต้อง
            }
        }else{
            header("Location: notmatch.php?status=notmatch"); // เมื่อรหัสผ่านใหม่ไม่ตรงกัน
        }
    }else{
        header("Location: incorrect.php?status=incorrect"); // เมื่อรหัสผ่านปัจจุบันไม่ถูกต้อง
    }
?>