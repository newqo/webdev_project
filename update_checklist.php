<?php
    include "connect.php";

    $stmt = $pdo->prepare("UPDATE Checklist 
                SET scholarship_id=?, cost_of_living_id=? 
                WHERE checklist_id = ? AND national_id = ? AND duration_id = ?");
    $stmt->bindParam(1,$_POST["scholarship_selected"]);
    $stmt->bindParam(2,$_POST["cost_of_living_id"]);
    $stmt->bindParam(3,$_POST["checklist_id"]);
    $stmt->bindParam(4,$_POST["national_id"]);
    $stmt->bindParam(5,$_POST["this_term"]);

    if($stmt->execute()){
        header("location: checklist_edit.php");
        // print_r([
        //     $_POST["scholarship_selected"],
        //     $_POST["cost_of_living_id"],
        //     $_POST["checklist_id"],
        //     $_POST["national_id"],
        //     $_POST["this_term"]
        // ]);
    }
?>