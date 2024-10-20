<?php include"connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav>
            <div>
                <a href="#showCountInfo_id" >Dashboard</a>
                <a href="#user-management_id" >User Management</a>
                <a href="#information-management_id" >Information Management</a>
            </div>
            <div>
                <a href="#" >Log out</a>
            </div>

        </nav>
        
        <section>
            <div class="showCountInfo" id="showCountInfo_id">
                <?php
                    $query1 = $pdo->prepare("SELECT COUNT(Reservation.reservation_id) AS 'จำนวนรวมผู้กู้ทั้งหมด' FROM Reservation;");
                    $query1->execute();
                    $query_total=$query1->fetch();
                ?>
                <div class="boxShowCountInfo">
                    <p>จำนวนรวมผู้กู้ทั้งหมด</p>
                    <h2><?=$query_total["จำนวนรวมผู้กู้ทั้งหมด"]?></h2>
                </div>
                <?php
                    $query2 = $pdo->prepare("SELECT COUNT(Reservation.Duration_id) AS 'จำนวนรวมผู้กู้เทอมล่าสุด' FROM Reservation INNER JOIN Post_Duration ON Reservation.duration_id=Post_Duration.Duration_id WHERE Post_Duration.Reservation = 1 AND Post_Duration.Event_status = 1 ORDER BY Post_Duration.Start_date DESC;");
                    $query2->execute();
                    $query_term = $query2->fetch();
                ?>                
                <div class="boxShowCountInfo">
                    <p>จำนวนรวมผู้กู้เทอมล่าสุด</p>
                    <h2><?=$query_term["จำนวนรวมผู้กู้เทอมล่าสุด"]?></h2>
                </div>
                <?php
                    $query3 = $pdo->prepare("SELECT COUNT(Reservation.Duration_id) AS 'จำนวนผู้กู้รายใหม่' FROM Reservation INNER JOIN Post_Duration ON Reservation.duration_id=Post_Duration.Duration_id WHERE Post_Duration.Reservation = 1 AND Post_Duration.Event_status = 1 AND Reservation.duration_id LIKE 'R_NEW%' ORDER BY Post_Duration.Start_date DESC;");
                    $query3->execute();
                    $query_term_new = $query3->fetch();
                ?>
                <div class="boxShowCountInfo">
                    <p>จำนวนผู้กู้รายใหม่</p>
                    <p>(เทอมล่าสุด)</p>
                    <h2><?=$query_term_new["จำนวนผู้กู้รายใหม่"]?></h2>
                </div>
                <?php
                    $query4 = $pdo->prepare("SELECT COUNT(Reservation.Duration_id) AS 'จำนวนผู้กู้รายเก่า' FROM Reservation INNER JOIN Post_Duration ON Reservation.duration_id=Post_Duration.Duration_id WHERE Post_Duration.Reservation = 1 AND Post_Duration.Event_status = 1 AND Reservation.duration_id LIKE 'R_OLD%' ORDER BY Post_Duration.Start_date DESC;");
                    $query4->execute();
                    $query_term_old = $query4->fetch();
                ?>
                <div class="boxShowCountInfo">
                    <p>จำนวนผู้กู้รายเก่า</p>
                    <p>(เทอมล่าสุด)</p>
                    <h2><?=$query_term_old["จำนวนผู้กู้รายเก่า"]?></h2>
                </div>
            </div>
    
            <form>
                <h3>ประวัติการจอง</h3>
                <select>
                    <option>รายคน</option>
                    <option>รายสัปดาห์</option>
                    <option selected>รายเทอม</option>
                </select>
                <input type="date" name="party" min="2024-10-12" max="2024-10-30" /><br>
                <?php
              $stmt = $pdo->prepare("SELECT Reservation.national_id AS 'ID',Pre_name.Pre_name_desc AS 'คำนำหน้า',Users.firstname AS 'ชื่อ',Users.lastname AS 'นามสกุล',Reservation.reserve_date AS 'วัน',Reservation.reserve_time AS 'เวลา',Reservation.queue_no AS 'คิวที่' FROM Reservation INNER JOIN Users ON Reservation.national_id=Users.national_id INNER JOIN Pre_name ON Pre_name.Pre_name_id=Users.Pre_name_id ORDER BY วัน ASC, 'เวลา' ASC , 'คิวที่' ASC;");
              $stmt->execute();
              
              echo "<br>
              <table border='1'>
              <tr>
                <th>ID</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>วัน</th>
                <th>เวลา</th>
                <th>คิวที่</th>
               
              </tr>
              ";
              while ($row = $stmt->fetch()) {
                  echo "
                  <tr onclick='window.location.href=\"checklist.php\"'>
                  <td>" .$row["ID"] ."</td>
                  <td>" .$row["คำนำหน้า"] ."</td>
                  <td>" .$row["ชื่อ"] ."</td>
                  <td>" .$row["นามสกุล"] ."</td>
                  <td>" .$row["วัน"] ."</td>
                  <td>" .$row["เวลา"] ."</td>
                  <td>" .$row["คิวที่"] ."</td>
                  <td><a class='editt btn' href='reservation.php'>แก้ไข</a></td>
                  <td><a class='del btn' href='#'>ลบ</a></td>
                  </tr>";
                }
                
                echo "</table>"
                
                ?>
                </form>
                
                <br>
                
                <form class="user-management" id="user-management_id">
                    <h3>User Management</h3>
                    <select name="user_cate_selected" id="user_cate_id">
                    <option value="">--กรุณาเลือกประเภทผู้กู้--</option>
                <?php
                    $stmtU = $pdo->prepare("SELECT * FROM User_category");
                    $stmtU->execute();
                    while($row=$stmtU->fetch()){
                        echo "<option value='".$row["user_cate_id"]."'>". $row["category_desc"] ."</option>";
                    }
                ?>
                    </select>
                    <input type="text" name="keyword" />
                    <input type="submit" value="ค้นหา" />
                    <br>
                    <?php
                  $stmt2 = $pdo->prepare("SELECT User_category.category_desc AS 'ประเภทผู้กู้',Users.national_id AS 'ID' , Pre_name.Pre_name_desc AS 'คำนำหน้า' ,Users.firstname AS 'ชื่อ',Users.lastname AS 'นามสกุล',Education_Level_Category.ed_desc AS 'ชั้นปี',Faculty.Faculty_name AS 'คณะ',Department.Department_name AS 'สาขา',Users.Email AS 'อีเมลล์',Users.phone_num AS 'เบอร์โทรศัพท์',Users.birthdate AS 'วันเดือนปีเกิด',Users.Address AS 'ที่อยู่' FROM Users INNER JOIN Pre_name ON Users.Pre_name_id=Pre_name.Pre_name_id INNER JOIN User_category ON Users.user_cate_id=User_category.user_cate_id INNER JOIN Education ON Users.national_id=Education.national_id INNER JOIN Education_Level_Category ON Education.Education_Level=Education_Level_Category.ed_category_id INNER JOIN Faculty ON Education.Faculty_id=Faculty.Faculty_id INNER JOIN Department ON Department.Department_id=Education.Department_id;");
                  $stmt2->execute();
                  
                  echo "<br>
                  <table border='1'>
                  <tr>
                    <th>ประเภทผู้กู้</th>
                    <th>ID</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ชั้นปี</th>
                    <th>คณะ</th>
                    <th>สาขา</th>
                    <th>อีเมลล์</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>วันเดือนปีเกิด</th>
                    <th>ที่อยู่</th>
                   
                  </tr>
                  ";
                  while ($row = $stmt2->fetch()) {
                      echo "
                      <tr onclick='window.location.href=\"checklist.php\"'>
                      <td>" .$row["ประเภทผู้กู้"] ."</td>
                      <td>" .$row["ID"] ."</td>
                      <td>" .$row["คำนำหน้า"] ."</td>
                      <td>" .$row["ชื่อ"] ."</td>
                      <td>" .$row["นามสกุล"] ."</td>
                      <td>" .$row["ชั้นปี"] ."</td>
                      <td>" .$row["คณะ"] ."</td>
                      <td>" .$row["สาขา"] ."</td>
                      <td>" .$row["อีเมลล์"] ."</td>
                      <td>" .$row["เบอร์โทรศัพท์"] ."</td>
                      <td>" .$row["วันเดือนปีเกิด"] ."</td>
                      <td>" .$row["ที่อยู่"] ."</td>
                      <td><a class='editt btn' href='checklist.php'>แก้ไข</a></td>
                      <td><a class='del btn' href='checklist.php'>ลบ</a></td>
                      </tr>";
                    }
                    
                    echo "</table>"
                    
                    ?>
                    </form>
                
                
                <br>
                
                <form class="information-management" id="information-management_id">
                    <h3>Information Management</h3>
                    <div class="add_btn_div"><p>Checklist</p><a class='add_btn' href='dashboard_add_checklist.php?Duration=".$row["ID"]."'>เพิ่ม</a></div>
                    <?php
                  $stmt3 = $pdo->prepare("SELECT Post_Duration.Duration_id AS 'ID',Post_Duration.Start_date AS 'วันเวลาเริ่มต้น',Post_Duration.End_date AS 'วันเวลาสิ้นสุด',Post_Duration.Event_status AS 'Status' FROM Post_Duration WHERE Post_Duration.Duration_id LIKE 'C%';");
                  $stmt3->execute();
                  
                  echo "
                  <table border='1'>
                  <tr>
                    <th>ID</th>
                    <th>วันเวลาเริ่มต้น</th>
                    <th>วันเวลาสิ้นสุด</th>
                    <th>Status</th>
                  </tr>
                  ";
                  while ($row = $stmt3->fetch()) {
                      echo "
                      <tr onclick='window.location.href=\"checklist.php\"'>
                      <td>" .$row["ID"] ."</td>
                      <td>" .$row["วันเวลาเริ่มต้น"] ."</td>
                      <td>" .$row["วันเวลาสิ้นสุด"] ."</td>
                      <td>" .$row["Status"] ."</td>
                      <td><a class='editt btn' href='dashboard_edit_checklist.php?Duration_id=".$row["ID"]."'>แก้ไข</a></td>
                      <td><a class='del btn' href='dashboard_add_checklist.php?Duration=".$row["ID"]."'>ลบ</a></td>
                      </tr>";
                    }
                    
                    echo "</table>"
                    
                    ?>

                    <div class="add_btn_div"><p>Reservation</p><a class='add_btn' href='checklist.php'>เพิ่ม</a></div>
                    <?php
                  $stmt3 = $pdo->prepare("SELECT Post_Duration.Duration_id AS 'ID',Post_Duration.Start_date AS 'วันเวลาเริ่มต้น',Post_Duration.End_date AS 'วันเวลาสิ้นสุด',Post_Duration.Event_status AS 'Status' FROM Post_Duration WHERE Post_Duration.Duration_id LIKE 'R%';");
                  $stmt3->execute();
                  
                  echo "
                  <table border='1'>
                  <tr>
                    <th>ID</th>
                    <th>วันเวลาเริ่มต้น</th>
                    <th>วันเวลาสิ้นสุด</th>
                    <th>Status</th>
                  </tr>
                  ";
                  while ($row = $stmt3->fetch()) {
                      echo "
                      <tr onclick='window.location.href=\"checklist.php\"'>
                      <td>" .$row["ID"] ."</td>
                      <td>" .$row["วันเวลาเริ่มต้น"] ."</td>
                      <td>" .$row["วันเวลาสิ้นสุด"] ."</td>
                      <td>" .$row["Status"] ."</td>
                      <td><a class='editt btn' href='checklist.php'>แก้ไข</a></td>
                      <td><a class='del btn' href='checklist.php'>ลบ</a></td>
                      </tr>";
                    }
                    
                    echo "</table>"
                    
                    ?>


                    </form>
                
            
        </section>

    </div>
</body>
</html>