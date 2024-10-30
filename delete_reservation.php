<?php 
    include "connect.php" ;

    try{
        $pdo->beginTransaction();
    
        $stmt = $pdo->prepare("DELETE FROM Post_Duration WHERE Duration_id=?");
        $stmt->bindParam(1, $_GET["Duration_id"]);
        $stmt->execute();

        $stmt2 = $pdo->prepare("DELETE FROM Reservation WHERE duration_id = ?"); //in database Reservation table
        $stmt2->bindParam(1, $_GET["Duration_id"]);
        $stmt2->execute();
        
        // Commit transaction
        $pdo->commit();
        // print_r($_POST);
        header("Location: dashboard.php");
        exit();
    }catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    ?>