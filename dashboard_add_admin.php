<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin Information</title>
</head>
<body>
    <?php ?>
    <div class="title">เพิ่ม Admin</div>
    <form action="add_admin_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="national_id" placeholder="Admin-name" pattern="^Admin-\w{1,}$" required>
        </div>
        <div class="form-group">
            <label>คำนำหน้า</label>
            <select id="Pre_name_selected" name="Pre_name_id" required>
                <option value="">เลือกคำนำหน้า</option>
                <?php 
                    $query_prename = $pdo->prepare("SELECT * FROM Pre_name");
                    $query_prename->execute();

                    while($option = $query_prename->fetch()){
                        echo "<option value='". $option["Pre_name_id"] ."'>". $option["Pre_name_desc"] ."</option>";
                    }
                ?>
                            </select>
            </select>
        </div>
        <div class="form-group">
            <label>ชื่อ</label>
            <input type="text" name="firstname" pattern="[A-Za-zก-๙]{2,50}" required>
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input type="text" name="lastname" pattern="[A-Za-zก-๙]{2,50}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="Email" placeholder="example@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <div class="form-group">
            <label>เบอร์โทร</label>
            <input type="text" name="phone_num" maxlength="10" placeholder="0981234567" pattern="[0-9]{10}" required>
        </div>
        <div class="form-group">
            <label>วันเดือนปีเกิด</label>
            <input type="date" name="birthdate" required>
        </div>
        <div class="form-group">
            <label>รหัสผ่าน</label>
            <input type="password" name="passwd" maxlength="100" pattern="[A-Za-z0-9_]{8,100}" placeholder="กรอกอย่างน้อย 8 ตัว" required>
        </div>
        <div class="submit-btn"><input type="submit" value="เพิ่ม"></div>
    </form>
</body>
</html>