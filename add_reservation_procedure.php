<?php 
    include "connect.php";

        
    try {
        // Start a transaction
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO Post_Duration (Duration_id,Start_date,End_date,Checklist,Reservation,Event_status) VALUES (?,?,?,0,1,?)");

        $stmt->bindParam(1,$_POST["Duration_id"]);
        $stmt->bindParam(2,$_POST["Start_date"]);
        $stmt->bindParam(3,$_POST["End_date"]);
        $stmt->bindParam(4,$_POST["Event_status"]);
        
        $stmt->execute();

        // Commit transaction
        $pdo->commit();
        // print_r($_POST);
        header("Location: dashboard.php");
    } catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    ?>
