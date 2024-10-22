<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
</head>
<body>
    <?php 
        $query_res = $pdo->prepare("SELECT Post_Duration.Duration_id AS 'ID',Post_Duration.Start_date AS 'วันเวลาเริ่มต้น',Post_Duration.End_date AS 'วันเวลาสิ้นสุด',Post_Duration.Event_status AS 'Status' FROM Post_Duration WHERE Post_Duration.Duration_id LIKE 'C%' AND Duration_id = ?;");
        $query_res->bindParam(1,$_GET["Duration_id"]);
        $query_res->execute();
        $row=$query_res->fetch();
    ?>
    <div class="title">แก้ไขการจอง</div>
    <form action="" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="Duration_id" placeholder="R_NEW1/R_OLD1" value="<?=$row["ID"]?>"disabled>
        </div>
        <div class="form-group">
            <label>วันเวลาเริ่มต้น</label>
            <input type="datetime-local" name="Start_date">
        </div>
        <div class="form-group">
            <label>วันเวลาสิ้นสุด</label>
            <input type="datetime-local" name="End_date">
        </div>
        <div class="form-group">
            <label>Status</label>
            <input type="number" name="Event_status" min="0" max="1">
        </div>
    </form>
</body>
</html>