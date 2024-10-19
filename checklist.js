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
        document.getElementById("doc_column_grade_mobile").innerHTML = "ผลการเรียนจากสถานศึกษาเดิม";
        document.getElementById("condition_column_grade_mobile").innerHTML = "รบ./ปพ./Transcript";
    } else {
        document.getElementById("doc_column_grade").innerHTML = "ผลการเรียนทุกเทอม";
        document.getElementById("condition_column_grade").innerHTML = "พิมพ์จาก Reg.kmutnb.ac.th เท่านั้น";
        document.getElementById("doc_column_grade_mobile").innerHTML = "ผลการเรียนทุกเทอม";
        document.getElementById("condition_column_grade_mobile").innerHTML = "พิมพ์จาก Reg.kmutnb.ac.th เท่านั้น";
    }
    console.log(selectedValue);
}