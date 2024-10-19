function submitDetail(user_cate_id) {
    var selectedValue = user_cate_id;
    // console.log(selectedValue);

    if (selectedValue == "0") {
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
}
