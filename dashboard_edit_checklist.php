<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Checklist</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://kit.fontawesome.com/9703a87d5d.js"
      crossorigin="anonymous"
    ></script>
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
    </script>
    <link href="css/dashboard.css" rel="stylesheet">
</head>
<body>
        <aside>
            <a href="#showCountInfo_id" name="dashboard" onclick="linkClick(this)"><i class="fa-solid fa-gauge-simple"></i>  Dashboard</a>
            <a href="#user-management_id" name="user" onclick="linkClick(this)"><i class="fa-solid fa-user"></i>  User Management</a>
            <a href="#information-management_id" name="info" onclick="linkClick(this)"><i class="fa-solid fa-bullhorn"></i>  Information Management</a><br>
            <a href="dashboard_add_admin.php" name="admin" onclick="linkClick(this)"><i class="fa-solid fa-user-plus"></i>  Add admin</a>
        </aside>
    <div class="container">
    <?php 
        $query_chl = $pdo->prepare("SELECT Post_Duration.Duration_id AS 'ID',Post_Duration.Start_date AS 'วันเวลาเริ่มต้น',Post_Duration.End_date AS 'วันเวลาสิ้นสุด',Post_Duration.Event_status AS 'Status' FROM Post_Duration WHERE Post_Duration.Duration_id LIKE 'C%' AND Duration_id = ?");
        $query_chl->bindParam(1,$_GET["Duration_id"]);
        $query_chl->execute();
        $row=$query_chl->fetch();
       
    ?>
    <div class="title">แก้ไข Checklist</div>
    <form action="edit_checklist_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="hidden" name="Duration_id" value="<?=$row["ID"]?>">
        </div>
        <div class="form-group">
            <label>วันเวลาเริ่มต้น</label>
            <input type="datetime-local" name="Start_date" value="<?=$row["วันเวลาเริ่มต้น"]?>" required >
        </div>
        <div class="form-group">
            <label>วันเวลาสิ้นสุด</label>
            <input type="datetime-local" name="End_date" value="<?=$row["วันเวลาสิ้นสุด"]?>" required >
        </div>
        <?php 
            $status_selected = $row["Status"];
        ?>
        <div class="form-group">
            <label>Status</label>
            <div class="radio-container">
                <input type="radio" name="Event_status" id="status_close"value="0"
                <?php echo ($status_selected == 0) ? 'checked' : '' ?> required/>
                <label for="status_close">ปิด</label>
            </div>
            <div class="radio-container">
                <input type="radio" name="Event_status" id="status_open"value="1"
                <?php echo ($status_selected == 1) ? 'checked' : '' ?> required/>
                <label for="status_open">เปิด</label>
            </div>
        </div>
        <div class="submit-btn"><input type="submit" value="แก้ไข"></div>
    </form>
    </div>
</body>
</html>