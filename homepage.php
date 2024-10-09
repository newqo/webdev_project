<?php 
    include "connect.php";
?>
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
            <li><a href="homepage.php"><img src="imgs/Student_Loan_logo.svg"></a></li>
            <li><a href="homepage.php">หน้าหลัก</a></li>
            <li><a href="">บริการ</a></li>
            <li><a href="">ติดต่อเรา</a></li>
        </ul>
    </nav>
    <main>
        <!-- Checklist and Reservation -->
        <section class="reservation_and_checklist_announcement">
            <h1>ประกาศ Checklist และประกาศการจองคิวนัดส่งเอกสาร</h1>
            <p>สำหรับผู้กู้รายใหม่และผู้กู้รายเก่า</p>
            <article class="checklist" id="checklist_announcement">
                <h3>ลงทะเบียนขอรับเอกสาร Checklist</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo quis harum, dignissimos cum cupiditate repudiandae incidunt quibusdam accusantium commodi, iusto eius tempora. Molestiae est reprehenderit unde quo? Rem, harum praesentium.</p>
                <a href="checklist.php">ลงทะเบียน</a>
            </article>
            <article class="reservation" id="reservation_announcement_old_user">
                <h3>จองคิวนัดส่งเอกสารสำหรับผู้กู้รายเก่า</h3>
                <p><strong>ผู้กู้รายเก่า</strong> เริ่มวันที่ 1 ตุลาคม 2567 เวลา 10.00 น. หมดเขตวันที่ 10 ตุลาคม 2567 เวลา 23.59 น.</p>
                <a href="checklist.php">จองคิวนัดส่งเอกสาร</a>
            </article>
            <article class="reservation" id="reservation_announcement_new_user">
                <h3>จองคิวนัดส่งเอกสารสำหรับผู้กู้รายใหม่</h3>
                <p><strong>ผู้กู้รายใหม่</strong> เริ่มวันที่ 11 ตุลาคม 2567 เวลา 10.00 น. หมดเขตวันที่ 20 ตุลาคม 2567 เวลา 23.59 น.</p>
                <a href="checklist.php">จองคิวนัดส่งเอกสาร</a>
            </article>
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