<?php
    include 'connect.php';

    session_start();

    $content = $_GET['content'];
    
    if($content == 'student'){
      $stmt = $pdo->prepare("SELECT Users.Pre_name_id AS 'pre_name_id' , Pre_name.Pre_name_desc AS 'คำนำหน้า',firstname,lastname,Education.std_ID AS 'std_id' ,Users.national_id AS 'national_id', birthdate,Email , phone_num,Address 
                          FROM Users JOIN Education ON Users.national_id = Education.national_id 
                          JOIN Pre_name ON Users.Pre_name_id = Pre_name.Pre_name_id 
                          WHERE Users.national_id = ?");
      $stmt->bindParam(1,$_SESSION['national_id']);
      $stmt->execute();
      $row = $stmt->fetch();
      echo "
        <div class= 'section-title'>ข้อมูลส่วนตัวนักศึกษา</div>
        <form action='#' method='post'>
          <div class='form-group'>
            <label>คำนำหน้า</label>
            <select name='user_nametitle' id='user_nametitle' disabled='disabled'>
              <option value='". $row['pre_name_id'] . "'>" . $row['คำนำหน้า'] ."</option>
            </select>
          </div>
          <div class='form-group'>
            <label>ชื่อจริง</label>
            <input type='text' id='user_firstname' name='user_firstname' pattern='[A-Za-zก-๗]{2,}' disabled='disabled' value='". $row['firstname'] ."'/>
          </div>
          <div class='form-group'>
            <label>นามสกุล</label>
            <input type='text' id='user_lastname' name='user_lastname' pattern='[A-Za-zก-๗]{2,}' disabled='disabled' value='". $row['lastname'] ."'/>
          </div>
          <div class='form-group'>
            <label>รหัสนักศึกษา*</label>
            <input type='text' id='user_stdID' name='user_stdID' pattern='[0-9]{13}' maxlength='13' onkeyup='check_std_id()' disabled='disabled' value='". $row['std_id'] ."'>
          </div>
          <div class='form-group'>
            <label>เลขบัตรประชาชน*</label>
            <input type='text' id='user_id' name='user_id' pattern='[0-9]{13}' maxlength='13' onkeyup='check_national_id()' disabled='disabled' value='". $row['national_id'] ."'>
          </div>
          <div class='form-group'>
            <label>วัน/เดือน/ปีเกิด</label>
            <input type='date' id='birthdate' name='birthdate' disabled='disabled' value='". $row['birthdate'] ."'/>
          </div>
          <div class='form-group'>
            <label>E-mail</label>
            <input type='email' id='email' name='email' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$' disabled='disabled' value='". $row['Email'] ."'/>
          </div>
          <div class='form-group'>
            <label>เบอร์โทร</label>
            <input type='text' id='phone_number' name='phone_number' pattern='[0-9]{10}' disabled='disabled' value='". $row['phone_num'] ."'/>
          </div>
          <div class='form-group' style='flex: 2;'>
            <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)*</label>
            <input type='text' id='user_address' name='user_address' pattern='[A-Za-z0-9\s,.]{2,200}' maxlength='200' disabled='disabled' value='". $row['Address'] ."'/>
          </div>
          <button id='success-bt'>แก้ไข</button>
        </form>
        ";
    }else if($content == 'education'){
      $stmt = $pdo->prepare("SELECT Education_Level_Category.ed_category_id AS 'ed_cate_id', Education_Level_Category.ed_desc AS 'ed_cate_desc', Faculty.Faculty_id AS 'fac_id', Faculty.Faculty_name AS 'fac_name', Department.Department_id AS 'dep_id', Department.Department_name AS 'dep_name'
                          FROM Education JOIN Education_Level_Category ON Education.Education_Level = Education_Level_Category.ed_category_id 
                          JOIN Faculty ON Education.Faculty_id = Faculty.Faculty_id 
                          JOIN Department ON Education.Department_id = Department.Department_id
                          WHERE Education.national_id = ?");
      $stmt->bindParam(1,$_SESSION['national_id']);
      $stmt->execute();
      $row = $stmt->fetch();
      echo "
      <div class='section-title'>ข้อมูลการศึกษา</div>
      <div class='form-group'>
        <form action='#' method='post'>
          <div class='form-group'>
            <label>ระดับชั้น</label>
            <select name='user_year' id='user_year' onchange='updateFaculty()' disabled='disabled'>
                <option value='". $row['ed_cate_id'] ."'>". $row['ed_cate_desc'] ."</option>
            </select>
          </div>
          <div class='form-group'>
              <label>คณะ</label>
              <select name='faculty' id='faculty' onchange='updateMajor()' disabled='disabled'>
                <option value='". $row['fac_id'] ."'>". $row['fac_name'] ."</option>
              </select>
          </div>
          <div class='form-group'>
              <label>สาขา</label>
              <select name='major' id='major' disabled='disabled'>
                  <option value='". $row['dep_id'] ."'>". $row['dep_name'] ."</option>
              </select>
          </div>
          <button id='success-bt'>แก้ไข</button>
        </form>
      </div>
      ";
    }else if($content == 'parents'){
      $stmt = $pdo->prepare("SELECT Parent_status.parent_status_id AS 'status' FROM Users 
                          JOIN User_Relationship ON Users.national_id = User_Relationship.national_id 
                          JOIN Parent ON Parent.parent_id = User_Relationship.parent_id 
                          JOIN Parent_status ON Parent.parent_status_id = Parent_status.parent_status_id 
                          WHERE Users.national_id = ?
                          GROUP BY Users.national_id;");
      $stmt->bindParam(1,$_SESSION['national_id']);
      $stmt->execute();
      $row = $stmt->fetch();

      $status = $row['status'];

      if($status == 0 || $status == 2){ // father
        $ft_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income' 
                                          FROM Parent 
                                          JOIN User_Relationship ON Parent.parent_id = User_Relationship.parent_id 
                                          JOIN Users ON Users.national_id = User_Relationship.national_id 
                                          JOIN Pre_name ON Parent.Pre_name_id = Pre_name.Pre_name_id
                                          WHERE Users.national_id = ? AND Pre_name.Pre_name_desc LIKE 'นาย';");
        $ft_query->bindParam(1,$_SESSION['national_id']);
        $ft_query->execute();
        $ft_data = $ft_query->fetch();
        $father = "
      <!-- ส่วนข้อมูลของบิดา -->
        <div class='section' id='father-info'>
            <div class='section-title-parents'>ข้อมูลของบิดา</div>
                <div class='form-group'>
                    <label>คำนำหน้า</label>
                    <select id='nametitle_father' name='father_pre_name' disabled='disabled'>
                        <option value='". $ft_data['parent_pre_name_id'] ."'>". $ft_data['parent_pre_name_desc'] ."</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label>ชื่อจริง</label>
                    <input type='text' id='firstname_father' name='father_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $ft_data['firstname'] ."'>
                </div>
                <div class='form-group'>
                    <label>นามสกุล</label>
                    <input type='text' id='lastname_father' name='father_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $ft_data['lastname'] ."'>
                </div>
                <div class='form-group'>
                    <label>เบอร์โทร</label>
                    <input type='text' id='phone_number_father' name='father_phone_num' maxlength='10' pattern='[0-9]{10}' disabled='disabled' value='". $ft_data['phone_num'] ."'>
                </div>
                    <div class='form-group'>
                        <label>อาชีพ</label>
                        <input type='text' id='job_detail_father' name='father_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $ft_data['career'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>รายได้ของบิดา (ต่อปี)</label>
                        <input type='number' id='annual_income_father' name='father_annual_income' min='0' max='9999999999' disabled='disabled' value='". $ft_data['income'] ."'>
                    </div>
                </div>
            </div>
      ";
      }
      if ($status == 1 || $status == 2){ // mother
        $mt_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income' 
                                          FROM Parent 
                                          JOIN User_Relationship ON Parent.parent_id = User_Relationship.parent_id 
                                          JOIN Users ON Users.national_id = User_Relationship.national_id 
                                          JOIN Pre_name ON Parent.Pre_name_id = Pre_name.Pre_name_id
                                          WHERE Users.national_id = ? AND Pre_name.Pre_name_desc LIKE 'นาง%';");
        $mt_query->bindParam(1,$_SESSION['national_id']);
        $mt_query->execute();
        $mt_data = $mt_query->fetch();
        $mother = "
      <!-- ส่วนข้อมูลของมารดา -->
        <div class='section' id='mother-info'>
            <div class='section-title-parents'>ข้อมูลของมารดา</div>
                <div class='form-group'>
                    <label>คำนำหน้า</label>
                    <select id='nametitle_mother' name='mother_pre_name' disabled='disabled'>
                        <option value='". $mt_data['parent_pre_name_id'] ."'>". $mt_data['parent_pre_name_desc'] ."</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label>ชื่อจริง</label>
                    <input type='text' id='firstname_mother' name='mother_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $mt_data['firstname'] ."'>
                </div>
                <div class='form-group'>
                    <label>นามสกุล</label>
                    <input type='text' id='lastname_mother' name='mother_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $mt_data['lastname'] ."'>
                </div>
                <div class='form-group'>
                    <label>เบอร์โทร</label>
                    <input type='text' id='phone_number_mother' name='mother_phone_num' maxlength='10' pattern='[0-9]{10}' disabled='disabled' value='". $mt_data['phone_num'] ."'>
                </div>
                <div class='form-group'>
                        <label>อาชีพ</label>
                        <input type='text' id='job_detail_mother' name='mother_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $mt_data['career'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>รายได้ของมารดา (ต่อปี)</label>
                        <input type='number' id='annual_income_mother' name='mother_annual_income' min='0' max='9999999999' disabled='disabled' value='". $mt_data['income'] ."'>
                    </div>
            </div>
      ";
      }
      if($status == 3){ // guardian
        $guardian = "
      <!-- ส่วนข้อมูลของผู้ปกครอง -->
        <div class='section' id='guardian-info'>
            <div class='section-title-parents'>ข้อมูลของผู้ปกครอง</div>
                <div class='form-group'>
                    <label>คำนำหน้า</label>
                    <select id='nametitle_guardian' name='guardian_pre_name' disabled='disabled'>
                        <option value='". $row[''] ."'>". $row[''] ."</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label>ชื่อจริง</label>
                    <input type='text' id='firstname_guardian' name='guardian_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $row[''] ."'>
                </div>
                <div class='form-group'>
                    <label>นามสกุล</label>
                    <input type='text' id='lastname_guardian' name='guardian_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $row[''] ."'>
                </div>
                <div class='form-group'>
                    <label>เบอร์โทร</label>
                    <input type='text' id='phone_number_guardian' name='guardian_phone_num' maxlength='10' pattern='[0-9]{10}' disabled='disabled' value='". $row[''] ."'>
                </div>
                <div class='form-group'>
                        <label>อาชีพ</label>
                        <input type='text' id='job_detail_guardian' name='guardian_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $row[''] ."'>
                    </div>
                    <div class='form-group'>
                        <label>รายได้ของผู้ปกครอง (ต่อปี)</label>
                        <input type='number' id='annual_income_guardian' name='guardian_annual_income' min='0' max='9999999999' disabled='disabled' value='". $row[''] ."'>
                    </div>
            </div>
      ";
      }

      echo "
      <div class='section-title'>ข้อมูลของครอบครัว</div>
      <form action='#' method='post'>
      ";
        
      if($status == 0){ // father
        echo $father;
      }else if($status == 1){ // mother
        echo $mother;
      }else if($status == 2){ // father and mother
        echo $father;
        echo $mother;
      }else if($status == 3){ // guardian
        echo $guardian;
      }

      echo "
      <button id='success-bt'>แก้ไข</button>
      </form>
      ";
    }else if($content == 'history'){
      echo "
      <div class='section-title'>ประวัติการจอง</div>
      <form action='#' method='post'>
        <div class='box'>
          <div class='section-title-box'>จองคิว</div>
          <p>วันที่จอง</p>
          <p>ลำดับคิว</p>
          <p>สถานที่</p>
          <button id='success-bt'>พิมพ์</button>
        </div>
      </form>
      ";
    }else if($content == 'changepassword'){
      echo "
        <div class='section-title'>เปลี่ยนแปลงรหัสผ่าน</div>
        <form action='#' method='post'>
            <div class='form-group'>
              <label>รหัสผ่านปัจจุบัน</label>
              <input type='password' id='password' name='password' pattern='\w{8,20}'>
          </div>
            <div class='form-group'>
                <label>รหัสผ่านใหม่</label>
                <input type='password' id='password' name='password' pattern='\w{8,20}'>
            </div>
            <div class='form-group'>
                <label>ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                <input type='password' id='re-password' name='password' pattern='\w{8,20}'>
            </div>
        <button id='success-bt'>ยืนยัน</button>
        </form>
      ";
    }
?>
