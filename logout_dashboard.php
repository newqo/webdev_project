<?php
session_start();

session_destroy(); // ทำลาย session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="javascript/dashboard.js"></script>
    <title>ออกจากระบบสำเร็จ</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f0f4f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        
        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
        }
        
        .message {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .return-link {
            margin-top: 20px;
            display: inline-block;
            padding: 12px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .return-link:hover {
            background-color: #0056b3;
        }
    </style>
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
                  <li><a href="homepage.php#checklist_announcement">ลงทะเบียน</a></li>
                  <li><a href="homepage.php#reservation_announcement_old_user">ผู้กู้รายเก่า</a></li>
                  <li><a href="homepage.php#reservation_announcement_new_user">ผู้กู้รายใหม่</a></li>
                </ul>
              </div>
  
              <a href="#contect">ติดต่อเรา</a>
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
              <div class="drop-menu-user-btn">
                <button
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
                <a href="logout_dashboard.php">ออกจากระบบ</a>
              </div>
            </div>
          </div>
        </nav>
      </header>
    <div class="message">
        <h1>ออกจากระบบสำเร็จ</h1>
        <div>
            <a class="return-link" href="homepage.php">กลับสู่หน้าหลัก</a>
        </div>
    </div>
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
