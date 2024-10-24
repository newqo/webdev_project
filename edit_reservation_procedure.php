<?php 
    include "connect.php" ;

    try{
        $pdo->beginTransaction();
    
        //update Users
        $stmt = $pdo->prepare("UPDATE Post_Duration SET Start_date=?, End_date=?, Event_status=? WHERE Duration_id=?");
        $stmt->bindParam(1, $_POST["Start_date"]);
        $stmt->bindParam(2, $_POST["End_date"]);
        $stmt->bindParam(3, $_POST["Event_status"]);
        $stmt->bindParam(4, $_POST["Duration_id"]);
    
        $stmt->execute();
        
        // Commit transaction
        $pdo->commit();
        // print_r($_POST);
        header("Location: dashboard.php");
    }catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    ?>