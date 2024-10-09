<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT Faculty.Faculty_name AS 'คณะ', Department.Department_name AS 'สาขา' , COUNT(Reservation.reservation_id) AS 'จำนวนผู้กู้' 
                                FROM Reservation 
                                JOIN Users ON Reservation.national_id = Users.national_id 
                                JOIN Education ON Users.national_id = Education.national_id 
                                JOIN Faculty ON Education.Faculty_id = Faculty.Faculty_id 
                                JOIN Department ON Education.Department_id = Department.Department_id 
                                GROUP BY Department.Department_name
                                ORDER BY Faculty.Faculty_name ASC;");
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>คณะ</th>";
        echo "<th>สาขา</th>";
        echo "<th>จำนวนผู้กู้</th>";
        echo "</tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";

            echo "<td>" . $row ["คณะ"] . "</td>";
            echo "<td>" . $row ["สาขา"] . "</td>";
            echo "<td>" . $row ["จำนวนผู้กู้"] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>