<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin Information</title>
</head>
<body>
    <?php ?>
    <div class="title">เพิ่ม Admin</div>
    <form action="add_admin_procedure.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="national_id" placeholder="Admin-name">
        </div>
        <div class="form-group">
            <label>firstname</label>
            <input type="text" name="firstname">
        </div>
        <div class="form-group">
            <label>lastname</label>
            <input type="text" name="lastname">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="Email">
        </div>
        <div class="form-group">
            <label>phone_num</label>
            <input type="text" name="phone_num">
        </div>
        <div class="form-group">
            <label>birthdate</label>
            <input type="date" name="birthdate">
        </div>
        <div class="form-group">
            <label>passwd</label>
            <input type="password" name="passwd">
        </div>
    </form>
</body>
</html>