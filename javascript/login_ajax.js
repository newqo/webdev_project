var xmlhttp;

function login_validation(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = validation;

    username = document.getElementById("user_national_id").value;
    password = document.getElementById("user_password").value;
    var url = "login_validation.php";
    xmlhttp.open("POST", url,true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "user_national_id=" + username + "&user_password=" + password;
    xmlhttp.send(params);
}

function validation(){
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        // console.log(xmlhttp.responseText);
        if (xmlhttp.responseText == "successful") {
            document.location = "homepage.php";
        }else if (xmlhttp.responseText == "เลขบัตรประชาชนหรือรหัสผ่านไม่ถูกต้อง"){
            document.getElementById("result").innerHTML = xmlhttp.responseText;
        }
    }
}