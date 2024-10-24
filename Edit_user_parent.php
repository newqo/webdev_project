<?php
    include "connect.php";

    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }

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
                        <select id='nametitle_father' name='father_pre_name'>";

        $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_id = 1");
        $stmt->execute();
        $row = $stmt->fetch();
        $father .= "<option value='". $row["Pre_name_id"] ."'>". $row["Pre_name_desc"] . "</option>";  

        $father .="</select>
                     </div>
                    <div class='form-group'>
                        <label>ชื่อจริง</label>
                        <input type='text' id='firstname_father' name='father_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $ft_data['firstname'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>นามสกุล</label>
                        <input type='text' id='lastname_father' name='father_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}'  value='". $ft_data['lastname'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>เบอร์โทร</label>
                        <input type='text' id='phone_number_father' name='father_phone_num' maxlength='10' pattern='[0-9]{10}'  value='". $ft_data['phone_num'] ."'>
                    </div>
                        <div class='form-group'>
                            <label>อาชีพ</label>
                            <input type='text' id='job_detail_father' name='father_career' pattern='[A-Za-zก-ฮ-๗]{2,50}'  value='". $ft_data['career'] ."'>
                        </div>
                        <div class='form-group'>
                            <label>รายได้ของบิดา (ต่อปี)</label>
                            <input type='number' id='annual_income_father' name='father_annual_income' min='0' max='9999999999' value='". $ft_data['income'] ."'>
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
                    <select id='nametitle_mother' name='mother_pre_name' >";
        $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_desc LIKE 'นาง%';");
        $stmt->execute();
        while($row = $stmt->fetch()){
            $IsSelected_mother = ($mt_data['parent_pre_name_id'] == $row['Pre_name_id'] ? 'selected' : '');
            $mother .= "<option value='" . $row["Pre_name_id"] . "'". $IsSelected_mother.">". $row["Pre_name_desc"] . "</option>";
        }
        $mother .="
        </select>
                </div>
                <div class='form-group'>
                    <label>ชื่อจริง</label>
                    <input type='text' id='firstname_mother' name='mother_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $mt_data['firstname'] ."'>
                </div>
                <div class='form-group'>
                    <label>นามสกุล</label>
                    <input type='text' id='lastname_mother' name='mother_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}'  value='". $mt_data['lastname'] ."'>
                </div>
                <div class='form-group'>
                    <label>เบอร์โทร</label>
                    <input type='text' id='phone_number_mother' name='mother_phone_num' maxlength='10' pattern='[0-9]{10}'  value='". $mt_data['phone_num'] ."'>
                </div>
                <div class='form-group'>
                        <label>อาชีพ</label>
                        <input type='text' id='job_detail_mother' name='mother_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $mt_data['career'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>รายได้ของมารดา (ต่อปี)</label>
                        <input type='number' id='annual_income_mother' name='mother_annual_income' min='0' max='9999999999'  value='". $mt_data['income'] ."'>
                    </div>
            </div>
    ";
    }
    if($status == 3){ // guardian
        $gd_query = $pdo->prepare("SELECT Parent.parent_id AS 'parent_id' , Parent.Pre_name_id AS 'parent_pre_name_id', Pre_name.Pre_name_desc AS 'parent_pre_name_desc', Parent.firstname AS 'firstname', Parent.lastname AS 'lastname', Parent.phone_num AS 'phone_num', Parent.career AS 'career', Parent.income AS 'income' 
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
                    <select id='nametitle_guardian' name='guardian_pre_name'>";
                        // <option value='". $gd_data['parent_pre_name_id'] ."'>". $gd_data['parent_pre_name_desc'] ."</option>
        $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name");
        $stmt->execute();
        while($row = $stmt->fetch()){
            $IsSelected_guardian= ($gd_data['parent_pre_name_id'] == $row['Pre_name_id'] ? 'selected' : '');
            $guardian .= "<option value='". $row["Pre_name_id"] . "'". $IsSelected_guardian . ">". $row["Pre_name_desc"] . "</option>";
        }
        $guardian .="</select>
                </div>
                <div class='form-group'>
                    <label>ชื่อจริง</label>
                    <input type='text' id='firstname_guardian' name='guardian_fst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $gd_data['firstname'] ."'>
                </div>
                <div class='form-group'>
                    <label>นามสกุล</label>
                    <input type='text' id='lastname_guardian' name='guardian_lst_name' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $gd_data['lastname'] ."'>
                </div>
                <div class='form-group'>
                    <label>เบอร์โทร</label>
                    <input type='text' id='phone_number_guardian' name='guardian_phone_num' maxlength='10' pattern='[0-9]{10}' value='". $gd_data['phone_num'] ."'>
                </div>
                <div class='form-group'>
                        <label>อาชีพ</label>
                        <input type='text' id='job_detail_guardian' name='guardian_career' pattern='[A-Za-zก-ฮ-๗]{2,50}' value='". $gd_data['career'] ."'>
                    </div>
                    <div class='form-group'>
                        <label>รายได้ของผู้ปกครอง (ต่อปี)</label>
                        <input type='number' id='annual_income_guardian' name='guardian_annual_income' min='0' max='9999999999' value='". $gd_data['income'] ."'>
                    </div>
            </div>
    ";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/accountpage.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://kit.fontawesome.com/9703a87d5d.js"
      crossorigin="anonymous"
    ></script>
    <script src="javascript/accountpage.js"></script>
    <title>ข้อมูลส่วนตัวนักศึกษา</title>
  </head>

  <body>
  <header>
        <nav>
          <div class="menu-bar">
            <div class="logo-menu">
              <a href="homepage.php"
                ><img src="imgs/logo-kmutnb.png" alt="Logo" width="100px"
              /></a>
            </div>
            <span class="menu-toggle" onclick="openNav()">&#9776;</span>
            <!-- mobile -->
            <div id="sidebar-mobile" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
                >&times;</a
              >
              <a href="homepage.php">หน้าหลัก</a>
              <div class="drop-mobile">
                <a onclick="myFunctionMobile()">บริการ</a>
                <ul class="drop-content-mobile" id="myDropdown-menu-mobile">
                  <li><a href="#checklist_announcement">ลงทะเบียน</a></li>
                  <li><a href="#reservation_announcement_old_user">ผู้กู้รายเก่า</a></li>
                  <li><a href="#reservation_announcement_new_user">ผู้กู้รายใหม่</a></li>
                </ul>
              </div>
  
              <a href="homepage.php#contect">ติดต่อเรา</a>
              <div class="section-title-menu-mobile">หมวดหมู่</div>
                <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
                <?php
                  if($_SESSION["role"] == 0){
                    echo "
                      <a href='#' id='education' onclick='showContent(id)'>ข้อมูลการศึกษา</a>
                      <a href='#' id='parents' onclick='showContent(id)'>ข้อมูลของครอบครัว</a>
                      <a href='#' id='history' onclick='showContent(id)'>ประวัติการจอง</a>
                      ";
                    }
                ?>
                <a href='' id='changepassword' onclick='showContent(id)'>เปลี่ยนแปลงรหัสผ่าน</a>
                <a href="#">Dashboard</a>
              <br/>
              <a href="#">ออกจากระบบ</a>
            </div>
  
            <!-- desktop -->
            <div class="menu-text-bar">
              <a href="homepage.php">หน้าหลัก</a>
              <div class="dropdown-menu">
                <button class="drop-menu-btn" onclick="myFunction()">
                  บริการ
                </button>
              </div>
              <div class="dropdown-content" id="myDropdown-menu">
                <a href="homepage.php#checklist_announcement">ลงทะเบียน</a>
                <a href="homepage.php#reservation_announcement_old_user">ผู้กู้รายเก่า</a>
                <a href="homepage.php#reservation_announcement_new_user">ผู้กู้รายใหม่</a>
              </div>
              <a href="homepage.php#contect">ติดต่อเรา</a>
            </div>
            <div class="dropdown-menu-user">
              <a onclick="myFunctionUser()">เข้าสู่ระบบ</a>
              <div class="dropdown-content-user" id="myDropdown-menu-user">
                <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
                <?php
                  if($_SESSION["role"] == 0){
                    echo "
                      <a href='#' id='education' onclick='showContent(id)'>ข้อมูลการศึกษา</a>
                      <a href='#' id='parents' onclick='showContent(id)'>ข้อมูลของครอบครัว</a>
                      <a href='#' id='history' onclick='showContent(id)'>ประวัติการจอง</a>
                      ";
                    }
                ?>
                <a href='#' id='changepassword' onclick='showContent(id)'>เปลี่ยนแปลงรหัสผ่าน</a>
                <a href="#">Dashboard</a>
                <a href="#">ออกจากระบบ</a>
              </div>
            </div>
          </div>
        </nav>
      </header>

    <main>
      <div class="content-container">
        <aside>
          <div class="section-title-menu-bar">หมวดหมู่</div>
          <div class="menu">
              <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
              <?php
                if($_SESSION["role"] == 0){
                  echo "
                    <a href='#' id='education' onclick='showContent(id)'>ข้อมูลการศึกษา</a>
                    <a href='#' id='parents' onclick='showContent(id)'>ข้อมูลของครอบครัว</a>
                    <a href='#' id='history' onclick='showContent(id)'>ประวัติการจอง</a>
                    ";
                  }
                  ?>
              <a href='#' id='changepassword' onclick='showContent(id)'>เปลี่ยนแปลงรหัสผ่าน</a>
          </div>
        </aside>

        <article id="article-content">
        <div class='section-title'>ข้อมูลของครอบครัว</div>
        <form action='#' method='post'>
            <?php
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
            ?>
            <div class="form-button">
                <button type="submit" class="confirm-bt">ยืนยัน</button>
                <a href='accountpage.php?content=parents' class='cancel_button' id='edit_user_info'>ยกเลิก</a>
            <div>
        </form>
        </article>
      </div>
    </main>

    <footer>
      <div class="footer-content">
        <div class="footer-section about">
          <h2>เกี่ยวกับเรา</h2>
          <p>
            เว็บไซต์ของเราให้บริการจองและลงทะเบียนที่เกี่ยวข้องกับการกู้ยืม กยศ.มจพ
          </p>
        </div>
    
        <div class="footer-section contact">
          <h2>ติดต่อเรา</h2>
          <ul>
            <li><i class="fas fa-envelope"></i> Email: info@website.com</li>
            <li><i class="fas fa-phone"></i> โทรศัพท์: 02-555-2000 ต่อ 1150, 1161</li>
          </ul>
        </div>
    
        <div class="footer-section social">
          <h2>ติดตามเรา</h2>
          <a href="https://www.facebook.com/profile.php?id=100066829755038"><i class="fab fa-facebook-f"></i> กยศ_kmutnb</a><br>
          <a href="https://liff.line.me/1645278921-kWRPP32q/?accountId=sa.kmutnb"><i class="fab fa-line"></i> กิจการนักศึกษา มจพ.</a>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; 2024 All Rights Reserved
      </div>
    </footer>
  </body>
</html>
