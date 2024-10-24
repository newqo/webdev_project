<?php include "connect.php";
        $stmt = $pdo->prepare("DELETE FROM Users WHERE national_id=?");
        $stmt->bindParam(1,$_GET["national_id"]);
        if($stmt->execute())
            header("location:dashboard.php");
    ?>