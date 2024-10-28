<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>

    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/9703a87d5d.js" crossorigin="anonymous"></script>

    <script>
        function rmBG() {
            var links = document.querySelectorAll('aside a');
            links.forEach(link => {
            link.classList.remove('active');
            });
        }

        function linkClick(element) {
            rmBG();
            element.classList.add('active');
        }
        function selectStatus(statusId) {
            document.getElementById(statusId).checked = true;
        }
    </script>
</head>
<body>
        <aside>
            <a href="dashboard.php#showCountInfo_id" name="dashboard" onclick="linkClick(this)"><i class="fa-solid fa-gauge-simple"></i>  Dashboard</a>
            <a href="dashboard.php#user-management_id" name="user" onclick="linkClick(this)"><i class="fa-solid fa-user"></i>  User Management</a>
            <a href="dashboard.php#information-management_id" name="info" onclick="linkClick(this)"><i class="fa-solid fa-bullhorn"></i>  Information Management</a><br>
            <a href="dashboard_add_admin.php" name="admin" onclick="linkClick(this)"><i class="fa-solid fa-user-plus"></i>  Add admin</a>
        </aside>
    <div class="container">
    <?php ?>
    <div class="title">เพิ่มการจอง</div>
    <form action="add_reservation_procedure.php" method="post">
        <div class="input-id">
            <label>ID</label>
            <input type="text" name="Duration_id" placeholder="R_NEW1/R_OLD1"pattern="(^R_NEW\d{1,}|^R_OLD\d{1,})" required>
        </div>
        <div class="form-group">
            <label>วันเวลาเริ่มต้น</label>
            <input type="datetime-local" name="Start_date" required>
        </div>
        <div class="form-group">
            <label>วันเวลาสิ้นสุด</label>
            <input type="datetime-local" name="End_date" required>
        </div>
        <div class="form-group-status">
            <label>Status</label>
            <div class="radio-container">
            <input type="radio" name="Event_status" id="status_close"value="0" required hidden/>
            <label for="status_close">ปิด</label>

            <input type="radio" name="Event_status" id="status_open"value="1" required hidden/>
            <label for="status_open">เปิด</label>
            </div>
        </div>
        <div class="submit-btn">
            <button type="button" class="btn" onclick="openPopup()">เพิ่ม</button>
        </div>
        <div id="overlay" class="overlay"></div>
        <div class="popup" id="popup">
                <img src="imgs/checked.png">
                <h2>เพิ่มข้อมูลเสร็จสิ้น !</h2>
                <p>การเปลี่ยนแปลงได้ถูกบันทึกเรียบร้อยแล้ว</p>
                <a href="dashboard.php">
                <button type="button" onclick="closePopup()">ตกลง</button>
                </a>
        </div>
    </div>
    </form>
    <script>
        let popup = document.getElementById("popup");
        let overlay = document.getElementById("overlay");

        function openPopup() {
            popup.classList.add("open-popup");
            overlay.style.display = "block";
        }

        function closePopup() {
            popup.classList.remove("open-popup");
            overlay.style.display = "none";
        }
    </script>
</body>
</html>