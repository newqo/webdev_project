<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Checklist</title>
</head>
<body>
    <?php 
        $query_chl = $pdo->prepare("SELECT Post_Duration.Duration_id AS 'ID',Post_Duration.Start_date AS 'วันเวลาเริ่มต้น',Post_Duration.End_date AS 'วันเวลาสิ้นสุด',Post_Duration.Event_status AS 'Status' FROM Post_Duration WHERE Post_Duration.Duration_id LIKE 'C%' AND Duration_id = ?");
        $query_chl->bindParam(1,$_GET["Duration_id"]);
        $query_chl->execute();
        $row=$query_chl->fetch();
       
    ?>
    <div class="title">แก้ไข Checklist</div>
    <form action="edit_checklist_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="Duration_id" value="<?=$row["ID"]?>" disabled>
        </div>
        <div class="form-group">
            <label>วันเวลาเริ่มต้น</label>
            <input type="datetime-local" name="Start_date" value="<?=$row["วันเวลาเริ่มต้น"]?>" required >
        </div>
        <div class="form-group">
            <label>วันเวลาสิ้นสุด</label>
            <input type="datetime-local" name="End_date" value="<?=$row["วันเวลาสิ้นสุด"]?>" required >
        </div>
        <?php 
            $status_selected = $row["Status"];
        ?>
        <div class="form-group">
            <label>Status</label>
            <input type="radio" name="Event_status" id="status_close"value="0"
            <?php echo ($status_selected == 0) ? 'checked' : '' ?> required/>
            <label for="status_close">ปิด</label>
            <input type="radio" name="Event_status" id="status_open"value="1"
            <?php echo ($status_selected == 1) ? 'checked' : '' ?> required/>
            <label for="status_open">เปิด</label>
        </div>
        <div class="submit-btn"><input type="submit" value="แก้ไข"></div>
    </form>
</body>
</html>