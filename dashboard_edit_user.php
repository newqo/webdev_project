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
        $query_user = $pdo->prepare("SELECT User_category.user_cate_id AS 'ประเภทผู้กู้',User_category.category_desc,Users.national_id AS 'ID' , Pre_name.Pre_name_id AS 'คำนำหน้า' ,Pre_name.Pre_name_desc,Users.firstname AS 'ชื่อ',Users.lastname AS 'นามสกุล',Education_Level_Category.ed_category_id AS 'ชั้นปี',Education_Level_Category.ed_desc,Faculty.Faculty_id AS 'คณะ',Faculty.Faculty_name,Department.Department_id AS 'สาขา',Department.Department_name,Users.Email AS 'อีเมลล์',Users.phone_num AS 'เบอร์โทรศัพท์',Users.birthdate AS 'วันเดือนปีเกิด',Users.Address AS 'ที่อยู่' FROM Users INNER JOIN Pre_name ON Users.Pre_name_id=Pre_name.Pre_name_id INNER JOIN User_category ON Users.user_cate_id=User_category.user_cate_id INNER JOIN Education ON Users.national_id=Education.national_id INNER JOIN Education_Level_Category ON Education.Education_Level=Education_Level_Category.ed_category_id INNER JOIN Faculty ON Education.Faculty_id=Faculty.Faculty_id INNER JOIN Department ON Department.Department_id=Education.Department_id WHERE Users.national_id = ? ;");
        $query_user->bindParam(1,$_GET["national_id"]);
        $query_user->execute();
        $row = $query_user->fetch();
    ?>
    <div class="title">แก้ไขข้อมูลผู้กู้</div>
    <form action="edit_user_procedure.php" method="post">
        <input type="hidden" name="national_id" value="<?=$row["ID"]?>">
        <div class="form-group">
            <label>ประเภทผู้กู้</label>
            <select name="user_cate_id" required>
                <?php 
                    $user_cate = $row["ประเภทผู้กู้"];

                    $query_cate = $pdo->prepare("SELECT * FROM User_category");
                    $query_cate->execute();

                    while($option = $query_cate->fetch()){
                        $IsSelected_cate = ($user_cate == $option["user_cate_id"]) ? 'selected' : '';
                        echo "<option value='". $option["user_cate_id"] ."'". $IsSelected_cate .">". $option["category_desc"] ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>คำนำหน้า</label>
            <select id="Pre_name_selected" name="Pre_name_id" required>
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
            <select name="Education_Level" required>
                <?php 
                    $user_ed_level = $row["ชั้นปี"];

                    $query_ed_level = $pdo->prepare("SELECT * FROM Education_Level_Category");
                    $query_ed_level->execute();

                    while($option = $query_ed_level->fetch()){
                        $IsSelected_ed_level = ($user_ed_level == $option["ed_category_id"]) ? 'selected' : '';
                        echo "<option value='". $option["ed_category_id"] ."'". $IsSelected_ed_level .">". $option["ed_desc"] ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>คณะ</label>
            <select name="Faculty_id" required>
                <?php 
                    $user_faculty = $row["คณะ"];

                    $query_faculty = $pdo->prepare("SELECT * FROM Faculty");
                    $query_faculty->execute();

                    while($option = $query_faculty->fetch()){
                        $IsSelected_faculty = ($user_faculty == $option["Faculty_id"]) ? 'selected' : '';
                        echo "<option value='". $option["Faculty_id"] ."'". $IsSelected_faculty .">". $option["Faculty_name"] ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>สาขา</label>
            <select name="Department_id" required>
                <?php 
                    $user_department = $row["สาขา"];

                    $query_department = $pdo->prepare("SELECT * FROM Department");
                    $query_department->execute();

                    while($option = $query_department->fetch()){
                        $IsSelected_department = ($user_department == $option["Department_id"]) ? 'selected' : '';
                        echo "<option value='". $option["Department_id"] ."'". $IsSelected_department .">". $option["Department_name"] ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>อีเมลล์</label>
            <input type="email" name="Email" value="<?=$row["อีเมลล์"]?>" placeholder="example@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <input type="text" name="phone_num"  value="<?=$row["เบอร์โทรศัพท์"]?>" placeholder="0981234567" maxlength="10" required>
        </div>
        <div class="form-group">
            <label>วันเดือนปีเกิด</label>
            <input type="date" name="birthdate" value="<?=$row["วันเดือนปีเกิด"]?>"required>
        </div>
        <div class="form-group">
            <label>ที่อยู่</label>
            <textarea name="Address" rows="4" cols="50" pattern="[A-Za-z0-9ก-๙\s,.]{2,200}" maxlength="200" required><?=$row["ที่อยู่"]?></textarea>
        </div>
        <div class="submit-btn"><input type="submit" value="แก้ไข"></div>
    </form>
</body>
</html>