<?php 
    include "connect.php";
    
    session_start();

    if (empty($_SESSION["national_id"]) ) { 
        header("location: login.php");
    }else{
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="css/checklist_reservation.css" rel="stylesheet">
    <script src="javascript/checklist.js"></script>
</head>
<body>
    <section class="container">
        <article>
        <form class="form-container" action="insert_checklist.php" method="post">
            <div>
            <label>กลุ่ม</label>
            <br>
            <input type="radio" name="user_cate_id" id="new_user" value="0" required/>
            <label for="new_user">ผู้กู้รายใหม่</label>
            <br>
            <input type="radio" name="user_cate_id" id="old_user" value="1" required/>
            <label for="old_user">ผู้กู้รายเก่า</label>
            <br><br>
            <label>ผู้กู้ประสงค์ขอกู้ยืมเงินค่าครองชีพ (รายเดือน)</label>
            <br>
            <input type="radio" id="costofliving-yes" name="cost_of_living_id" value="1" required/>
            <label for="costofliving-yes">ประสงค์รับค่าครองชีพ</label>
            <br>
            <input type="radio" id="costofliving-no" name="cost_of_living_id" value="0" required/>
            <label for="costofliving-no">ไม่ประสงค์รับค่าครองชีพ</label>
            <br><br>
            <label>ทุน</label>
            <select name="scholarship_select" id="scholarship_id" required>
                <option value="">--กรุณาเลือกชื่อทุน--</option>
                <?php
                    $query = $pdo->prepare("SELECT * FROM Scholarship");
                    $query->execute();
                    while($option = $query->fetch()){
                        echo "<option value='". $option["scholarship_id"] ."'>". $option["scholarship_name"] ."</option>";
                    }
                ?>
                <!-- <option value="1">ทุนนักศึกษาที่สร้างชื่อเสียงดีเด่นให้แก่สถาบัน</option>
                <option value="2">ทุนผู้มีความสามารถพิเศษ</option>
                <option value="3">ทุนขาดแคลน</option>
                <option value="4">ทุนเฉลิมราชกุมารี</option>
                <option value="5">ทุนอุดมศึกษาเพื่อการพัฒนาจังหวัดชายแดนภาคใต้</option>
                <option value="6">ทุนอุดหนุนการศึกษาประเภทขาดแคลนแก่นักศึกษาโครงการสมทบพิเศษ (เฉพาะคณะวิทยาศาสตร์ประยุกต์)</option> -->
            </select>

            </div>

            <div class="setcenter">
                <button type="submit" id="addInformation" class="addInformation" onclick="submitDetail(event)">เสร็จสิ้น</button>
                
            </div>

        </form>
        </article>
        <br>
        <article>
        <table id="document-table">

            <tr>
                <th class="doc-column">รายการเอกสาร</th>
                <th class="amount-column">จำนวน</th>
                <th class="condition-column">เงื่อนไข</th>
            </tr>

            <tr>
                <td class="doc-column">แบบยืนยันการเบิกเงินกู้ยืม จากระบบ DSL</td>
                <td class="amount-column">2 แผ่น
                </td>
                <td class="condition-column">เริ่มทำได้หลังจากจองคิวใน Google From ไปแล้ว 48 ชม.</td>
            </tr>

            <tr>
                <td class="doc-column">สัญญากู้ยืมเงินกองทุน กยศ. จากระบบ DSL</td>
                <td class="amount-column">2 ชุด
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">สำเนาบัตรประชาชนผู้กู้ยืม</td>
                <td class="amount-column">2 แผ่น
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">เอกสารแสดงผลการลงทะเบียน 1/2567</td>
                <td class="amount-column">1 ชุด
                </td>
                <td class="condition-column">ในระบบ reg.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">เอกสารแสดงค่าใช้จ่าย/ทุน 1/2567</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">ในระบบ reg.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">สำเนาใบเสร็จรับเงินค่าเทอม 1/2567</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">ในระบบ rco.kmutnb.ac.th</td>
            </tr>

            <tr>
                <td class="doc-column">บันทึกกิจกรรมจิตอาสาไม่น้อยกว่า 36 ชั่วโมง</td>
                <td class="amount-column">1 แผ่น
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column">หนังสือยินยอมเปิดเผยข้อมูล</td>
                <td class="amount-column">1 ชุด
                </td>
                <td class="condition-column">-</td>
            </tr>

            <tr>
                <td class="doc-column" id="doc_column_grade">รอการกดยืนยัน</td>
                <td class="amount-column">คนละ 1 ชุด
                </td>
                <td class="condition-column" id="condition_column_grade">รอการกดยืนยัน</td>
            </tr>
            
        </table>

        <div class="document-mobile">
            <br>
            <b style="font-size: 15px; color: #56C596;">รายการเอกสาร</b>
            <p style="font-size: 14px;">แบบยืนยันการเบิกเงินกู้ยืม จากระบบ DSL</p>
            <b class="b-doc-mobile">จำนวน</b>
            <p style="font-size: 14px;">2 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">เริ่มทำได้หลังจากจองคิวใน Google From ไปแล้ว 48 ชม.</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สัญญากู้ยืมเงินกองทุน กยศ. จากระบบ DSL</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">2 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สำเนาบัตรประชาชนผู้กู้ยืม</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">2 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">เอกสารแสดงผลการลงทะเบียน 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ reg.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">เอกสารแสดงค่าใช้จ่าย/ทุน 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ reg.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">สำเนาใบเสร็จรับเงินค่าเทอม 1/2567</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">ในระบบ rco.kmutnb.ac.th</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">บันทึกกิจกรรมจิตอาสาไม่น้อยกว่า 36 ชั่วโมง</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 แผ่น</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p style="font-size: 14px;">หนังสือยินยอมเปิดเผยข้อมูล</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p style="font-size: 14px;">-</p>
            <hr>
            <b style="font-size: 15px;">รายการเอกสาร</b>
            <p id="doc_column_grade_mobile" style="font-size: 14px;">รอการกดยืนยัน</p>
            <b style="font-size: 15px;">จำนวน</b>
            <p style="font-size: 14px;">คนละ 1 ชุด</p>
            <b style="font-size: 15px;">เงื่อนไข</b>
            <p id="condition_column_grade_mobile" style="font-size: 14px;">รอการกดยืนยัน</p>
            <hr>
            
        </div>

        <div class="setcenter">
            <a href="homepage.php">กลับหน้าหลัก</a>
        </div>
        </article>

    </section>
    
</body>
</html>