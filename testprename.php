<?php
    include "connect.php";

    $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name");
    $stmt->execute();
    while($row = $stmt->fetch()){
        echo "<p>". $row["Pre_name_id"]. " : ". $row["Pre_name_desc"] ."</p>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function print(id){
            var x = console.log(document.getElementById(id).value);
            document.getElementById("result").innerHTML = x;
        }
    </script>
</head>
<body>
     <select id="fruit_select" name="pre_name_title" required onchange="print(id)">
        <option value="">เลือกคำนำหน้า</option>
        <?php
            $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name");
            $stmt->execute();
            while($row = $stmt->fetch()){
                echo "<option value='". $row["Pre_name_id"] . "'>". $row["Pre_name_desc"] . "</option>";
            }
        ?>
    </select>

    <hr>
    <select id="fruit_select" name="fruit_name" required onchange="print(id)">
        <option value="apple">Apple</option>
        <option value="orange">Orange</option>
        <option value="pineapple">Pineapple</option>
        <option value="banana">Banana</option>  
    </select>
    <p id="result"></p>
</body>
</html>