<?php
    include "connect.php";

    $nid = $_POST['user_id'];
    $pre_name_id = $_POST['user_nametitle'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_number'];
    $addr = $_POST['user_address'];


    $stmt = $pdo->prepare("UPDATE Users
                                SET Pre_name_id = ? , firstname = ? , lastname = ? , 
                                Email = ? , phone_num = ? , birthdate = ? , Address = ?
                                WHERE national_id = ? ");
    $stmt->bindParam(1,$pre_name_id);
    $stmt->bindParam(2,$firstname);
    $stmt->bindParam(3,$lastname);
    $stmt->bindParam(4,$email);
    $stmt->bindParam(5,$phone_num);
    $stmt->bindParam(6,$birthdate);
    $stmt->bindParam(7,$addr);
    $stmt->bindParam(8,$nid);
    
    if($stmt->execute()){
        header("location: edit_success_account.php");
    }    
?>