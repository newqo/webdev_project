<?php include "connect.php";
        $stmt = $pdo->prepare("DELETE FROM Reservation WHERE reservation_id=?");
        $stmt->bindParam(1,$_GET["reservation_id"]);
        if($stmt->execute())
            header("location:dashboard.php");
    ?>