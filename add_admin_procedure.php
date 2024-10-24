<?php 
    include "connect.php";

        
    try {
        // Start a transaction
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO Users (national_id,pre_name_id,firstname,lastname,Email,phone_num,birthdate,user_role,user_cate_id,passwd) VALUES (?,?,?,?,?,?,?,1,0,?)");

        $stmt->bindParam(1,$_POST["national_id"]);
        $stmt->bindParam(2,$_POST["pre_name_id"]);
        $stmt->bindParam(3,$_POST["firstname"]);
        $stmt->bindParam(4,$_POST["lastname"]);
        $stmt->bindParam(5,$_POST["Email"]);
        $stmt->bindParam(6,$_POST["phone_num"]);
        $stmt->bindParam(7,$_POST["birthdate"]);
        $stmt->bindParam(8,$_POST["passwd"]);
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
