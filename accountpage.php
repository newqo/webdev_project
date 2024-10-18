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
              ><img src="imgs/logo kmutnb final.png" alt="Logo" width="64px"
            /></a>
          </div>
          <span class="menu-toggle" onclick="openNav()">&#9776;</span>
          <!-- mobile -->
          <div id="sidebar-mobile" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
              >&times;</a
            >
            <a href="#">หน้าหลัก</a>
            <div class="drop-mobile">
              <a onmouseover="myFunctionMobile()">บริการ</a>
              <ul class="drop-content-mobile" id="myDropdown-menu-mobile">
                <li><a href="#">ผู้กู้รายใหม่</a></li>
                <li><a href="#">ผู้กู้รายเก่า</a></li>
              </ul>
            </div>

            <a href="#">ติดต่อเรา</a>
            <div class="section-title-menu-mobile">หมวดหมู่</div>
              <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
              <a href="#" id="education" onclick="showContent(id)">ข้อมูลการศึกษา</a>
              <a href="#" id="parents" onclick="showContent(id)">ข้อมูลของครอบครัว</a>
              <a href="#" id="history" onclick="showContent(id)">ประวัติการจอง</a>
              <a href="#" id="changepassword" onclick="showContent(id)">เปลี่ยนแปลงรหัสผ่าน</a>
            <br/>
            <a href="#">ออกจากระบบ</a>
          </div>

          <!-- desktop -->
          <div class="menu-text-bar">
            <a href="#">หน้าหลัก</a>
            <div class="dropdown-menu">
              <button class="drop-menu-btn" onmouseover="myFunction()">
                บริการ
              </button>
            </div>
            <div class="dropdown-content" id="myDropdown-menu">
              <a href="#">ผู้กู้รายใหม่</a>
              <a href="#">ผู้กู้รายเก่า</a>
            </div>
            <a href="#">ติดต่อเรา</a>
          </div>
          <div class="dropdown-menu-user">
            <a onmouseover="myFunctionUser()">เข้าสู่ระบบ</a>
            <div class="dropdown-content-user" id="myDropdown-menu-user">
              <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
              <a href="#" id="education" onclick="showContent(id)">ข้อมูลการศึกษา</a>
              <a href="#" id="parents" onclick="showContent(id)">ข้อมูลของครอบครัว</a>
              <a href="#" id="history" onclick="showContent(id)">ประวัติการจอง</a>
              <a href="#" id="changepassword" onclick="showContent(id)">เปลี่ยนแปลงรหัสผ่าน</a>
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
              <a href="#" id="education" onclick="showContent(id)">ข้อมูลการศึกษา</a>
              <a href="#" id="parents" onclick="showContent(id)">ข้อมูลของครอบครัว</a>
              <a href="#" id="history" onclick="showContent(id)">ประวัติการจอง</a>
              <a href="#" id="changepassword" onclick="showContent(id)">เปลี่ยนแปลงรหัสผ่าน</a>
          </div>
        </aside>

        <article id="article-content">
      
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
