<?php include "connect.php" ?>
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
</head>
<body>
    <div class="container">
        <h1>ลงทะเบียน</h1>
        <div class="section">
        <!-- ข้อมูลส่วนตัววววว -->
            <div class="section-title">ข้อมูลส่วนตัวนักเรียน/นักศึกษา</div>
            <div class="form-row">
                <div class="form-group">
                    <label>คำนำหน้า</label>
                        <select name="" id="user_nametitle" name="user_nametitle" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="mr">นาย</option>
                            <option value="ms">นางสาว</option>
                            <option value="mrs">นาง</option>
                        </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง*</label>
                    <input type="text" id="user_firstname" name="user_firstname" pattern="[A-Za-zก-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>นามสกุล*</label>
                    <input type="text" id="user_lastname" name="user_lastname" pattern="[A-Za-zก-๗]{2,}" required>
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>รหัสนักศึกษา*</label>
                        <input type="text" id="user_stdID" name="user_stdID" pattern="[0-9]{13}" required>
                    </div>
                    <div class="form-group">
                        <label>เลขบัตรประชาชน*</label>
                        <input type="text" id="user_id" name="user_id" pattern="[0-9]{13}" required>
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
                            <option value="vc">ปวช.</option>
                            <option value="b">ป.ตรี</option>
                            <option value="m">ป.โท</option>
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
                        <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร*</label>
                        <input type="text" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="flex: 2;">
                        <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)</label>
                        <input type="text" id="user_address" name="user_address" pattern="/d/w/s" required>
                    </div>
                </div>
            </div>

            
        <!-- รหัสผ่าน -->
        <div class="section">
            <div class="section-title">รหัสผ่าน</div>
            <div class="form-row">
                <div class="form-group">
                    <label>รหัสผ่าน*</label>
                    <input type="password" id="password" name="password" pattern="\w{8,}" required>
                </div>
                <div class="form-group">
                    <label>กรอกรหัสผ่านอีกครั้ง*</label>
                    <input type="password" id="re-password" name="password" pattern="\w{8,}" required>
                </div>
            </div>
        </div>



        <!-- สถานภาพครอบครัว -->
        <div class="section">
            <div class="section-title">สถานภาพครอบครัว</div>
            <div class="form-row">
                <div class="form-group">
                    <select name="pattern_status" id="pattern_status" onchange="showSection()">
                        <option value="">เลือกสถานภาพครอบครัว</option>
                        <option value="father">อาศัยอยู่กับบิดา</option>
                        <option value="mother">อาศัยอยู่กับมารดา</option>
                        <option value="both">อาศัยอยู่ร่วมกับบิดาและมารดา</option>
                        <option value="guardian">อาศัยอยู่กับผู้ปกครอง</option>
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
                                    <select id="nametitle_father" name="nametitle_father" required>
                                        <option value="">เลือกคำนำหน้า</option>
                                        <option value="mr">นาย</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อจริง*</label>
                                <input type="text" id="firstname_father" name="firstname_father" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                            </div>
                            <div class="form-group">
                                <label>นามสกุล*</label>
                                <input type="text" id="lastname_father" name="lastname_father" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทร*</label>
                                <input type="text" id="phone_number_father" name="phone_number_father" pattern="[0-9]{10}" required>
                            </div>
                        </div>
                    </div>

        <!-- รายได้ของบิดา -->
        <div class="section" id="father-income-info" style="display: none;">
            <div class="section-title">รายได้ของบิดา</div>
            <img src="img/income.png"><br>
            <div class="radio-income">
                <input type="radio" id="income_regular_father" name="income_father" value="regular"> มีรายได้ประจำ<br>
                <input type="radio" id="income_irregular_father" name="income_father" value="irregular"> มีรายได้ไม่ประจำ<br>
                <input type="radio" id="income_none_father" name="income_father" value="none"> ไม่มีรายได้<br>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_father" name="job_detail_father" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของบิดา (ต่อปี)*</label>
                    <input type="text" id="annual_income_father" name="annual_income_father" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
                

                
                            <!-- ข้อมูลของมารดา -->
        <div class="section" id="mother-info" style="display: none;">
            <div class="section-title">ข้อมูลของมารดา</div>
            <div class="form-row">
                <div class="form-group">
                    <label>คำนำหน้า</label>
                        <select id="nametitle_mother" name="nametitle_mother" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="ms">นางสาว</option>
                            <option value="mrs">นาง</option>
                        </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง*</label>
                    <input type="text" id="firstname_mother" name="firstname_mother" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>นามสกุล*</label>
                    <input type="text" id="lastname_mother" name="lastname_mother" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>เบอร์โทร*</label>
                    <input type="text" id="phone_number_mother" name="phone_number_mother" pattern="[0-9]{10}" required>
                </div>
            </div>
        </div>

        <!-- รายได้ของมารดา -->
        <div class="section" id="mother-income-info" style="display: none;">
            <div class="section-title">รายได้ของมารดา</div>
            <img src="img/income.png"><br>
            <div class="radio-income">
                <input type="radio" id="income_regular_mother" name="income_mother" value="regular"> มีรายได้ประจำ<br>
                <input type="radio" id="income_irregular_mother" name="income_mother" value="irregular"> มีรายได้ไม่ประจำ<br>
                <input type="radio" id="income_none_mother" name="income_mother" value="none"> ไม่มีรายได้<br>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_mother" name="job_detail_mother" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของมารดา (ต่อปี)*</label>
                    <input type="text" id="annual_income_mother" name="annual_income_mother" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
               
              
                            <!-- ข้อมูลของผู้ปกครอง-->
        <div class="section" id="guardian-info" style="display: none;">
            <div class="section-title">ข้อมูลของผู้ปกครอง</div>
            <div class="form-row">
                <div class="form-group">
                    <label>คำนำหน้า</label>
                        <select id="nametitle_guardian" name="nametitle_guardian" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="mr">นาย</option>
                            <option value="ms">นางสาว</option>
                            <option value="mrs">นาง</option>
                        </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง*</label>
                    <input type="text" id="firstname_guardian" name="firstname_guardian" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>นามสกุล*</label>
                    <input type="text" id="lastname_guardian" name="lastname_guardian" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>เบอร์โทร*</label>
                    <input type="text" id="phone_number_guardian" name="phone_number_guardian" pattern="[0-9]{10}" required>
                </div>
            </div>
        </div>

        <!-- รายได้ของผู้ปกครอง -->
        <div class="section" id="guardian-income-info" style="display: none;">
            <div class="section-title">รายได้ของผู้ปกครอง</div>
            <img src="img/income.png"><br>
            <div class="radio-income">
                <input type="radio" id="income_regular_guardian" name="income_guardian" value="regular"> มีรายได้ประจำ<br>
                <input type="radio" id="income_irregular_guardian" name="income_guardian" value="irregular"> มีรายได้ไม่ประจำ<br>
                <input type="radio" id="income_none_guardian" name="income_guardian" value="none"> ไม่มีรายได้<br>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_guardian" name="job_detail_guardian" pattern="[A-Za-zก-ฮ-๗]{2,}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของผู้ปกครอง (ต่อปี)*</label>
                    <input type="text" id="annual_income_guardian" name="annual_income_guardian" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
                
        <button id="succesButton" onclick="successButton">เสร็จสิ้น</button>
    </div>
</body>
</html>