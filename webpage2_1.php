<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT Users.national_id, Users.firstname, Users.lastname, Reservation.reserve_date, Reservation.reserve_time 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = '10' 
AND Users.user_cate_id = 0;");
        
        
        $stmt->execute();

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>หมายเลขบัตรประชาชน</th>";
        echo "<th>ชื่อ</th>";
        echo "<th>นามสกุล</th>";
        echo "<th>วันที่จอง</th>";
        echo "<th>เวลาจอง</th>";
        echo "</tr>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["national_id"] . "</td>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["reserve_date"] . "</td>";
            echo "<td>" . $row["reserve_time"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
