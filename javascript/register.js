var faculty;
function updateFaculty(){
    faculty = new XMLHttpRequest();
    faculty.onreadystatechange = Faculty_query;

    var ed_level = document.getElementById("user_year").value;
    // console.log(ed_level)
    var url = "updateFaculty.php?ed_level=" + ed_level;
    faculty.open("GET",url,true);
    faculty.send()
}

function Faculty_query(){
    if (faculty.readyState == 4 && faculty.status == 200){
        var faculty_select = document.getElementById("faculty");
        // console.log(faculty.responseText);
        faculty_select.innerHTML = faculty.responseText;
        updateMajor();
    }
}

var major;
function updateMajor(){
    major = new XMLHttpRequest();
    major.onreadystatechange = Major_query;

    var faculty_select = document.getElementById("faculty").value;
    var ed_level = document.getElementById("user_year").value;
    var url = "updateMajor.php?ed_level="+ ed_level + "&Faculty=" + faculty_select;

    major.open("GET",url,true);
    major.send();
}

function Major_query(){
    if (major.readyState == 4 && major.status == 200){
        var major_select = document.getElementById("major");
        // console.log(major.responseText);
        major_select.innerHTML = major.responseText;
    }
}

function setRequiredAttributes(role) {
    const fields = {
        father: [
            "father_fst_name",
            "father_lst_name",
            "father_phone_num",
            "father_career",
            "father_annual_income",
            "father_income_type"
        ],
        mother: [
            "mother_fst_name",
            "mother_lst_name",
            "mother_phone_num",
            "mother_career",
            "mother_annual_income",
            "mother_income_type"
        ],
        guardian: [
            "guardian_fst_name",
            "guardian_lst_name",
            "guardian_phone_num",
            "guardian_career",
            "guardian_annual_income",
            "guardian_income_type"
        ]
    };

    fields[role].forEach(fieldId => {
        const fieldElements = document.getElementsByName(fieldId);
        fieldElements.forEach(field => {
            field.setAttribute("required", "required");
        });
    });
}

function removeRequiredAttributes() {
    const allFields = [
        "father_fst_name",
        "father_lst_name",
        "father_phone_num",
        "father_career",
        "father_annual_income",
        "father_income_type",
        "mother_fst_name",
        "mother_lst_name",
        "mother_phone_num",
        "mother_career",
        "mother_annual_income",
        "mother_income_type",
        "guardian_fst_name",
        "guardian_lst_name",
        "guardian_phone_num",
        "guardian_career",
        "guardian_annual_income",
        "guardian_income_type"
    ];

    allFields.forEach(fieldId => {
        const fieldElements = document.getElementsByName(fieldId);
        fieldElements.forEach(field => {
            field.removeAttribute("required");
        });
    });
}

function showSection(selectedValue) {
    // console.log(selectedValue);
    document.getElementById("father-info").style.display = "none";
    document.getElementById("father-income-info").style.display = "none";
    document.getElementById("mother-info").style.display = "none";
    document.getElementById("mother-income-info").style.display = "none";
    document.getElementById("guardian-info").style.display = "none";
    document.getElementById("guardian-income-info").style.display = "none";

    removeRequiredAttributes();

    if (selectedValue === "0") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
        setRequiredAttributes("father");
    } else if (selectedValue === "1") {
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
        setRequiredAttributes("mother");
    } else if (selectedValue === "3") {
        document.getElementById("guardian-info").style.display = "block";
        document.getElementById("guardian-income-info").style.display = "block";
        setRequiredAttributes("guardian");
    } else if (selectedValue === "2") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
        setRequiredAttributes("father");
        setRequiredAttributes("mother");
    }
}

var std_id;
function check_std_id(){
    std_id = new XMLHttpRequest();
    std_id.onreadystatechange = std_query;

    var std_id_input = document.getElementById("user_stdID").value;
    // console.log(std_id_input);
    var url = "check_std_id.php?std=" + std_id_input;

    std_id.open("GET",url);
    std_id.send();
}

function std_query(){
    if (std_id.readyState == 4 && std_id.status == 200){
        std_response = std_id.responseText;
        // console.log(std_id.responseText);
        // document.getElementById("std-id-result").className = std_id.responseText;
        document.getElementById("std-id-result").className = std_response;

        // if(std_response == "notify-show"){
        //     document.getElementById("succesButton").className = "disabled";
        // }
        // else{
        //     document.getElementById("succesButton").className = "";
        // }
        Check_bt_Integrity();
    }
}

var national_id;
function check_national_id(){
    national_id = new XMLHttpRequest();
    national_id.onreadystatechange = national_id_query;

    var national_id_input = document.getElementById("user_id").value;
    var url = "check_national_id.php?national_id=" + national_id_input;

    national_id.open("GET",url);
    national_id.send();
}

function national_id_query(){
    if (national_id.readyState == 4 && national_id.status == 200){
        national_id_response = national_id.responseText;

        // document.getElementById("id-result").className = national_id.responseText;
        document.getElementById("id-result").className = national_id_response;
        // if(national_id_response == "notify-show"){
        //     document.getElementById("succesButton").className = "disabled";
        // }
        // else{
        //     document.getElementById("succesButton").className = "";
        // }
        Check_bt_Integrity();
    }
}

var pw;
function checkpassword(){
    pw = new XMLHttpRequest();
    pw.onreadystatechange = checking_password;

    var password = document.getElementById("password").value;
    var password2 = document.getElementById("re-password").value;
    // console.log("ps1 : " + password + "\nps2 : " + password2);

    var url = "check_password.php?ps1=" + password + "&ps2=" + password2;

    pw.open("GET",url);
    pw.send();
}

function checking_password(){
    if (pw.readyState == 4 && pw.status == 200){
        pw_response = pw.responseText;
        document.getElementById("checkpw-result").className = pw_response;
        // console.log("response pw :" + pw_response)

        Check_bt_Integrity();
    }
}

var bt;
function Check_bt_Integrity(){
    bt = new XMLHttpRequest();
    bt.onreadystatechange = Checking_span;

    var std_class = document.getElementById("std-id-result").className;
    var nid_class = document.getElementById("id-result").className;
    var pw_class = document.getElementById("checkpw-result").className;
    // console.log("std : " + std_class);
    // console.log("nid : " + nid_class);

    var url = "bt_integrity.php?std_class=" + std_class + "&nid_class=" + nid_class + "&pw_class=" + pw_class;

    bt.open("GET",url);
    bt.send();
}

function Checking_span(){
    if (bt.readyState == 4 && bt.status == 200){
        var bt_submit = document.getElementById("succesButton")
        var bt_response = bt.responseText;
        bt_submit.className = bt_response;

        if(bt_response == "disabled"){
            bt_submit.diabled = true;
        }else{
            bt_submit.disabled = false;
        }
        
        // console.log(bt.responseText);
    }
}