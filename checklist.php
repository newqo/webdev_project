<?php include "connect.php" ?>

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
    <script>
        function submitDetail(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์ม
            const userCateId = document.getElementsByName("user_cate_id");
            let selectedValue;
            
            for (let i = 0; i < userCateId.length; i++) {
                if (userCateId[i].checked) {
                    selectedValue = userCateId[i].value;
                    break;
                }
            }

            if (selectedValue === "0") {
                document.getElementById("doc_column_grade").innerHTML = "ผลการเรียนจากสถานศึกษาเดิม";
                document.getElementById("condition_column_grade").innerHTML = "รบ./ปพ./Transcript";
            } else {
                document.getElementById("doc_column_grade").innerHTML = "ผลการเรียนทุกเทอม";
                document.getElementById("condition_column_grade").innerHTML = "พิมพ์จาก Reg.kmutnb.ac.th เท่านั้น";
            }
            console.log(selectedValue);
        }
    </script>
</head>
<body>
    <section class="container">
        <article>
        <form class="form-container" action="" method>

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
            <select name="scholarship_id" id="scholarship_id" required>
                <option value="">--กรุณาเลือกชื่อทุน--</option>
                <option value="1">ทุนนักศึกษาที่สร้างชื่อเสียงดีเด่นให้แก่สถาบัน</option>
                <option value="2">ทุนผู้มีความสามารถพิเศษ</option>
                <option value="3">ทุนขาดแคลน</option>
                <option value="4">ทุนเฉลิมราชกุมารี</option>
                <option value="5">ทุนอุดมศึกษาเพื่อการพัฒนาจังหวัดชายแดนภาคใต้</option>
                <option value="6">ทุนอุดหนุนการศึกษาประเภทขาดแคลนแก่นักศึกษาโครงการสมทบพิเศษ (เฉพาะคณะวิทยาศาสตร์ประยุกต์)
                </option>
            </select>

            </div>

            <div class="setcenter">
                <button type="button" id="addInformation" class="addInformation" onclick="submitDetail(event)">เสร็จสิ้น</button>
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
                <td class="doc-column" id="doc_column_grade">รายการเอกสาร</td>
                <td class="amount-column">คนละ 1 ชุด
                </td>
                <td class="condition-column" id="condition_column_grade">เงื่อนไข</td>
            </tr>
            
        </table>

        <div class="setcenter">
            <a href="homepage.php">กลับหน้าหลัก</a>
        </div>
        </article>

    </section>
    
</body>
</html>