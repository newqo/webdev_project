<?php
    include "connect.php";

    $faculty = $_GET["Faculty"];
    $ed_level = $_GET["ed_level"];
    $national_id = $_GET['nid'];

    $user = $pdo->prepare("SELECT Department_id FROM Education WHERE national_id = ?");
    $user->bindParam(1,$national_id);
    $user->execute();
    $user_data = $user->fetch();

    $major_selected = $user_data['Department_id'];

    if($faculty == "03" && $ed_level == 1)
    {
        $stmt = $pdo->prepare("SELECT Department_id , Department_name FROM Department WHERE Faculty_id = '". $faculty ."' AND Department_id = '0310'");
    }
    else{
        $stmt = $pdo->prepare("SELECT Department_id , Department_name  FROM Department WHERE Faculty_id LIKE '". $faculty ."%'");
    }
    $stmt->execute();

    // echo "<option value=''>เลือกสาขา</option>";

    while($row = $stmt->fetch()){
        $IsSelected_major= ($major_selected == $row['Department_id'] ? 'selected' : '');
        echo "<option value='". $row["Department_id"]  ."' ".$IsSelected_major.">". $row["Department_name"] ."</option>";
    }