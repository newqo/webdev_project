<?php
    include "connect.php";

    $faculty = $_GET["Faculty"];
    $ed_level = $_GET["ed_level"];

    if($faculty == "03" && $ed_level == 1)
    {
        $stmt = $pdo->prepare("SELECT Department_id , Department_name FROM Department WHERE Faculty_id = '". $faculty ."' AND Department_id = '0310'");
    }
    else{
        $stmt = $pdo->prepare("SELECT Department_id , Department_name  FROM Department WHERE Faculty_id LIKE '". $faculty ."%'");
    }
    $stmt->execute();

    echo "<option value=''>เลือกสาขา</option>";

    while($row = $stmt->fetch()){
        echo "<option value='". $row["Department_id"]  ."'>". $row["Department_name"] ."</option>";
    }