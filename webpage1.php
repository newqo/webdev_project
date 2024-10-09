<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT SUM(Users.user_cate_id=1) AS 'ผู้กู้รายเก่า' FROM Reservation JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = '10'");
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>ผู้กู้รายเก่า</th>";
        echo "</tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";

            echo "<td>" . $row ["ผู้กู้รายเก่า"] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>