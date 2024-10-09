<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <?php
        $stmt = $pdo->prepare("SELECT Users.national_id AS 'เลขบัตรประชาชน', Users.firstname AS 'ชื่อจริง', Users.lastname AS 'นามสกุล', Parent_status.status_description AS 'สถานภาพครอบครัว' 
                                FROM Users 
                                JOIN User_Relationship ON Users.national_id = User_Relationship.national_id 
                                JOIN Parent ON Parent.parent_id = User_Relationship.parent_id 
                                JOIN Parent_status ON Parent.parent_status_id = Parent_status.parent_status_id  
                                GROUP BY Users.national_id");
        $stmt->execute();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>เลขบัตรประชาชน</th>";
        echo "<th>ชื่อจริง</th>";
        echo "<th>นามสกุล</th>";
        echo "<th>สถานภาพครอบครัว</th>";
        echo "</tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row ["เลขบัตรประชาชน"] . "</td>";
            echo "<td>" . $row ["ชื่อจริง"] . "</td>";
            echo "<td>" . $row ["นามสกุล"] . "</td>";
            echo "<td>" . $row ["สถานภาพครอบครัว"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>