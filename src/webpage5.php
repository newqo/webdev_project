<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT Users.national_id AS 'เลขบัตรประชาชน', Users.firstname AS 'ชื่อจริง' , Users.lastname AS 'นามสกุล', Scholarship.scholarship_name AS 'ชื่อทุน', Cost_of_living_status.amount AS 'ค่่าครองชีพต่อเดือน', Reservation.reserve_date AS 'วันจอง', Reservation.reserve_time AS 'เวลาจอง', Reservation.queue_no AS 'คิวที่' 
                                FROM Reservation 
                                JOIN Users ON Reservation.national_id = Users.national_id 
                                JOIN Checklist ON Reservation.checklist_id = Checklist.checklist_id 
                                JOIN Scholarship ON Checklist.scholarship_id = Scholarship.scholarship_id 
                                JOIN Cost_of_living_status ON Checklist.cost_of_living_id = Cost_of_living_status.cost_of_living_id
                                ORDER BY 
                                Reservation.reserve_date DESC,
                                Reservation.reserve_time DESC;");
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>เลขบัตรประชาชน</th>";
        echo "<th>ชื่อจริง</th>";
        echo "<th>นามสกุล</th>";
        echo "<th>ชื่อทุน</th>";
        echo "<th>ค่่าครองชีพต่อเดือน</th>";
        echo "<th>วันจอง/th>";
        echo "<th>เวลาจอง/th>";
        echo "<th>คิวที่/th>";
        echo "</tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";

            echo "<td>" . $row ["เลขบัตรประชาชน"] . "</td>";
            echo "<td>" . $row ["ชื่อจริง"] . "</td>";
            echo "<td>" . $row ["นามสกุล"] . "</td>";
            echo "<td>" . $row ["ชื่อทุน"] . "</td>";
            echo "<td>" . $row ["ค่่าครองชีพต่อเดือน"] . "</td>";
            echo "<td>" . $row ["วันจอง"] . "</td>";
            echo "<td>" . $row ["เวลาจอง"] . "</td>";
            echo "<td>" . $row ["คิวที่"] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>