<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation History</title>
</head>
<body>
    <?php 
        $query_res_his = $pdo->prepare("SELECT Reservation.national_id AS 'ID',Pre_name.Pre_name_desc AS 'คำนำหน้า',Users.firstname AS 'ชื่อ',Users.lastname AS 'นามสกุล',Reservation.reserve_date AS 'วัน',Reservation.reserve_time AS 'เวลา',Reservation.queue_no AS 'คิวที่' FROM Reservation INNER JOIN Users ON Reservation.national_id=Users.national_id INNER JOIN Pre_name ON Pre_name.Pre_name_id=Users.Pre_name_id WHERE Reservation.national_id = ? ORDER BY วัน ASC, 'เวลา' ASC , 'คิวที่' ASC;");
        $query_res_his->bindParam(1,$_GET["national_id"]);
        $query_res_his->execute();
        $row=$query_res_his->fetch();
    ?>
    <div class="title">แก้ไขประวัติการจอง</div>
    <form action="edit_history_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="national_id" value="<?=$row["ID"]?>" disabled>
        </div>
        <div class="form-group">
            <label>คำนำหน้า</label>
            <select id="Pre_name_selected" name="Pre_name_id">
                <option value="">เลือกคำนำหน้า</option>
                <?php 
                    $user_pre_name = $row["คำนำหน้า"];

                    $query_prename = $pdo->prepare("SELECT * FROM Pre_name");
                    $query_prename->execute();

                    while($option = $query_prename->fetch()){
                        $IsSelected_prename = ($user_pre_name == $option["Pre_name_id"]) ? 'selected' : '';
                        echo "<option value='". $option["Pre_name_id"] ."'". $IsSelected_prename .">". $option["Pre_name_desc"] ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>ชื่อ</label>
            <input type="text" name="firstname" pattern="[A-Za-zก-ฮ-๙]{2,50}" value="<?=$row["ชื่อ"]?>">
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input type="text" name="lastname" pattern="[A-Za-zก-๙]{2,50}" value="<?=$row["นามสกุล"]?>">
        </div>
        <div class="form-group">
            <label>วัน</label>
            <input type="date" name="reserve_date" value="<?=$row["วัน"]?>">
        </div>
        <div class="form-group">
            <label>เวลา</label>
            <input type="time" name="" value="<?=$row["เวลา"]?>">
        </div>
        <div class="form-group">
            <label>คิวที่</label>
            <input type="text" name="" value="<?=$row["คิวที่"]?>">
        </div>
    </form>
</body>
</html>