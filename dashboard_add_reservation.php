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
    <form action="add_reservation_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="Duration_id" placeholder="R_NEW1/R_OLD1"pattern="(^R_NEW\d{1,}|^R_OLD\d{1,})" required>
        </div>
        <div class="form-group">
            <label>วันเวลาเริ่มต้น</label>
            <input type="datetime-local" name="Start_date" required>
        </div>
        <div class="form-group">
            <label>วันเวลาสิ้นสุด</label>
            <input type="datetime-local" name="End_date" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <input type="radio" name="Event_status" id="status_close"value="0"><label for="status_close">ปิด</label>
            <input type="radio" name="Event_status" id="status_open"value="1"><label for="status_open">เปิด</label>
        </div>
        <div class="submit-btn"><input type="submit" value="เพิ่ม"></div>
    </form>
</body>
</html>