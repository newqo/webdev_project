<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSL Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>
    <nav>
        <ul class="menu-bar">
            <li><a href="homepage.php"><img src="imgs/Student_Loan_logo.svg" alt="" width="64px" height="64px"></a></li>
            <li><a href="">หน้าหลัก</a></li>
            <li><a href="">บริการ</a></li>
            <li><a href="">ติดต่อเรา</a></li>
        </ul>
    </nav>
    <section class="announcement-image">

    </section>
    <main>
        <!-- Checklist and Reservation -->
        <section class="reservation_and_checklist_announcement">
            <h1>ประกาศ Checklist และประกาศการจองคิวนัดส่งเอกสาร</h1>
            <p>สำหรับผู้กู้รายใหม่และผู้กู้รายเก่า</p>
            <div class="checklist" id="checklist_announcement">
                <?php
                    $stmt = $pdo->prepare("SELECT Announcement.announcement_title AS 'Title', 
                                                Announcement.announcement_detail AS 'Detail', 
                                                DAY(Announcement.announcement_time_start) AS 'Day', 
                                                MONTH(Announcement.announcement_time_start) AS 'Month', 
                                                YEAR(Announcement.announcement_time_start)+543 AS 'Year', 
                                                DATE_FORMAT(Announcement.announcement_time_start, '%H:%i') AS 'Time' 
                                                FROM Announcement 
                                                WHERE Announcement.announcement_cate = 1 AND Announcement.announcement_status = 1;"
                                        );
                    $stmt->execute();
                    while ($row = $stmt->fetch()){
                        echo "<h3>". $row["Title"] ."</h3>";
                        echo "<p>". $row["Detail"] ."</p>";
                        echo "<p>เริ่มวันที่ <u> " . $row["Day"]."/".$row["Month"].$row["Year"]." เวลา ".$row["Time"]." น. เป็นต้นไป</u></p>";
                        echo "<a href='checklist.php'>"."ลงทะเบียน"."</a>";
                    }
                ?>
            </div>
            <div class="reservation" id="reservation_announcement">
                <?php
                    $stmt = $pdo->prepare("SELECT Announcement.announcement_title AS 'Title', 
                                                Announcement.announcement_detail AS 'Detail', 
                                                DAY(Announcement.announcement_time_start) AS 'Start_Day', 
                                                MONTH(Announcement.announcement_time_start) AS 'Start_Month', 
                                                YEAR(Announcement.announcement_time_start)+543 AS 'Start_Year', 
                                                DATE_FORMAT(Announcement.announcement_time_start, '%H:%i') AS 'Start_Time',
                                                DAY(Announcement.announcement_time_end) AS 'End_Day',
                                                MONTH(Announcement.announcement_time_end) AS 'End_Month',
                                                YEAR(Announcement.announcement_time_end) AS 'End_Year',
                                                DATE_FORMAT(Announcement.announcement_time_end, '%H:%i') AS 'End_Time'
                                                FROM Announcement 
                                                WHERE Announcement.announcement_cate = 2 AND Announcement.announcement_status = 1;");
                    $stmt->execute();
                    while ($row = $stmt->fetch()){
                        echo "<h3>". $row["Title"] ."</h3>";
                        echo "<p>". $row["Detail"] ."</p>";
                        echo "<p>เริ่มวันที่ <b> " . $row["Start_Day"]."/".$row["Start_Month"].$row["Start_Year"]." เวลา ".$row["Start_Time"]." น. ถึงวันที่ ".$row["End_Day"]."/".$row["End_Month"]."/".$row["End_Year"]." เวลา ".$row["End_Time"]." น.</b></p>";
                        echo "<a href=''>"."จองคิวนัดส่งเอกสาร"."</a>";
                    }
                ?>
            </div>
        </section>
        <!-- News -->
        <section class="news_announcement">
            <h1>ข่าวสาร กยศ.</h1>
            <div class="news-container">
            <?php
                $stmt = $pdo->prepare("SELECT Announcement.announcement_title AS 'Title' ,
                                        DAY(Announcement.announcement_time_start) AS 'Day',
                                        MONTH(Announcement.announcement_time_start) AS 'Month',
                                        YEAR(Announcement.announcement_time_start) AS 'Year',
                                        DATE_FORMAT(Announcement.announcement_time_start, '%H:%i') AS 'Time'
                                        FROM Announcement
                                        WHERE Announcement.announcement_cate = 3;");
                $stmt->execute();
                while ($row = $stmt->fetch()){
                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";

                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";

                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";

                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";
                    
                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";

                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";

                    echo "<div class='Announce-box'>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p>ประกาศวันที่ " . $row["Day"]."/".$row["Month"]."/".$row["Year"]." เวลา ".$row["Time"]." น.</p>";
                    echo "<a href=''>"."ดูเพิ่มเติม"."</a>";
                    echo "</div>";
                }
            ?>
            </div>
        </section>
        <!-- Service -->
        <section class="service-broad">

        </section>
        <!-- Contact -->
        <section class="contact-broad">
            <h1>ติดต่อ กยศ</h1>
            <div class="location">
                <h2>มจพ. กรุงเทพฯ</h2>
                <p>กลุ่มงานสวัสดิการนักศึกษา</p>
                <ul>
                    <li><p>ชั้น 4 (ฝั่งสนามบาสเกตบอล) อาคาร 40 ปี มจพ.</p></li>
                    <li><p>0 2555 2000 ต่อ 1150, 1161</p></li>
                </ul>
            </div>
            <div class="location">
                <h2>มจพ. วิทยาเขตปราจีนบุรี</h2>
                <p>กลุ่มงานกิจการนักศึกษา มจพ. วิทยาเขตปราจีนบุรี</p>
                <ul>
                    <li><p>ชั้น 1 ห้อง 103 อาคารบริหาร</p></li>
                    <li><p>037 217300 ต่อ 7331</p></li>
                </ul>
            </div>
            <div class="location">
                <h2>มจพ. วิทยาเขตระยอง</h2>
                <p>กลุ่มงานกิจการนักศึกษา มจพ. วิทยาเขตระยอง</p>
                <ul>
                    <li><p>ชั้น 3 อาคารวิทยาศาสตร์การกีฬาและโรงอาหาร</p></li>
                    <li><p>038 627000 ต่อ 5195</p></li>
                </ul>
            </div>
        </section>
    </main>
    
    <footer>

    </footer>
</body>
</html>