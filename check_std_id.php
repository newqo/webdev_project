<?php
    include "connect.php";

    $stmt = $pdo->prepare("SELECT COUNT(std_ID) AS 'found' FROM Education WHERE std_ID = ?");
    $stmt->bindParam(1,$_GET["std"]);
    $stmt->execute();
    $found = $stmt->fetch();

    if($found['found'] == 0){
        echo "notify-hide";
    }else{
        echo "notify-show";
    }