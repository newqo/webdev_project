<?php include "connect.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php  
    
    try{
        $pdo->beginTransaction();
    
        //update Users
        $stmt = $pdo->prepare("UPDATE Users SET Pre_name_id=?, firstname=?, lastname=?, Email=?, phone_num=?, birthdate=?, Address=?, user_cate_id=?,  WHERE national_id=?");
        $stmt->bindParam(1, $_POST["Pre_name_id"]);
        $stmt->bindParam(2, $_POST["firstname"]);
        $stmt->bindParam(3, $_POST["lastname"]);
        $stmt->bindParam(4, $_POST["Email"]);
        $stmt->bindParam(5, $_POST["phone_num"]);
        $stmt->bindParam(6, $_POST["birthdate"]);
        $stmt->bindParam(7, $_POST["Address"]);
        $stmt->bindParam(8, $_POST["user_cate_id"]);
        $stmt->bindParam(9, $_POST["national_id"]);
        $stmt->execute();

        $stmt2 = $pdo->prepare("UPDATE Edu SET Pre_name_id=? WHERE national_id=?")
        
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
</body>
</html>
