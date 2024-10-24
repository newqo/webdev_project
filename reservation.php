<?php 
    include "connect.php";

    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }else{
        $term = $pdo->prepare("SELECT Duration_id, Start_date , End_date FROM `Post_Duration` WHERE Reservation = 1 AND Event_status = 1 AND Duration_id LIKE '%OLD%' ORDER BY Start_date DESC");
        $term->execute();
        $this_term = $term->fetch();
        $this_term_id = $this_term["Duration_id"];

        $start = $this_term["Start_date"];
        $end = $this_term["End_date"];

        $IsReserved = $pdo->prepare("SELECT COUNT(reservation_id) as 'found' FROM Reservation WHERE national_id = ? AND duration_id = ?");
        $IsReserved->bindParam(1,$_SESSION['national_id']);
        $IsReserved->bindParam(2,$this_term_id);
        $IsReserved->execute();
        $IsfoundReservation = $IsReserved->fetch();
        if($IsfoundReservation['found'] != 0){
            header("location: reservation-notification.php");
        }
        else{
            $checklist_term = $pdo->prepare("SELECT Duration_id FROM `Post_Duration` WHERE Checklist = 1 AND Event_status = 1 ORDER BY Start_date DESC");
            $checklist_term->execute();
            $checklist_this_term = $checklist_term->fetch();
            $checklist_this_term_id = $checklist_this_term["Duration_id"];
    
            $stmt = $pdo->prepare("SELECT COUNT(checklist_id) AS 'row', checklist_id FROM Checklist WHERE duration_id = ? AND national_id = ?");
            $stmt->bindParam(1,$checklist_this_term_id);
            $stmt->bindParam(2,$_SESSION["national_id"]);
            $stmt->execute();
            $Isfound = $stmt->fetch();
            if ($Isfound['row'] == 0){
                header("location: checklist.php");
            }
            else{
                $User_checklist_id = $Isfound["checklist_id"];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reservation.css">
    <script src="javascript/reservation.js"></script>
</head>
<body onload="GetDuration('<?= $start ?>','<?= $end ?>')">
    <section class="container">
        <article>
            <h1 id="calendar-title"></h1>
            <table id="calendar">
                <thead style="color: black;">
                    <th class="sun">SUN</th>
                    <th class="mon">MON</th>
                    <th class="tue">TUE</th>
                    <th class="wed">WED</th>
                    <th class="thu">THU</th>
                    <th class="fri">FRI</th>
                    <th class="sat">SAT</th>
                </thead>
                <tbody id="calendar-body">

                </tbody>
            </table>
            <br>
            <div class="bt-previous-next">
                <button type="button" class="bt-previous" id="previous" value="previous" onclick="ScrollMonth(id)">Previous</button>
                <button type="button" class="bt-next" id="next" value="next" onclick="ScrollMonth(id)">Next</button>
            </div>
            <form action="reservation_validation.php" method="post">
                <input type="hidden" name="reservation_duration_id" value="<?=$this_term_id?>">
                <input type="hidden" name="checklist_id" value="<?=$User_checklist_id?>">
                <input type="hidden" name="national_id" value="<?=$_SESSION["national_id"]?>">
                <input type="hidden" name="reservation_date" id="reservation_date_id" value="" required>
                <div>
                    <button type="button" class="reservation_round_bt" id="round-morning" value="09:00:00" onclick="selected_round(id)">09:00</button>
                    <button type="button" class="reservation_round_bt" id="round-noon" value="13:00:00" onclick="selected_round(id)">13:00</button>
                </div>
                <input type="hidden" name="selected_reservation_round" id="select_round_id" value="" required>
                <button type="submit">Confirm</button>
                <p>หมายเหตุ: หากนักศึกษาไม่อยู่รับบริการในช่วงเรียกคิว ทางกยศ.ขอสงวนสิทธิ์ในการข้ามคิว</p>
            </form>

        </article>
    </section>
</body>
</html>