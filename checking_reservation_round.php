<?php

    include "connect.php";

    $date = $_GET["reservation_date"];
    $round = $_GET["round"];

    $stmt = $pdo->prepare("SELECT COUNT(reservation_id) AS 'amount' FROM Reservation 
                    WHERE reserve_date = ? AND reserve_time = ?");
    $stmt->bindParam(1,$date);
    $stmt->bindParam(2,$round);

    $stmt->execute();
    $amount = $stmt->fetch();

    if($amount['amount'] >= 5){
        echo "full";
    }
    else{
        echo "enough";
    }
