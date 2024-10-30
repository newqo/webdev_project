<?php
  include "connect.php";

  session_start();

  if (empty($_SESSION["national_id"]) ) { 
    header("location: login.php");
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

  <body onload="updateFaculty(<?=$_SESSION['national_id']?>)">
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
                  <li><a href="homepage.php#checklist_announcement">ลงทะเบียน</a></li>
                  <li><a href="homepage.php#reservation_announcement_old_user">ผู้กู้รายเก่า</a></li>
                  <li><a href="homepage.php#reservation_announcement_new_user">ผู้กู้รายใหม่</a></li>
                </ul>
              </div>
  
              <a href="homepage.php#contect">ติดต่อเรา</a>
              <div class="section-title-menu-mobile">หมวดหมู่</div>
                <a href="accountpage.php?content=student" id="student">ข้อมูลส่วนตัวนักศึกษา</a>
                <a href="accountpage.php?content=education" id="education" >ข้อมูลการศึกษา</a>
                <a href="accountpage.php?content=parents" id="parents" >ข้อมูลของครอบครัว</a>
                <a href="accountpage.php?content=history" id="history" >ประวัติการจอง</a>
                <a href="Edit_user_password.php" id="changepassword" >เปลี่ยนแปลงรหัสผ่าน</a>
                <?php
                  if(isset($_SESSION['role']) && $_SESSION["role"] == 1){
                    echo "<a href=\"dashboard.php\">Dashboard</a>";
                  }
                ?>
              <br/>
              <a href="logout.php">ออกจากระบบ</a>
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
              <div class="drop-menu-user-btn">
                <button id='user-btn'
                <?php
                  if(isset($_SESSION['firstname'])){
                    echo "onclick='myFunctionUser()'>" . $_SESSION['firstname'];
                  }
                  else{
                    echo "onclick=\"window.location.href='login.php'\">เข้าสู่ระบบ";
                  }
                ?>
                </button>
              </div>
              <div class="dropdown-content-user" id="myDropdown-menu-user">
                <a href="accountpage.php?content=student" id="student">ข้อมูลส่วนตัวนักศึกษา</a>
                <a href="accountpage.php?content=education" id="education" >ข้อมูลการศึกษา</a>
                <a href="accountpage.php?content=parents" id="parents" >ข้อมูลของครอบครัว</a>
                <a href="accountpage.php?content=history" id="history" >ประวัติการจอง</a>
                <a href="Edit_user_password.php" id="changepassword" >เปลี่ยนแปลงรหัสผ่าน</a>
                <?php
                  if(isset($_SESSION['role']) && $_SESSION["role"] == 1){
                    echo "<a href=\"dashboard.php\">Dashboard</a>";
                  }
                ?>
                <a href="logout.php">ออกจากระบบ</a>
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
              <a href='Edit_user_password.php' id='changepassword'>เปลี่ยนแปลงรหัสผ่าน</a>
          </div>
        </aside>

        <article id="article-content">
        <?php
            $stmt = $pdo->prepare("SELECT Education_Level_Category.ed_category_id AS 'ed_cate_id', Education_Level_Category.ed_desc AS 'ed_cate_desc', Faculty.Faculty_id AS 'fac_id', Faculty.Faculty_name AS 'fac_name', Department.Department_id AS 'dep_id', Department.Department_name AS 'dep_name', Education.std_ID AS 'std_id' 
            FROM Education JOIN Education_Level_Category ON Education.Education_Level = Education_Level_Category.ed_category_id 
            JOIN Faculty ON Education.Faculty_id = Faculty.Faculty_id 
            JOIN Department ON Education.Department_id = Department.Department_id
            WHERE Education.national_id = ?");
            $stmt->bindParam(1,$_SESSION['national_id']);
            $stmt->execute();
            $row = $stmt->fetch();
        ?>
        <div class='section-title'>ข้อมูลการศึกษา</div>
        <div class='form-group'>
          <form action='update_user_education.php' method='post'>
            <div class='form-group'>
              <!-- <label>รหัสนักศึกษา*</label> -->
              <input type='hidden' id='user_stdID' name='user_stdID' pattern='[0-9]{13}' maxlength='13' value='<?=$row['std_id']?>'>
            </div>
            <div class='form-group'>
              <label>ระดับชั้น</label>
              <select name='user_year' id='user_year' onchange='updateFaculty(<?=$_SESSION["national_id"]?>)' >
                    <?php
                        $user_ed_cate_id = $row['ed_cate_id'];

                        $stmt = $pdo->prepare("SELECT * FROM Education_Level_Category");
                        $stmt->execute();
                        while($row = $stmt->fetch()){
                            $IsSelected_ed_cate_id = ($user_ed_cate_id == $row['ed_category_id']) ? 'selected' : '';
                            echo "<option value='". $row["ed_category_id"] ."' ".$IsSelected_ed_cate_id.">". $row["ed_desc"] ."</option>";
                        }
                    ?>
              </select>
            </div>
            <div class='form-group'>
                <label>คณะ</label>
                <select name='faculty' id='faculty' onchange='updateMajor(<?=$_SESSION["national_id"]?>)' >
                </select>
            </div>
            <div class='form-group'>
                <label>สาขา</label>
                <select name='major' id='major'>
                </select>
            </div>
            <div class="submit-btn">
                <button type="submit" class="sub-btn">ยืนยัน</button>
                <a href='accountpage.php?content=education' class='cancel-btn' id='edit_user_info'>ยกเลิก</a>
            <div>
          </form>
        </div>
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
