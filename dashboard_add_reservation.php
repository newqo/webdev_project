<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>
</head>
<body>
    <?php ?>
    <div class="title">เพิ่มการจอง</div>
    <form action="" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="Duration_id" placeholder="R_NEW1/R_OLD1">
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