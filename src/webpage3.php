<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT MONTH(Reservation.reserve_date) AS 'เดือน' ,SUM(Users.user_cate_id=0)AS 'ผู้กู้รายใหม่' , SUM(Users.user_cate_id=1) AS 'ผู้กู้รายเก่า'
                            FROM Reservation 
                            JOIN Users ON Reservation.national_id = Users.national_id 
                            GROUP BY MONTH(Reservation.reserve_date)");
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>เดือน</th>";
        echo "<th>ผู้กู้รายใหม่</th>";
        echo "<th>ผู้กู้รายเก่า</th>";
        echo "</tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row ["เดือน"] . "</td>";
            echo "<td>" . $row ["ผู้กู้รายใหม่"] . "</td>";
            echo "<td>" . $row ["ผู้กู้รายเก่า"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>