<?php
    include "connect.php";

    $ed_level = $_GET["ed_level"];
    $national_id = $_GET["nid"];

    $user = $pdo->prepare("SELECT Faculty_id FROM Education WHERE national_id = ?");
    $user->bindParam(1,$national_id);
    $user->execute();
    $user_data = $user->fetch();

    $faculty_selected = $user_data['Faculty_id'];
    

    if ($ed_level == 1){ // ปวช
        $stmt = $pdo->prepare("SELECT * FROM Faculty WHERE Faculty_id = '03'");
    }
    else if ($ed_level == 2){ // ป ตรี
        $stmt = $pdo->prepare("SELECT * FROM Faculty WHERE Faculty_id IN ('01','02','03','04','11','15','16','07')");
    }
    else{ // ป โท
        $stmt = $pdo->prepare("SELECT *  FROM Faculty WHERE Faculty_id IN ('01','03','04','07')");
    }

    $stmt->execute();
    // echo "<option value=''>เลือกคณะ</option>";
    while($row = $stmt->fetch()){
        $IsSelected_faculty = ($faculty_selected == $row['Faculty_id'] ? 'selected' : '');
        echo "<option value='". $row["Faculty_id"]  ."' ".$IsSelected_faculty.">". $row["Faculty_name"] ."</option>";
    }
