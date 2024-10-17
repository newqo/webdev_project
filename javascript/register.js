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

function showSection() {

    document.getElementById("father-info").style.display = "none";
    document.getElementById("mother-info").style.display = "none";
    document.getElementById("guardian-info").style.display = "none";
    document.getElementById("father-income-info").style.display = "none";
    document.getElementById("mother-income-info").style.display = "none";
    document.getElementById("guardian-income-info").style.display = "none";

    var selectedValue = document.getElementById("pattern_status").value;
    console.log("Selected value: ", selectedValue);
    
    if (selectedValue === "0") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
    } else if (selectedValue === "1") {
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
    } else if (selectedValue === "3") {
        document.getElementById("guardian-info").style.display = "block";
        document.getElementById("guardian-income-info").style.display = "block";
    } else if (selectedValue === "2") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
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

        if(std_response == "notify-show"){
            document.getElementById("succesButton").className = "disabled";
        }
        else{
            document.getElementById("succesButton").className = "";
        }
        
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
        if(national_id_response == "notify-show"){
            document.getElementById("succesButton").className = "disabled";
        }
        else{
            document.getElementById("succesButton").className = "";
        }
    }
}