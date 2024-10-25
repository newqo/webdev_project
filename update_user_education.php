<?php
    include "connect.php";

    $ed_level_id = $_POST['user_year'];
    $fac_id = $_POST['faculty'];
    $dep_id = $_POST['major'];
    $stdID = $_POST['user_stdID'];

    $stmt = $pdo->prepare("UPDATE Education
                                SET Faculty_id = ? , Department_id = ? , Education_Level = ?
                                WHERE std_ID = ? ");
    $stmt->bindParam(1,$fac_id);
    $stmt->bindParam(2,$dep_id);
    $stmt->bindParam(3,$ed_level_id);
    $stmt->bindParam(4,$stdID);

    if($stmt->execute()){
        header("location: successful.php");
    }
?>