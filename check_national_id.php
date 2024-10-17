<?php
    include "connect.php";
    
    $stmt = $pdo->prepare("SELECT COUNT(national_id) AS 'found' FROM Users WHERE national_id = ? ");
    $stmt->bindParam(1,$_GET["national_id"]);
    $stmt->execute();
    $found = $stmt->fetch();

    if($found['found']== 0){
        echo "notify-hide";
    }else{
        echo "notify-show";
    }