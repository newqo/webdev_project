<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Checklist</title>
</head>
<body>
    <div class="title">เพิ่ม Checklist</div>
    <form action="add_checklist_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="Duration_id">
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
            <input type="radio" name="Event_status" id="status_close"value="0"><label for="status_close">ปิด</label>
            <input type="radio" name="Event_status" id="status_open"value="1"><label for="status_open">เปิด</label>
        </div>
        <div class="submit-btn"><input type="submit" value="เพิ่ม"></div>
    </form>
</body>
</html>