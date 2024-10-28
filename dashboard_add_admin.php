<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin Information</title>

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
    <div class="title">เพิ่ม Admin</div>
    <form action="add_admin_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="national_id" placeholder="Admin-name" pattern="^Admin-\w{1,}$" required>
        </div>
        <div class="form-group">
            <label>คำนำหน้า</label>
            <select id="Pre_name_selected" name="Pre_name_id" required>
                <option value="">เลือกคำนำหน้า</option>
                <?php 
                    $query_prename = $pdo->prepare("SELECT * FROM Pre_name");
                    $query_prename->execute();

                    while($option = $query_prename->fetch()){
                        echo "<option value='". $option["Pre_name_id"] ."'>". $option["Pre_name_desc"] ."</option>";
                    }
                ?>
                            </select>
            </select>
        </div>
        <div class="form-group">
            <label>ชื่อ</label>
            <input type="text" name="firstname" pattern="[A-Za-zก-๙]{2,50}" required>
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input type="text" name="lastname" pattern="[A-Za-zก-๙]{2,50}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="Email" placeholder="example@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        </div>
        <div class="form-group">
            <label>เบอร์โทร</label>
            <input type="text" name="phone_num" maxlength="10" placeholder="0981234567" pattern="[0-9]{10}" required>
        </div>
        <div class="form-group">
            <label>วันเดือนปีเกิด</label>
            <input type="date" name="birthdate" required>
        </div>
        <div class="form-group">
            <label>รหัสผ่าน</label>
            <input type="password" name="passwd" maxlength="100" pattern="[A-Za-z0-9_]{8,100}" placeholder="กรอกอย่างน้อย 8 ตัว" required>
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