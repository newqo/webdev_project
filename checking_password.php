<?php
    include 'connect.php';

    $stmt = $pdo->prepare("SELECT passwd FROM Users WHERE Users.national_id = ?");
    $stmt->bindParam(1,$_SESSION['national_id']);
    $stmt->execute();
    $user_pw = $stmt->fetch();

    $current_pw = $_GET['current'];
    $new_pw = $_GET['new'];
    $re_new_pw = $_GET['renew'];

    $incorrect = 'รหัสผ่านไม่ถูกต้อง';
    if($user_pw['passwd'] == $current_pw){
        if($new_pw == $re_new_pw){
            echo "successful";
        }else{
            echo $incorrect;
        }
    }else{
        echo $incorrect;
    }
?>