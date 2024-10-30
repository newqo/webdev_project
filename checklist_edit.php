<?php 
    include "connect.php";
    
    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }else{
        $term = $pdo->prepare("SELECT Duration_id FROM `Post_Duration` WHERE Checklist = 1 AND Event_status = 1 ORDER BY Start_date DESC");
        $term->execute();
        $this_term = $term->fetch();
        $this_term_id = $this_term["Duration_id"];

        $stmt = $pdo->prepare("SELECT * FROM `Checklist` 
                        WHERE national_id = ? and duration_id = ?");
        $stmt->bindParam(1,$_SESSION["national_id"]);
        $stmt->bindParam(2,$this_term_id);
        $stmt->execute();
        $User = $stmt->fetch();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="css/checklist_reservation.css" rel="stylesheet">
    <script src="javascript/checklist.js"></script>
</head>
<body onload="submitDetail(<?=$_SESSION['user_category']?>)">
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
    <section class="container">
        <article>
        <form class="form-container" action="update_checklist.php" method="post">
            <input type="hidden" name="this_term" id="" value="<?=$this_term_id?>">
            <input type="hidden" name="checklist_id" id="" value="<?=$User["checklist_id"]?>">
            <input type="hidden" name="national_id" id="" value="<?=$User["national_id"]?>">
            <div>
            <label>ผู้กู้ประสงค์ขอกู้ยืมเงินค่าครองชีพ (รายเดือน)</label>
            <br>
            <?php
                $CostoflivingId_selected = $User["cost_of_living_id"];
                
            ?>
            <input type="radio" id="costofliving-yes" name="cost_of_living_id" value="1"
            <?php
                echo ($CostoflivingId_selected == 1) ? 'checked' : '';
            ?>
            required/>
            <label for="costofliving-yes">ประสงค์รับค่าครองชีพ</label>
            <br>
            <input type="radio" id="costofliving-no" name="cost_of_living_id" value="0" 
            <?php
                echo ($CostoflivingId_selected == 0) ? 'checked' : '';
            ?>
            required/>
            <label for="costofliving-no" >ไม่ประสงค์รับค่าครองชีพ</label>

            <br><br>
            <label>ทุน</label>
            <select name="scholarship_selected" id="scholarship_id" required>
                <option value="">--กรุณาเลือกชื่อทุน--</option>
                <?php
                    $User_scholarship = $User["scholarship_id"];
                    
                    $query = $pdo->prepare("SELECT * FROM Scholarship");
                    $query->execute();
                    while($option = $query->fetch()){
                        $IsSelected_scholarship = ($User_scholarship == $option["scholarship_id"]) ? 'selected' : '';
                        echo "<option value='". $option["scholarship_id"] ."'". $IsSelected_scholarship .">". $option["scholarship_name"] ."</option>";
                    }
                ?>
                <!-- <option value="1">ทุนนักศึกษาที่สร้างชื่อเสียงดีเด่นให้แก่สถาบัน</option>
                <option value="2">ทุนผู้มีความสามารถพิเศษ</option>
                <option value="3">ทุนขาดแคลน</option>
                <option value="4">ทุนเฉลิมราชกุมารี</option>
                <option value="5">ทุนอุดมศึกษาเพื่อการพัฒนาจังหวัดชายแดนภาคใต้</option>
                <option value="6">ทุนอุดหนุนการศึกษาประเภทขาดแคลนแก่นักศึกษาโครงการสมทบพิเศษ (เฉพาะคณะวิทยาศาสตร์ประยุกต์)</option> -->
            </select>
            </div>
            <div class="setcenter">
                <button type="submit" id="addInformation" class="addInformation">ลงทะเบียน</button>
            </div>

        </form>
        </article>
        <br>
        <article>
        <table id="document-table">

            <tr>
                <th class="doc-column">รายการเอกสาร</th>
                <th class="amount-column">จำนวน</th>
                <th class="condition-column">เงื่อนไข</th>
            </tr>

            <tr>
                <td class="doc-column">แบบยืนยันการเบิกเงินกู้ยืม จากระบบ DSL</td>
                <td class="amount-column">2 แผ่น
                </td>
                <td class="condition-column">เริ่มทำได้หลังจากจองคิวใน Google From ไปแล้ว 48 ชม.</td>
            </tr>

            <tr>
                <td class="doc-column">สัญญากู้ยืมเงินกองทุน กยศ. จากระบบ DSL</td>
                <td class="amount-column">2 ชุด
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">สำเนาบัตรประชาชนผู้กู้ยืม</td>
                <td class="amount-column">2 แผ่น
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">เอกสารแสดงผลการลงทะเบียน 1/2567</td>
                <td class="amount-column">1 ชุด
                </td>
                <td class="condition-column">ในระบบ reg.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">เอกสารแสดงค่าใช้จ่าย/ทุน 1/2567</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">ในระบบ reg.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">สำเนาใบเสร็จรับเงินค่าเทอม 1/2567</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">ในระบบ rco.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">บันทึกกิจกรรมจิตอาสาไม่น้อยกว่า 36 ชั่วโมง</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">หนังสือยินยอมเปิดเผยข้อมูล</td>
                <td class="amount-column">1 ชุด
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column" id="doc_column_grade">รอการกดยืนยัน</td>
                <td class="amount-column">คนละ 1 ชุด
                </td>
                <td class="condition-column" id="condition_column_grade">รอการกดยืนยัน</td>
            </tr>
            
        </table>

        <div class="document-mobile">
            <br>
            <b style="font-size: 15px; color: #56C596;">รายการเอกสาร</b>
            <p style="font-size: 14px;">แบบยืนยันการเบิกเงินกู้ยืม จากระบบ DSL</p>
            <b class="b-doc-mobile">จำนวน</b>
            <p style="font-size: 14px;">2 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">เริ่มทำได้หลังจากจองคิวใน Google From ไปแล้ว 48 ชม.</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สัญญากู้ยืมเงินกองทุน กยศ. จากระบบ DSL</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">2 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สำเนาบัตรประชาชนผู้กู้ยืม</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">2 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">เอกสารแสดงผลการลงทะเบียน 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ reg.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">เอกสารแสดงค่าใช้จ่าย/ทุน 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ reg.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สำเนาใบเสร็จรับเงินค่าเทอม 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ rco.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">บันทึกกิจกรรมจิตอาสาไม่น้อยกว่า 36 ชั่วโมง</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">หนังสือยินยอมเปิดเผยข้อมูล</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p id="doc_column_grade_mobile" style="font-size: 14px;">รอการกดยืนยัน</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">คนละ 1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p id="condition_column_grade_mobile" style="font-size: 14px;">รอการกดยืนยัน</p>
            <hr>
            
        </div>

        <div class="setcenter">
            <a href="homepage.php" class="back_home-btn">กลับหน้าหลัก</a>
        </div>
        </article>

    </section>
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