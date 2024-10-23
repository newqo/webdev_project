<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User information</title>
</head>
<body>
    <?php 
        $query_user = $pdo->prepare("SELECT User_category.category_desc AS 'ประเภทผู้กู้',Users.national_id AS 'ID' , Pre_name.Pre_name_desc AS 'คำนำหน้า' ,Users.firstname AS 'ชื่อ',Users.lastname AS 'นามสกุล',Education_Level_Category.ed_desc AS 'ชั้นปี',Faculty.Faculty_name AS 'คณะ',Department.Department_name AS 'สาขา',Users.Email AS 'อีเมลล์',Users.phone_num AS 'เบอร์โทรศัพท์',Users.birthdate AS 'วันเดือนปีเกิด',Users.Address AS 'ที่อยู่' FROM Users INNER JOIN Pre_name ON Users.Pre_name_id=Pre_name.Pre_name_id INNER JOIN User_category ON Users.user_cate_id=User_category.user_cate_id INNER JOIN Education ON Users.national_id=Education.national_id INNER JOIN Education_Level_Category ON Education.Education_Level=Education_Level_Category.ed_category_id INNER JOIN Faculty ON Education.Faculty_id=Faculty.Faculty_id INNER JOIN Department ON Department.Department_id=Education.Department_id WHERE Users.national_id = ? ");
        $query_user->bindParam(1,$_GET["national_id"]);
        $query_user->execute();
        $row = $query_user->fetch();
    ?>
    <div class="title">แก้ไขข้อมูลผู้กู้</div>
    <form action="edit_user_procedure.php" method="post">
        <div class="form-group">
            <label>ประเภทผู้กู้</label>
            <input type="text" name="category_desc" value="<?=$row["ประเภทผู้กู้"]?>" required>
        </div>
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="national_id" value="<?=$row["ID"]?>" disabled>
        </div>
        <div class="form-group">
            <label>คำนำหน้า</label>
            <select id="Pre_name_selected" name="Pre_name_id" required>
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
            <input type="text" name="firstname" pattern="[A-Za-zก-ฮ-๙]{2,50}" value="<?=$row["ชื่อ"]?>" required>
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input type="text" name="lastname" pattern="[A-Za-zก-๙]{2,50}" value="<?=$row["นามสกุล"]?>" required>
        </div>
        <div class="form-group">
            <label>ชั้นปี</label>
            <input type="date" name="reserve_date" value="<?=$row["ชั้นปี"]?>" required>
        </div>
        <div class="form-group">
            <label>คณะ</label>
            <input type="time" name="" value="<?=$row["คณะ"]?>"required>
        </div>
        <div class="form-group">
            <label>สาขา</label>
            <input type="text" name="" value="<?=$row["สาขา"]?>"required>
        </div>
        <div class="form-group">
            <label>อีเมลล์</label>
            <input type="text" name="" value="<?=$row["อีเมลล์"]?>"required>
        </div>
        <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <input type="text" name="" value="<?=$row["เบอร์โทรศัพท์"]?>"required>
        </div>
        <div class="form-group">
            <label>วันเดือนปีเกิด</label>
            <input type="text" name="" value="<?=$row["วันเดือนปีเกิด"]?>"required>
        </div>
        <div class="form-group">
            <label>ที่อยู่</label>
            <input type="text" name="" value="<?=$row["ที่อยู่"]?>"required>
        </div>
    </form>
</body>
</html>