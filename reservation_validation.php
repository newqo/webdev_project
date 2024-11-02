<?php
    include "connect.php";

    $date = $_POST["reservation_date"];
    $round = $_POST["selected_reservation_round"];
    $checklist_id = $_POST["checklist_id"];
    $national_id = $_POST["national_id"];
    $duration_id = $_POST["reservation_duration_id"];

    $q = $pdo->prepare("SELECT COUNT(reservation_id) AS 'queue_amount' FROM Reservation WHERE reserve_date = ? AND reserve_time = ?");
    $q->bindParam(1,$date);
    $q->bindParam(2,$round);
    $q->execute();
    $queue = $q->fetch();

    $queue_no = $queue['queue_amount'] + 1;

    // echo "Date: " . $date . "\n" .
    //     "Round: " . $round . "\n" .
    //     "Queue Number: " . $queue_no . "\n" .
    //     "Checklist ID: " . $checklist_id . "\n" .
    //     "National ID: " . $national_id . "\n" .
    //     "Duration ID: " . $duration_id . "\n";

    $stmt = $pdo->prepare("INSERT INTO Reservation (reserve_date, reserve_time, queue_no, checklist_id, national_id, duration_id)
                VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1,$date);
    $stmt->bindParam(2,$round);
    $stmt->bindParam(3,$queue_no);
    $stmt->bindParam(4,$checklist_id);
    $stmt->bindParam(5,$national_id);
    $stmt->bindParam(6,$duration_id);

    if($stmt->execute()){
        header("location: reservation-notification.php");
    }
