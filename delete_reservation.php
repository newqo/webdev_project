<?php include "connect.php";
        $stmt = $pdo->prepare("DELETE FROM Post_Duration WHERE Duration_id=?");
        $stmt->bindParam(1,$_GET["Duration_id"]);
        if($stmt->execute())
            header("location:dashboard.php");
    ?>