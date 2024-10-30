<?php 
    include "connect.php";

    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }else{
        $term = $pdo->prepare("SELECT Duration_id, Start_date , End_date FROM `Post_Duration` WHERE Reservation = 1 AND Event_status = 1 AND Duration_id LIKE '%OLD%' ORDER BY Start_date DESC");
        $term->execute();
        $this_term = $term->fetch();
        $this_term_id = $this_term["Duration_id"];

        $start = $this_term["Start_date"];
        $end = $this_term["End_date"];

        $IsReserved = $pdo->prepare("SELECT COUNT(reservation_id) as 'found' FROM Reservation WHERE national_id = ? AND duration_id = ?");
        $IsReserved->bindParam(1,$_SESSION['national_id']);
        $IsReserved->bindParam(2,$this_term_id);
        $IsReserved->execute();
        $IsfoundReservation = $IsReserved->fetch();
        if($IsfoundReservation['found'] != 0){
            header("location: reservation-notification.php");
        }
        else{
            $checklist_term = $pdo->prepare("SELECT Duration_id FROM `Post_Duration` WHERE Checklist = 1 AND Event_status = 1 ORDER BY Start_date DESC");
            $checklist_term->execute();
            $checklist_this_term = $checklist_term->fetch();
            $checklist_this_term_id = $checklist_this_term["Duration_id"];
    
            $stmt = $pdo->prepare("SELECT COUNT(checklist_id) AS 'row', checklist_id FROM Checklist WHERE duration_id = ? AND national_id = ?");
            $stmt->bindParam(1,$checklist_this_term_id);
            $stmt->bindParam(2,$_SESSION["national_id"]);
            $stmt->execute();
            $Isfound = $stmt->fetch();
            if ($Isfound['row'] == 0){
                header("location: checklist.php");
            }
            else{
                $User_checklist_id = $Isfound["checklist_id"];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reservation.css">
    <script src="javascript/reservation.js"></script>
</head>
<body onload="GetDuration('<?= $start ?>','<?= $end ?>')">
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
            <h1 id="calendar-title"></h1>
            <table id="calendar">
                <thead style="color: black;">
                    <th class="sun">SUN</th>
                    <th class="mon">MON</th>
                    <th class="tue">TUE</th>
                    <th class="wed">WED</th>
                    <th class="thu">THU</th>
                    <th class="fri">FRI</th>
                    <th class="sat">SAT</th>
                </thead>
                <tbody id="calendar-body">

                </tbody>
            </table>
            <br>
            <div class="bt-previous-next">
                <button type="button" class="bt-previous" id="previous" value="previous" onclick="ScrollMonth(id)">Previous</button>
                <button type="button" class="bt-next" id="next" value="next" onclick="ScrollMonth(id)">Next</button>
            </div>
            <form action="reservation_validation.php" method="post">
                <input type="hidden" name="reservation_duration_id" value="<?=$this_term_id?>">
                <input type="hidden" name="checklist_id" value="<?=$User_checklist_id?>">
                <input type="hidden" name="national_id" value="<?=$_SESSION["national_id"]?>">
                <input type="hidden" name="reservation_date" id="reservation_date_id" value="" required>
                <div class="bt-reservation_round_bt">
                    <button type="button" class="reservation_round_bt" id="round-morning" value="09:00:00" onclick="selected_round(id)" disabled>09:00</button>
                    <button type="button" class="reservation_round_bt" id="round-noon" value="13:00:00" onclick="selected_round(id)" disabled>13:00</button>
                </div>
                <input type="hidden" name="selected_reservation_round" id="select_round_id" value="" required>
                <div class="div-submit-btn">
                    <input type="submit" value="ยืนยันการจอง" class="submit-btn" id="submit_bt_id" disabled>
                </div>
                <br>
                <p style="color: red; font-size: 16px;"><span style="color: red; font-size: 16px; font-weight:bold;">หมายเหตุ : </span> หากนักศึกษาไม่อยู่รับบริการในช่วงเรียกคิว ทางเจ้าหน้าที่.ขอสงวนสิทธิ์ในการข้ามคิว</p>
            </form>

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