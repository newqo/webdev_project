<?php 
    include "connect.php";

    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }else{
        $term = $pdo->prepare("SELECT Duration_id FROM `Post_Duration` WHERE Reservation = 1 AND Event_status = 1 AND Duration_id LIKE '%OLD%' ORDER BY Start_date DESC");
        $term->execute();
        $this_term = $term->fetch();
        $this_term_id = $this_term["Duration_id"];
        
    }
    
    // if ($stmt->execute()) {
    //     echo '<script>alert("เรียบร้อย");</script>';
    // } else {
    //     echo '<script>alert("ไม่สำเร็จ");</script>';
    // }

    $start = "2024-10-17"; // assume it query from database
    $end = "2024-12-21";
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
<body onload="generate_calendar('<?= $start ?>')">
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
            <div>
                <button>09:00</button>
                <button>13:00</button>
            </div>
            <div class="bt-previous-next">
                <button type="button" class="bt-previous" id="previous" value="previous" onclick="ScrollMonth(id)">Previous</button>
                <button type="button" class="bt-next" id="next" value="next" onclick="ScrollMonth(id)">Next</button>
            </div>

            <button type="button" onclick="Submit()">Confirm</button>
        </article>
    </section>
</body>
</html>