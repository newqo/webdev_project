<?php include"connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    *{
        box-sizing: border-box;
        font-family: 'Kanit', sans-serif;
        word-wrap: break-word;
        overflow-wrap: break-word;
        font-size: 18px;
    }
    body{
        background-image: linear-gradient(to top right, #329D9c, #cff4d2, #ffffff);
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        position: relative;
    }
    .container{
        margin: 10px 100px;
        padding: 12px 25px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        display: flex;
    }
    div a{
        display: block;
        margin: 10%;
        text-decoration: none;
        color: black;
    }
    nav{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 12px;
        margin-right: 1% ;
        border: 2px solid rgb(0,0,0,0.3); 
        width: 20%;
        height: 90vh;
        position: fixed;
    }
    section{
        width: 80%;
        padding-left: 10%;
        margin-left: 20%;
    }
    form{
        box-sizing: border-box;
        border: 2px solid rgb(0,0,0,0.3);
        border-radius: 5px;
        padding: 1% 1%;
        text-align: center;
        justify-items: center;
        overflow: auto;
        white-space: nowrap;
    }
    .showCountInfo{
        display: flex;
        flex-basis: 100%;
    }
    .boxShowCountInfo{
        border: 2px solid rgb(0,0,0,0.3);
        border-radius: 5px;
        padding: 1%;
        margin: 2%;
        flex-basis: 25%;
        text-align: center;
        justify-items: center;
        display: inline-block;
    }
    h2{
        font-size: 27px;
    }
    table{
        border-collapse: collapse;
        width: 100%;
    }
    .btn{
        border: 1px solid;
        border-radius: 35px;
        margin: 5px;
    }
    .editt{
        color: #329D9c;
    }
    .del{
        color: #D75044;
    }
    tr:not(:first-child):hover{
        background-color: rgb(0,0,0,0.1);
    }
    /* .user-management{
        overflow: auto;
        white-space: nowrap;
    } */
    @media only screen and (max-width: 1024px){
        *{
            font-size: 16px;
        }
        .container{
            padding: 5%;
        }
        nav{
            border: 1px solid rgb(0,0,0,0.3); 
        }
        .boxShowCountInfo{
            border: 1px solid rgb(0,0,0,0.3);
        }
    }
    @media only screen and (max-width: 430px){
        *{
            font-size: 14px;
            text-align: -webkit-center;
        }
        .container{
            display: inline-block;
            margin: auto;
        }
        nav{
            display: none;
            width: 100%;
            border: 1px solid rgb(0,0,0,0.3); 
        }
        .boxShowCountInfo{
            border: 1px solid rgb(0,0,0,0.3);
            border-radius: 15px;
            padding: 10%;
            margin: 10%;
            flex: 1;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .showCountInfo{
            display: flex;
            flex-wrap: wrap;
        }
        form{
            border: 1px solid rgb(0,0,0,0.3);
            
        }
    }
</style>
<body>
    <div class="container">
        <nav  >
            <div>
                <a href="#showCountInfo" >Dashboard</a>
                <a href="#user-management" >User Management</a>
                <a href="#" >Information Management</a>
            </div>
            <div>
                <a href="#" >Log out</a>
            </div>

        </nav>
        
        <section>
            <div class="showCountInfo" id="showCountInfo">
                <div class="boxShowCountInfo">
                    <p>จำนวนรวมผู้กู้ทั้งหมด</p>
                    <h2>132</h2>
                </div>
                <div class="boxShowCountInfo">
                    <p>จำนวนรวมผู้กู้เทอมล่าสุด</p>
                    <h2>132</h2>
                </div>
                <div class="boxShowCountInfo">
                    <p>จำนวนผู้กู้รายใหม่</p>
                    <p>(เทอมล่าสุด)</p>
                    <h2>132</h2>
                </div>
                <div class="boxShowCountInfo">
                    <p>จำนวนผู้กู้รายเก่า</p>
                    <p>(เทอมล่าสุด)</p>
                    <h2>132</h2>
                </div>
            </div>
    
            <form>
                <h1>ประวัติการจอง</h1>
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
                  <td><a class='editt btn' href='checklist.php'>แก้ไข</a></td>
                  <td><a class='del btn' href='checklist.php'>ลบ</a></td>
                  </tr>";
                }
                
                echo "</table>"
                
                ?>
                </form>
                
                <br>
                
                <form class="user-management" id="user-management">
                    <h1>User Management</h1>
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
                
            
        </section>

    </div>
</body>
</html>