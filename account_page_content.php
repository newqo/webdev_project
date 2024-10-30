<?php
    include 'connect.php';

    session_start();

    $content = $_GET['content'];
    
    if($content == 'student'){
      $stmt = $pdo->prepare("SELECT Users.Pre_name_id AS 'pre_name_id' , Pre_name.Pre_name_desc AS 'คำนำหน้า',firstname,lastname ,Users.national_id AS 'national_id', birthdate,Email , phone_num,Address 
                          FROM Users
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
          <div class='form-group'>
            <a href='Edit_student_info.php' class='edit_button' id='edit_user_info'>แก้ไข</a>
          <div>
        </form>
        ";
    }else if($_SESSION["role"] == 0){
      if($content == 'education'){
        $stmt = $pdo->prepare("SELECT Education_Level_Category.ed_category_id AS 'ed_cate_id', Education_Level_Category.ed_desc AS 'ed_cate_desc', Faculty.Faculty_id AS 'fac_id', Faculty.Faculty_name AS 'fac_name', Department.Department_id AS 'dep_id', Department.Department_name AS 'dep_name', Education.std_ID AS 'std_id' 
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
              <label>รหัสนักศึกษา*</label>
              <input type='text' id='user_stdID' name='user_stdID' pattern='[0-9]{13}' maxlength='13' onkeyup='check_std_id()' disabled='disabled' value='". $row['std_id'] ."'>
            </div>
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
            <div class='form-group'>
              <a href='Edit_user_education.php' class='edit_button' id='edit_user_info'>แก้ไข</a>
            <div>
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
          $ft_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income'  , Parent.income_cate_id AS 'income_type'
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
                            <label>ประเภทของรายได้</label>
                            <select id='father_income_type_id' name='father_income_type' disabled='disabled'>
                              ";
                              $stmt = $pdo->prepare("SELECT Income_Category.income_cate_desc AS 'income_desc' FROM Income_Category WHERE Income_Category.income_cate_id = ?");
                              $stmt->bindParam(1,$ft_data['income_type']);
                              $stmt->execute();
                              $row = $stmt->fetch();
                              $father .= "<option value='". $ft_data["income_type"] ."'>". $row["income_desc"] . "</option>"; 

                        $father .="
                            </select>
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
          $mt_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income' , Parent.income_cate_id AS 'income_type'
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
                            <label>ประเภทของรายได้</label>
                            <select id='father_income_type_id' name='father_income_type' disabled='disabled'>
                              ";
                              $stmt = $pdo->prepare("SELECT Income_Category.income_cate_desc AS 'income_desc' FROM Income_Category WHERE Income_Category.income_cate_id = ?");
                              $stmt->bindParam(1,$mt_data['income_type']);
                              $stmt->execute();
                              $row = $stmt->fetch();
                              $mother .= "<option value='". $mt_data["income_type"] ."'>". $row["income_desc"] . "</option>"; 

                        $mother .="
                            </select>
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
          $gd_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income' , Parent.income_cate_id AS 'income_type'
                                            FROM Parent 
                                            JOIN User_Relationship ON Parent.parent_id = User_Relationship.parent_id 
                                            JOIN Users ON Users.national_id = User_Relationship.national_id 
                                            JOIN Pre_name ON Parent.Pre_name_id = Pre_name.Pre_name_id
                                            WHERE Users.national_id = ? ;");
          $gd_query->bindParam(1,$_SESSION['national_id']);
          $gd_query->execute();
          $gd_data = $gd_query->fetch();
          $guardian = "
        <!-- ส่วนข้อมูลของผู้ปกครอง -->
          <div class='section' id='guardian-info'>
              <div class='section-title-parents'>ข้อมูลของผู้ปกครอง</div>
                  <div class='form-group'>
                      <label>คำนำหน้า</label>
                      <select id='nametitle_guardian' name='guardian_pre_name' disabled='disabled'>
                          <option value='". $gd_data['parent_pre_name_id'] ."'>". $gd_data['parent_pre_name_desc'] ."</option>
                      </select>
                  </div>
                  <div class='form-group'>
                      <label>ชื่อจริง</label>
                      <input type='text' id='firstname_guardian' name='guardian_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $gd_data['firstname'] ."'>
                  </div>
                  <div class='form-group'>
                      <label>นามสกุล</label>
                      <input type='text' id='lastname_guardian' name='guardian_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $gd_data['lastname'] ."'>
                  </div>
                  <div class='form-group'>
                      <label>เบอร์โทร</label>
                      <input type='text' id='phone_number_guardian' name='guardian_phone_num' maxlength='10' pattern='[0-9]{10}' disabled='disabled' value='". $gd_data['phone_num'] ."'>
                  </div>
                  <div class='form-group'>
                            <label>ประเภทของรายได้</label>
                            <select id='father_income_type_id' name='father_income_type' disabled='disabled'>
                              ";
                              $stmt = $pdo->prepare("SELECT Income_Category.income_cate_desc AS 'income_desc' FROM Income_Category WHERE Income_Category.income_cate_id = ?");
                              $stmt->bindParam(1,$gd_data['income_type']);
                              $stmt->execute();
                              $row = $stmt->fetch();
                              $guardian .= "<option value='". $gd_data["income_type"] ."'>". $row["income_desc"] . "</option>"; 

                        $guardian .="
                            </select>
                        </div>
                  <div class='form-group'>
                          <label>อาชีพ</label>
                          <input type='text' id='job_detail_guardian' name='guardian_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' disabled='disabled' value='". $gd_data['career'] ."'>
                      </div>
                      <div class='form-group'>
                          <label>รายได้ของผู้ปกครอง (ต่อปี)</label>
                          <input type='number' id='annual_income_guardian' name='guardian_annual_income' min='0' max='9999999999' disabled='disabled' value='". $gd_data['income'] ."'>
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
        <div class='form-group'>
          <a href='Edit_user_parent.php' class='edit_button' id='edit_user_info'>แก้ไข</a>
        <div>
        </form>
        ";
        }
      }
    if($content == 'history'){
      $rs = $pdo->prepare("SELECT Users.national_id, Users.firstname , Users.lastname, Scholarship.scholarship_name AS 'ชื่อทุน', Cost_of_living_status.amount AS 'ค่าครองชีพต่อเดือน',
                          DATE_FORMAT(Reservation.reserve_date, '%d/%m/%Y') AS reserve_date,
                          DATE_FORMAT(Reservation.reserve_time, '%h:%i') AS reserve_time, 
                          Reservation.queue_no AS 'queue_no',
                          Reservation.duration_id AS 'duration_id'
                          FROM Reservation 
                          JOIN Users ON Reservation.national_id = Users.national_id 
                          JOIN Checklist ON Reservation.checklist_id = Checklist.checklist_id 
                          JOIN Scholarship ON Checklist.scholarship_id = Scholarship.scholarship_id 
                          JOIN Cost_of_living_status ON Checklist.cost_of_living_id = Cost_of_living_status.cost_of_living_id
                          WHERE Users.national_id = ?
                          ORDER BY Reservation.reserve_date DESC, Reservation.reserve_time DESC;");
      $rs->bindParam(1,$_SESSION['national_id']);
      $rs->execute();
      echo "
      <div class='section-title'>ประวัติการจอง</div>
      ";
      while($row = $rs->fetch()){
        echo "
        <form action='#' method='post'>
          <div class='box'>
            <div class='section-title-box'> ".$row['ชื่อทุน'] ."</div>
            <p name='reserve_date'><b>วันที่จอง</b> ".$row['reserve_date'] ." เวลา ". $row['reserve_time'] ." น.</p>
            <p name='queue_no'><b>ลำดับคิวที่</b> ".$row['queue_no'] ."</p>
            <p name='location'><b>สถานที่</b> ชั้น 4 (ฝั่งสนามบาสเกตบอล) อาคาร 40 ปี มจพ.</p>
            <a class='print-bt' href='pdf_reservation.php?nid=".$row['national_id']."&duration_id=".$row['duration_id']."'>พิมพ์</a>
          </div>
        </form>
        ";
      }
    }
?>
