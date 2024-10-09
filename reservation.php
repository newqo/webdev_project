<?php include "connect.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="css/checklist_reservation.css" rel="stylesheet">
    <script>
        
    </script>
</head>
<body>
    <section class="container">
        <article>
            <label style="font-size: 20px; display: flex; justify-content: center;">วันที่จอง</label>
            <table id="calendar">
                <tr style="color: black;">
                    <th class="sun">SUN</th>
                    <th class="mon">MON</th>
                    <th class="tue">TUE</th>
                    <th class="wed">WED</th>
                    <th class="thu">THU</th>
                    <th class="fri">FRI</th>
                    <th class="sat">SAT</th>
                </tr>
                <tr style="color: #329D9c;">
                    <td class="sun"></td>
                    <td class="mon"></td>
                    <td class="tue">01</td>
                    <td class="wed">01</td>
                    <td class="thu">01</td>
                    <td class="fri">01</td>
                    <td class="sat">01</td>
                </tr>
                <tr style="color: #329D9c;">
                    <td class="sun">01</td>
                    <td class="mon">01</td>
                    <td class="tue">01</td>
                    <td class="wed">01</td>
                    <td class="thu">01</td>
                    <td class="fri">01</td>
                    <td class="sat">01</td>
                </tr>
                <tr style="color: #329D9c;">
                    <td class="sun">01</td>
                    <td class="mon">01</td>
                    <td class="tue">01</td>
                    <td class="wed">01</td>
                    <td class="thu">01</td>
                    <td class="fri">01</td>
                    <td class="sat">01</td>
                </tr>
                <tr style="color: #329D9c;">
                    <td class="sun">01</td>
                    <td class="mon">01</td>
                    <td class="tue">01</td>
                    <td class="wed">01</td>
                    <td class="thu">01</td>
                    <td class="fri">01</td>
                    <td class="sat">01</td>
                </tr>
                <tr style="color: #329D9c;">
                    <td class="sun">01</td>
                    <td class="mon">01</td>
                    <td class="tue">01</td>
                    <td class="wed">01</td>
                    <td class="thu">01</td>
                    <td class="fri"></td>
                    <td class="sat"></td>
                </tr>
            </table>
            
            <br>

        </article>

        <article>
            <label>เวลา</label>

            <form class="form-container" action="" method>

                <div style="display: inline-block;">
                    <input type="radio" id="time_9" name="reserve_time" value="09:00:00"><label for="time_9" class="radio-label">รอบเช้า 9:00 น.</label>
                    
                    <input type="radio" id="time_13" name="reserve_time" value="13:00:00"><label for="time_13" class="radio-label">รอบบ่าย 13:00 น.</label>
                    
                </div>
                <div class="setcenter"> 
                    <button type="button" id="addInformation" class="addInformation" onclick="submitDetail(event)">ยืนยัน</button>
                </div>
            </form>
            </article>
            <article>
                <?php
                    $stmt = $pdo->prepare("SELECT 
    CONCAT(
        DATE_FORMAT(NOW(), '%e'), ' ',
        CASE MONTH(NOW())
            WHEN 1 THEN 'มกราคม'
            WHEN 2 THEN 'กุมภาพันธ์'
            WHEN 3 THEN 'มีนาคม'
            WHEN 4 THEN 'เมษายน'
            WHEN 5 THEN 'พฤษภาคม'
            WHEN 6 THEN 'มิถุนายน'
            WHEN 7 THEN 'กรกฎาคม'
            WHEN 8 THEN 'สิงหาคม'
            WHEN 9 THEN 'กันยายน'
            WHEN 10 THEN 'ตุลาคม'
            WHEN 11 THEN 'พฤศจิกายน'
            WHEN 12 THEN 'ธันวาคม'
        END, ' ',
        DATE_FORMAT(NOW(), '%Y')+543
    ) AS 'วัน',
    DATE_FORMAT(reserve_time, '%H:%i') AS 'เวลา' ,queue_no AS 'คิว'
FROM `Reservation`
ORDER BY reserve_date ASC;"); //WHERE national_id=?
                    $stmt->execute();
                    $row = $stmt->fetch();
                ?>
                <div id="complete_reservation" style="font-size: 20px; display:flex; justify-content:center; ">
                    <p>จองวัน <?=$row["วัน"]?></p> 
                    <p>เวลา <?=$row["เวลา"]?></p> 
                    <p>คิวที่ <?=$row["คิว"]?></p>
                </div>
                <p>หมายเหตุ: หากนักศึกษาไม่อยู่รับบริการในช่วงเรียกคิว ทางกยศ.ขอสงวนสิทธิ์ในการข้ามคิว</p>

                <div class="setcenter">
                    <a href="homepage.php">กลับหน้าหลัก</a>
                </div>
            </article>


    </section>

        
    
</body>
</html>