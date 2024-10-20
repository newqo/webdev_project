
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSL Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">
    <script src="javascript/homepage.js"></script>
    <script src="https://kit.fontawesome.com/9703a87d5d.js" crossorigin="anonymous"></script>
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
  
              <a href="#contect">ติดต่อเรา</a>
              <div class="section-title-menu-mobile">หมวดหมู่</div>
                <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
                <a href="#" id="education" onclick="showContent(id)">ข้อมูลการศึกษา</a>
                <a href="#" id="parents" onclick="showContent(id)">ข้อมูลของครอบครัว</a>
                <a href="#" id="history" onclick="showContent(id)">ประวัติการจอง</a>
                <a href="#" id="changepassword" onclick="showContent(id)">เปลี่ยนแปลงรหัสผ่าน</a>
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
                <a href="#checklist_announcement">ลงทะเบียน</a>
                <a href="#reservation_announcement_old_user">ผู้กู้รายเก่า</a>
                <a href="#reservation_announcement_new_user">ผู้กู้รายใหม่</a>
              </div>
              <a href="#contect">ติดต่อเรา</a>
            </div>
            <div class="dropdown-menu-user">
              <div class="drop-menu-user-btn">
                <button onclick="myFunctionUser()">เข้าสู่ระบบ</button>
              </div>
              <div class="dropdown-content-user" id="myDropdown-menu-user">
                <a href="#" id="student" onclick="showContent(id)">ข้อมูลส่วนตัวนักศึกษา</a>
                <a href="#" id="education" onclick="showContent(id)">ข้อมูลการศึกษา</a>
                <a href="#" id="parents" onclick="showContent(id)">ข้อมูลของครอบครัว</a>
                <a href="#" id="history" onclick="showContent(id)">ประวัติการจอง</a>
                <a href="#" id="changepassword" onclick="showContent(id)">เปลี่ยนแปลงรหัสผ่าน</a>
                <a href="#">Dashboard</a>
                <a href="#">ออกจากระบบ</a>
              </div>
            </div>
          </div>
        </nav>
      </header>
    <main>
        <!-- Checklist and Reservation -->
         <div class="title-home">
          <span>ลงทะเบียน CHECK LIST และ จองคิวส่งเอกสาร</span>
          <p>สำหรับผู้กู้รายใหม่และผู้กู้รายเก่า</p>
         </div>

          <section class="reservation_and_checklist_announcement">
            <article class="checklist" id="checklist_announcement">
                <h3>ลงทะเบียนขอรับใบรายการเอกสาร CHECK LIST</h3>
                <li>รอบใช้สิทธ์ขอลงทะเบียนเรียนโดยไม่ต้องสำรองจ่ายค่าเทอม (ล็อกรหัส)</li>
                <li>สำหรับผู้ที่มีความประสงค์จะกู้ กยศ. ให้ลงทะเบียนขอรับใบรายการเอกสาร หรือ Check List <span style="font-weight: 300;">สามารถทำได้ไม่จำกัดจำนวนครั้ง หากมีข้อมูลที่ไม่ถูกต้อง/ไม่ได้รับอีเมลให้ทำใหม่ได้เลย</span></li>
                <li>เริ่มวันที่ 23 ก.ย 2567 เวลา 10.00 น. <span style="color: #ff6f61; font-weight: bold; text-decoration: underline;">หมดเขตวันที่ 30 ก.ย 2567 เวลา 23.59 น.</span></li>
                <li>หากทำ Check List จากพ้นกำหนดนี้แล้ว การลงทะเบียนเรียนจะต้องสำรองจ่ายค่าเทอมเองทุกกรณี</li>
                <a href="checklist.php">ลงทะเบียน CHECK LIST</a>
            </article>
            <article class="reservation" id="reservation_announcement_old_user">
                <h3>จองคิวนัดส่งเอกสารสำหรับผู้กู้รายเก่า</h3>
                <p><strong>ผู้กู้รายเก่า</strong> เริ่มวันที่ 1 ตุลาคม 2567 เวลา 10.00 น. <span style="color: #ff6f61; font-weight: bold; text-decoration: underline;">หมดเขตวันที่ 10 ตุลาคม 2567 เวลา 23.59 น.</span></p>
                <a href="checklist.php">จองคิวนัดส่งเอกสาร</a>
            </article>
            <article class="reservation" id="reservation_announcement_new_user">
                <h3>จองคิวนัดส่งเอกสารสำหรับผู้กู้รายใหม่</h3>
                <p><strong>ผู้กู้รายใหม่</strong> เริ่มวันที่ 11 ตุลาคม 2567 เวลา 10.00 น. <span style="color: #ff6f61; font-weight: bold; text-decoration: underline;">หมดเขตวันที่ 20 ตุลาคม 2567 เวลา 23.59 น.</span></p>
                <a href="checklist.php">จองคิวนัดส่งเอกสาร</a>
            </article>
        </section>

        <!-- Contact -->
        <section class="contact-broad" id="contect">
          <div class="section-title">ติดต่อ กยศ. มจพ.</div>
            <p>ให้บริการในวันและเวลาราชการ</p><br>
            <div class="location">
                <h2>มจพ. กรุงเทพฯ</h2>
                <p>กลุ่มงานสวัสดิการนักศึกษา</p>
                <ul>
                    <li></i><p><i class="fa-solid fa-location-dot" style="color: #ff6f61;"></i> ชั้น 4 (ฝั่งสนามบาสเกตบอล) อาคาร 40 ปี มจพ.</p></li>
                    <li><p><i class="fa-solid fa-phone" style="color: #ff6f61;"></i> 0 2555 2000 ต่อ 1150, 1161</p></li>
                </ul>
            </div>
            <div class="location">
                <h2>มจพ. วิทยาเขตปราจีนบุรี</h2>
                <p>กลุ่มงานกิจการนักศึกษา มจพ. วิทยาเขตปราจีนบุรี</p>
                <ul>
                    <li></i><p><i class="fa-solid fa-location-dot" style="color: #ff6f61;"></i> ชั้น 1 ห้อง 103 อาคารบริหาร</p></li>
                    <li><p><i class="fa-solid fa-phone" style="color: #ff6f61;"></i> 037 217300 ต่อ 7331</p></li>
                </ul>
            </div>
            <div class="location">
                <h2>มจพ. วิทยาเขตระยอง</h2>
                <p>กลุ่มงานกิจการนักศึกษา มจพ. วิทยาเขตระยอง</p>
                <ul>
                    <li></i><p><i class="fa-solid fa-location-dot" style="color: #ff6f61;"></i> ชั้น 3 อาคารวิทยาศาสตร์การกีฬาและโรงอาหาร</p></li>
                    <li><p><i class="fa-solid fa-phone" style="color: #ff6f61;"></i> 038 627000 ต่อ 5195</p></li>
                </ul>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="footer-content">
          <div class="footer-section about">
            <h2>เกี่ยวกับเรา</h2>
            <p>
              เว็บไซต์ของเราให้บริการจองและลงทะเบียนที่เกี่ยวข้องกับการกู้ยืม กยศ.มจพ.
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
            <a href="https://www.facebook.com/profile.php?id=100066829755038" target=_blank><i class="fab fa-facebook-f"></i> กยศ_kmutnb</a><br>
            <a href="https://liff.line.me/1645278921-kWRPP32q/?accountId=sa.kmutnb" target=_blank><i class="fab fa-line"></i> กิจการนักศึกษา มจพ.</a>
          </div>
        </div>
        <div class="footer-bottom">
          &copy; 2024 All Rights Reserved
        </div>
      </footer>
</body>
</html>