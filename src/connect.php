<?php
try {
    $pdo = new PDO("host=j00ko0ksw4gckc0gg00oo04o;dbname=reservation_db;charset=utf8", "root", "nyGkqbZmSoTbN8WCJ1aow9B2qDFZnxHJUKkEf3NZz0CZarAk9dBYYBrjVCdmi5rG");
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด : " . $e->getMessage();
}
?>
