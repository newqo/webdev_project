<?php 
    include "connect.php" ;

    try{
        $pdo->beginTransaction();
    
        $stmt = $pdo->prepare("DELETE FROM Users WHERE national_id=?");
        $stmt->bindParam(1, $_GET["national_id"]);
        $stmt->execute();

        $stmt2 = $pdo->prepare("DELETE FROM Education WHERE national_id = ?");
        $stmt2->bindParam(1, $_GET["national_id"]);
        $stmt2->execute();

        $stmt3 = $pdo->prepare("DELETE FROM Checklist WHERE national_id = ?");
        $stmt3->bindParam(1, $_GET["national_id"]);
        $stmt3->execute();

        $stmt4 = $pdo->prepare("DELETE FROM Reservation WHERE national_id = ?");
        $stmt4->bindParam(1, $_GET["national_id"]);
        $stmt4->execute();

        $stmt5 = $pdo->prepare("DELETE FROM User_Relationship WHERE national_id = ?");
        $stmt5->bindParam(1, $_GET["national_id"]);
        $stmt5->execute();

        $stmt6 = $pdo->prepare("DELETE FROM Parent WHERE parent_id = (SELECT parent_id From User_Relationship WHERE national_id = ?)");
        $stmt6->bindParam(1, $_GET["national_id"]);
        $stmt6->execute();
        
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