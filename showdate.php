<?php
    include "connect.php";

    $content = $_GET['id'];

    $months = array("ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย", "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค");

    if($content == 'checklist_date'){
        $checklist_stmt = $pdo->prepare("SELECT DAY(Start_date) AS 'start_date' , 
                                                    MONTH(Start_date) AS 'start_month', 
                                                    YEAR(Start_date) AS 'start_year', 
                                                    TIME_FORMAT(Start_date, '%H:%i') AS 'start_time', 
                                                    DAY(End_date) AS 'end_date',
                                                    MONTH(End_date) AS 'end_month', 
                                                    YEAR(End_date) AS 'end_year', 
                                                    TIME_FORMAT(End_date, '%H:%i') AS 'end_time' 
                                                    FROM Post_Duration 
                                                    WHERE Checklist = 1 AND Event_status = 1 ORDER BY Post_Duration.Start_date DESC;");
        $checklist_stmt->execute();
        $checklist = $checklist_stmt->fetch();
        if(isset($checklist)){
            echo "เริ่มวันที่ " . $checklist['start_date'] . " " . $months[$checklist['start_month'] - 1] . " " . ($checklist['start_year'] + 543) . " เวลา " . $checklist['start_time'] . " น. 
                <span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\"> หมดเขตวันที่ ". $checklist['end_date'] . " " .$months[$checklist['end_month'] - 1] . " " . $checklist['end_year'] ." เวลา " . $checklist['end_time']. " น.". "</span>";
        }else{
            echo "<span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\">ขณะนี้ยังไม่เปิดให้บริการ</span>";
        }
    }
    else if ($content == 'reservation_old_date'){
        $reservation_old_stmt = $pdo->prepare("SELECT DAY(Start_date) AS 'start_date' , 
                                                            MONTH(Start_date) AS 'start_month', 
                                                            YEAR(Start_date) AS 'start_year', 
                                                            TIME_FORMAT(Start_date, '%H:%i') AS 'start_time', 
                                                            DAY(End_date) AS 'end_date', 
                                                            MONTH(End_date) AS 'end_month', 
                                                            YEAR(End_date) AS 'end_year', 
                                                            TIME_FORMAT(End_date, '%H:%i') AS 'end_time' 
                                                            FROM Post_Duration 
                                                            WHERE Reservation = 1 AND Event_status = 1 AND Duration_id LIKE '%OLD%' 
                                                            ORDER BY Post_Duration.Start_date DESC;");
        $reservation_old_stmt->execute();
        $reservation_old = $reservation_old_stmt->fetch();

        if(isset($reservation_old)){
            echo "เริ่มวันที่ " . $reservation_old['start_date'] . " " . $months[$reservation_old['start_month'] - 1] . " " . ($reservation_old['start_year'] + 543) . " เวลา " . $reservation_old['start_time'] . " น. 
                <span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\"> หมดเขตวันที่ ". $reservation_old['end_date'] . " " .$months[$reservation_old['end_month'] - 1] . " " . $reservation_old['end_year'] ." เวลา " . $reservation_old['end_time']. " น.". "</span>";
        }
        else{
            echo "<span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\">ขณะนี้ยังไม่เปิดให้บริการ</span>";
        }
    }
    else if ($content == 'reservation_new_date'){
        $reservation_new_stmt = $pdo->prepare("SELECT DAY(Start_date) AS 'start_date' , 
                                                            MONTH(Start_date) AS 'start_month', 
                                                            YEAR(Start_date) AS 'start_year', 
                                                            TIME_FORMAT(Start_date, '%H:%i') AS 'start_time', 
                                                            DAY(End_date) AS 'end_date', 
                                                            MONTH(End_date) AS 'end_month', 
                                                            YEAR(End_date) AS 'end_year', 
                                                            TIME_FORMAT(End_date, '%H:%i') AS 'end_time' 
                                                            FROM Post_Duration 
                                                            WHERE Reservation = 1 AND Event_status = 1 AND Duration_id LIKE '%OLD%' 
                                                            ORDER BY Post_Duration.Start_date DESC;");
        $reservation_new_stmt->execute();
        $reservation_new = $reservation_new_stmt->fetch();

        if(isset($reservation_new)){
            echo "เริ่มวันที่ " . $reservation_new['start_date'] . " " . $months[$reservation_new['start_month'] - 1] . " " . ($reservation_new['start_year'] + 543) . " เวลา " . $reservation_new['start_time'] . " น. 
                <span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\"> หมดเขตวันที่ ". $reservation_new['end_date'] . " " .$months[$reservation_new['end_month'] - 1] . " " . $reservation_new['end_year'] ." เวลา " . $reservation_new['end_time']. " น.". "</span>";
        }
        else{
            echo "<span style=\"color: #ff6f61; font-weight: bold; text-decoration: underline;\">ขณะนี้ยังไม่เปิดให้บริการ</span>";
        }
    }
?>
