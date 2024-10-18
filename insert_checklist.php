<?php
    include "connect.php";
    session_start();

    $stmt = $pdo->prepare("INSERT INTO Checklist (national_id, scholarship_id, cost_of_living_id,duration_id)
                VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1,$_SESSION["national_id"]);
    $stmt->bindParam(2,$_POST["scholarship_selected"]);
    $stmt->bindParam(3,$_POST["cost_of_living_id"]);
    $stmt->bindParam(4,$_POST["this_term"]);

    $stmt->execute();