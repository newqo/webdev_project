<?php
    include "connect.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/register.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/9703a87d5d.js" crossorigin="anonymous"></script>
    <script src="javascript/register.js"></script>
    <title>ลงทะเบียน</title>
    <script>
        function print(id){
            console.log(document.getElementById(id).value);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>ลงทะเบียน</h1>
        <!-- ข้อมูลส่วนตัววววว -->
        <form action="register-validate.php" method="post">
            <div class="section">
                <div class="section-title">ข้อมูลส่วนตัวนักเรียน/นักศึกษา</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>คำนำหน้า</label>
                            <select id="user_nametitle_student" name="user_nametitle" required onchange="print(id)">
                                <option value="">เลือกคำนำหน้า</option>
                                <?php
                                    $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name");
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){
                                        echo "<option value='". $row["Pre_name_id"] . "'>". $row["Pre_name_desc"] . "</option>";
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label>ชื่อจริง*</label>
                        <input type="text" id="user_firstname" name="user_firstname" pattern="[A-Za-zก-๙\s]{1,50}" required>
                    </div>
                    <div class="form-group">
                        <label>นามสกุล*</label>
                        <input type="text" id="user_lastname" name="user_lastname" pattern="[A-Za-zก-๙\s]{1,50}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>รหัสนักศึกษา*</label>
                        <input type="text" id="user_stdID" name="user_stdID" placeholder="6501234567890" pattern="[0-9]{13}" maxlength="13" onkeyup="check_std_id()" required>
                        <span id="std-id-result" class="notify-hide">รหัสนักศึกษานี้ถูกใช้ไปแล้ว</span>
                    </div>
                    <div class="form-group">
                        <label>เลขบัตรประชาชน*</label>
                        <input type="text" id="user_id" name="user_id" placeholder="1234567890123" pattern="[0-9]{13}" maxlength="13" onkeyup="check_national_id()" required>
                        <span id="id-result" class="notify-hide">เลขบัตรประชาชนนี้ถูกใช้ไปแล้ว</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>วัน/เดือน/ปีเกิด</label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label>ระดับชั้น*</label>
                        <select name="user_year" id="user_year" onchange="updateFaculty()" required>
                            <option value="">เลือกระดับชั้น</option>
                            <?php
                                $stmt = $pdo->prepare("SELECT * FROM Education_Level_Category");
                                $stmt->execute();
                                while($row = $stmt->fetch()){
                                    echo "<option value='". $row["ed_category_id"] ."'>". $row["ed_desc"] ."</option>";
                                }
                            ?>
                            <!-- <option value="vc">ปวช.</option>
                            <option value="b">ป.ตรี</option>
                            <option value="m">ป.โท</option> -->
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>คณะ*</label>
                        <select name="faculty" id="faculty" onchange="updateMajor()" required>
                            <option value="">เลือกคณะ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>สาขา*</label>
                        <select name="major" id="major" required>
                            <option value="">เลือกสาขา</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- ข้อมูลการติดต่อ -->
            <div class="section">
                <div class="section-title">ข้อมูลการติดต่อ</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>E-mail*</label>
                        <input type="email" id="email" name="email" placeholder="example@email.com" maxlength='50' required>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร*</label>
                        <input type="text" id="phone_number" name="phone_number" maxlength="10" placeholder="0981234567" pattern="[0-9]{10}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="flex: 2;">
                        <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)*</label>
                        <input type="text" id="user_address" name="user_address" pattern="[A-Za-z0-9ก-๙\s,./]{1,100}" maxlength="100" placeholder="บ้านเลขที่ หมู่บ้าน ซอย" required>
                    </div>
                </div>    
                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label for="province">จังหวัด *</label>
                        <select id="province" name="province_name" required>
                            <option value="">เลือกจังหวัด</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="district">อำเภอ/เขต *</label>
                        <select id="dist" name="dist_name" required>
                            <option value="">เลือกอำเภอ/เขต</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label for="sub-district">ตำบล/แขวง *</label>
                        <select id="sub_dist" name="sub_dist_name" required>
                            <option value="">เลือกตำบล/แขวง</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>รหัสไปรษณีย์ *</label>
                        <input type="text" name="postcode" pattern="[0-9]{5}" maxlength="5" required>
                    </div>
                </div>
            </div>   
            <!-- รหัสผ่าน -->
            <div class="section">
                <div class="section-title">รหัสผ่าน</div>
                <span id="checkpw-result" class="section-title notify-hide">รหัสผ่านไม่ตรงกัน</span>
                <div class="form-row">
                    <div class="form-group">
                        <label>รหัสผ่าน*</label>
                        <input type="password" id="password" name="password" maxlength="100" pattern=".{8,100}" placeholder="กรอกอย่างน้อย 8 ตัว" required>
                    </div>
                    <div class="form-group">
                        <label>กรอกรหัสผ่านอีกครั้ง*</label>
                        <input type="password" id="re-password" name="re-password" maxlength="100" pattern=".{8,100}" placeholder="กรอกอย่างน้อย 8 ตัว" required onchange="checkpassword()">
                    </div>
                </div>
            </div>
            <!-- สถานภาพครอบครัว -->
            <div class="section">
                <div class="section-title">สถานภาพครอบครัว</div>
                <div class="form-row">
                    <div class="form-group">
                        <select name="pattern_status_name" id="pattern_status" onchange="showSection(this.value)" required>

                            <option value="">เลือกสถานภาพครอบครัว</option>
                            <!-- <option value="father">อาศัยอยู่กับบิดา</option>
                            <option value="mother">อาศัยอยู่กับมารดา</option>
                            <option value="both">อาศัยอยู่ร่วมกับบิดาและมารดา</option>
                            <option value="guardian">อาศัยอยู่กับผู้ปกครอง</option> -->
                            <?php
                                    $stmt = $pdo->prepare("SELECT parent_status_id,status_description FROM Parent_status");
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){
                                        echo "<option value='". $row["parent_status_id"] . "'>". $row["status_description"] . "</option>";
                                    }
                            ?>
                        </select>
                    </div>
                </div>
            </div>        
            <!-- ข้อมูลของบิดา -->
            <div class="section" id="father-info" style="display: none;">
                <div class="section-title">ข้อมูลของบิดา</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>คำนำหน้า</label>
                            <select id="nametitle_father" name="father_pre_name" onchange="print(id)">
                                <option value="">เลือกคำนำหน้า</option>
                                <!-- <option value="mr">นาย</option> -->
                                <?php
                                    $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_id = 1");
                                    $stmt->execute();
                                    $row = $stmt->fetch();
                                        echo "<option value='". $row["Pre_name_id"] ."'>". $row["Pre_name_desc"] . "</option>";
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label>ชื่อจริง*</label>
                        <input type="text" id="firstname_father" name="father_fst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>นามสกุล*</label>
                        <input type="text" id="lastname_father" name="father_lst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร*</label>
                        <input type="text" id="phone_number_father" name="father_phone_num" placeholder="0981234567" maxlength="10" pattern="[0-9]{10}">
                    </div>
                </div>
            </div>

            <!-- รายได้ของบิดา -->
            <div class="section" id="father-income-info" style="display: none;">
                <div class="section-title">รายได้ของบิดา</div>
                <div class="img-income">
                    <img src="imgs/income.png"><br>
                </div>
                <div class="radio-income">
                    <!-- <input type="radio" id="income_regular_father" name="income_father" value="regular">
                    <label for="income_regular_father"> มีรายได้ประจำ</label><br>
                    <input type="radio" id="income_irregular_father" name="income_father" value="irregular">
                    <label for="income_irregular_father"> มีรายได้ไม่ประจำ</label><br>
                    <input type="radio" id="income_none_father" name="income_father" value="none">
                    <label for="income_none_father"> ไม่มีรายได้</label><br> -->
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM Income_Category");
                        $stmt->execute();

                        $income_cate_arr_father = array("income_regular_father" , "income_irregular_father" , "income_none_father");

                        while($row = $stmt->fetch()){
                            echo "<input type='radio' id='" .  $income_cate_arr_father[$row['income_cate_id'] - 1] ."' name='father_income_type' value='". $row["income_cate_id"] ."'>";
                            echo "<label for='".  $income_cate_arr_father[$row['income_cate_id'] - 1] ."'>". $row["income_cate_desc"] ."</label><br>";
                        }
                    ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                        <input type="text" id="job_detail_father" name="father_career" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของบิดา (ต่อปี)*</label>
                        <input type="number" id="annual_income_father" name="father_annual_income" min="0" max="9999999999">
                    </div>
                </div>
            </div>
                
            <!-- ข้อมูลของมารดา -->
            <div class="section" id="mother-info" style="display: none;">
                <div class="section-title">ข้อมูลของมารดา</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>คำนำหน้า</label>
                            <select id="nametitle_mother" name="mother_pre_name">
                                <option value="">เลือกคำนำหน้า</option>
                                <?php
                                    $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_desc LIKE 'นาง%';");
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){
                                        echo "<option value='" . $row["Pre_name_id"] . "'>". $row["Pre_name_desc"] . "</option>";
                                    }
                                ?>
                                <!-- <option value="ms">นางสาว</option>
                                <option value="mrs">นาง</option> -->
                            </select>
                    </div>
                    <div class="form-group">
                        <label>ชื่อจริง*</label>
                        <input type="text" id="firstname_mother" name="mother_fst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>นามสกุล*</label>
                        <input type="text" id="lastname_mother" name="mother_lst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร*</label>
                        <input type="text" id="phone_number_mother" name="mother_phone_num" placeholder="0981234567" maxlength="10" pattern="[0-9]{10}">
                    </div>
                </div>
            </div>

            <!-- รายได้ของมารดา -->
            <div class="section" id="mother-income-info" style="display: none;">
                <div class="section-title">รายได้ของมารดา</div>
                <div class="img-income">
                    <img src="imgs/income.png"><br>
                </div>
                <div class="radio-income">
                    <!-- <input type="radio" id="income_regular_mother" name="income_mother" value="regular">
                    <label for="income_regular_mother"> มีรายได้ประจำ</label><br>
                    <input type="radio" id="income_irregular_mother" name="income_mother" value="irregular">
                    <label for="income_irregular_mother"> มีรายได้ไม่ประจำ</label><br>
                    <input type="radio" id="income_none_mother" name="income_mother" value="none">
                    <label for="income_none_mother"> ไม่มีรายได้</label><br> -->
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM Income_Category");
                        $stmt->execute();

                        $income_cate_arr_mother = array("income_regular_mother" , "income_irregular_mother" , "income_none_mother");

                        while($row = $stmt->fetch()){
                            echo "<input type='radio' id='" .  $income_cate_arr_mother[$row['income_cate_id'] - 1] ."' name='mother_income_type' value='". $row["income_cate_id"] ."'>";
                            echo "<label for='".  $income_cate_arr_mother[$row['income_cate_id'] - 1] ."'>". $row["income_cate_desc"] ."</label><br>";
                        }
                    ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                        <input type="text" id="job_detail_mother" name="mother_career" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของมารดา (ต่อปี)*</label>
                        <input type="number" id="annual_income_mother" name="mother_annual_income" min="0" max="9999999999">
                    </div>
                </div>
            </div>
                    
            <!-- ข้อมูลของผู้ปกครอง-->
            <div class="section" id="guardian-info" style="display: none;">
                <div class="section-title">ข้อมูลของผู้ปกครอง</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>คำนำหน้า</label>
                            <select id="nametitle_guardian" name="guardian_pre_name" >
                                <option value="">เลือกคำนำหน้า</option>
                                <?php
                                    $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name");
                                    $stmt->execute();
                                    while($row = $stmt->fetch()){
                                        echo "<option value='". $row["Pre_name_id"] . "'>". $row["Pre_name_desc"] . "</option>";
                                    }
                                ?>
                                <!-- <option value="mr">นาย</option>
                                <option value="ms">นางสาว</option>
                                <option value="mrs">นาง</option> -->
                            </select>
                    </div>
                    <div class="form-group">
                        <label>ชื่อจริง*</label>
                        <input type="text" id="firstname_guardian" name="guardian_fst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>นามสกุล*</label>
                        <input type="text" id="lastname_guardian" name="guardian_lst_name" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร*</label>
                        <input type="text" id="phone_number_guardian" name="guardian_phone_num" placeholder="0981234567" pattern="[0-9]{10}" maxlength="10">
                    </div>
                </div>
            </div>

            <!-- รายได้ของผู้ปกครอง -->
            <div class="section" id="guardian-income-info" style="display: none;">
                <div class="section-title">รายได้ของผู้ปกครอง</div>
                <div class="img-income">
                    <img src="imgs/income.png"><br>
                </div>
                <div class="radio-income">
                    <!-- <input type="radio" id="income_regular_guardian" name="income_guardian" value="regular">
                    <label for="income_regular_guardian"> มีรายได้ประจำ</label><br>
                    <input type="radio" id="income_irregular_guardian" name="income_guardian" value="irregular">
                    <label for="income_irregular_guardian"> มีรายได้ไม่ประจำ</label><br>
                    <input type="radio" id="income_none_guardian" name="income_guardian" value="none">
                    <label for="income_none_guardian"> ไม่มีรายได้</label><br> -->
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM Income_Category");
                        $stmt->execute();

                        $income_cate_arr_guardian = array("income_regular_guardian" , "income_irregular_guardian" , "income_none_guardian");

                        while($row = $stmt->fetch()){
                            echo "<input type='radio' id='" .  $income_cate_arr_guardian[$row['income_cate_id'] - 1] ."' name='guardian_income_type' value='". $row["income_cate_id"] ."'>";
                            echo "<label for='".  $income_cate_arr_guardian[$row['income_cate_id'] - 1] ."'>". $row["income_cate_desc"] ."</label><br>";
                        }
                    ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                        <input type="text" id="job_detail_guardian" name="guardian_career" pattern="[A-Za-zก-๙\s]{1,50}">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของผู้ปกครอง (ต่อปี)*</label>
                        <input type="number" id="annual_income_guardian" name="guardian_annual_income" min="0" max="9999999999">
                    </div>
                </div>
            </div>      
            <button id="succesButton" type="submit" class="">เสร็จสิ้น</button>
        </form>
    </div>
</body>
</html>