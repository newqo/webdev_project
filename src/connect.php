<?php
try {
    $pdo = new PDO("mysql:host=j00ko0ksw4gckc0gg00oo04o;dbname=reservation_db", "root", "nyGkqbZmSoTbN8WCJ1aow9B2qDFZnxHJUKkEf3NZz0CZarAk9dBYYBrjVCdmi5rG");
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด : " . $e->getMessage();
}