const months = [
    "มกราคม",  
    "กุมภาพันธ์", 
    "มีนาคม",   
    "เมษายน",  
    "พฤษภาคม", 
    "มิถุนายน",  
    "กรกฎาคม", 
    "สิงหาคม",  
    "กันยายน",  
    "ตุลาคม",   
    "พฤศจิกายน",
    "ธันวาคม"   
];

var current_month;
var current_year;

var open_date;
var close_date;

function GetDuration(start,end){
    open_date = new Date(start);
    close_date = new Date(end);

    generate_calendar(open_date);
}

function initialCalendar(startDate){

    const current_date = new Date(startDate);
    current_month = current_date.getMonth();
    current_year = current_date.getFullYear();

    Check_OutOfDate();
}

function generate_calendar(start){
    initialCalendar(start);

    var table = document.getElementById("calendar-body");
    table.innerHTML = '';
    
    var calendar_title = document.getElementById("calendar-title");
    calendar_title.innerHTML = months[current_month] + " " + current_year;

    var totalDate = GetTotalDateinMonth(current_year,current_month);
    var first_day_in_month =  new Date(current_year,current_month,1).getDay();
    
    var n_date = 1;

    for(let rows = 0 ; rows < 6 ; rows++){
        let tr = document.createElement("tr");
        for(let col = 0 ; col < 7 ; col++){
            let td = document.createElement("td");
            
            if (rows == 0 && col < first_day_in_month){
                td.innerHTML = "";
            }
            else if (n_date <= totalDate){
                td.innerHTML = n_date;

                td.dataset.value = n_date;
                
                d = new Date(current_year,current_month,n_date);
                // console.log("------------checking-------------");
                // console.log("d : " + d);
                // console.log("open : " + open_date);
                // console.log("close : " + close_date);
                // console.log("-------------------------");

                if(d.getDay() == 0 || d.getDay() == 6 || SetDateFormat(d) < SetDateFormat(open_date) || SetDateFormat(d) > SetDateFormat(close_date)){
                    td.style.opacity = "0.5";
                    td.style.backgroundColor = "#f2f2f2";
                    td.style.color = "#b0b0b0";
                }
                else {
                    td.onclick = function() {
                        Check_Reservation_Round(this);
                        resetSelection();
                    }
                }

                n_date++;
            }
            else{
                td.innerHTML = "";
            }
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
}

function SetDateFormat(date){
    return new Date(date.getFullYear(),date.getMonth(),date.getDate());
}

function GetTotalDateinMonth(year,month){
    return new Date(year,month+1,0).getDate();
}


var lastSelectedID = null;
var round_morning_xmlhttp;
var round_noon_xmlhttp;
function Check_Reservation_Round(Td_Selected){
    if(lastSelectedID) {
        lastSelectedID.id = "";
    }
    Td_Selected.id = "selected";
    lastSelectedID = Td_Selected;

    var value = Td_Selected.dataset.value;

    var morning_bt = document.getElementById("round-morning");
    var noon_bt = document.getElementById("round-noon");
    if(value != null){
        morning_bt.removeAttribute("disabled");
        noon_bt.removeAttribute("disabled");
    }
    else{
        morning_bt.setAttribute("disabled","true");
        noon_bt.setAttribute("disabled","true");
    }

    // console.log(value);
    var date_num = parseInt(value);
    var month_num = parseInt(current_month) + 1;
    var this_date = current_year + "-" + (month_num < 10 ? '0' + month_num : month_num) + "-" + (date_num < 10 ? '0' + date_num : date_num);

    console.log("this value is " + this_date);

    var reservation_date = document.getElementById("reservation_date_id");
    reservation_date.value = this_date;

    round_morning_xmlhttp = new XMLHttpRequest();
    round_noon_xmlhttp = new XMLHttpRequest();

    round_morning_xmlhttp.onreadystatechange = checking_morning_round;
    round_noon_xmlhttp.onreadystatechange = checking_noon_round;

    var morning = document.getElementById("round-morning").value;
    var noon = document.getElementById("round-noon").value;

    var morning_url = "checking_reservation_round.php?round=" + morning + "&reservation_date=" + this_date;
    var noon_url = "checking_reservation_round.php?round=" + noon + "&reservation_date=" + this_date;

    round_morning_xmlhttp.open("GET",morning_url);
    round_morning_xmlhttp.send();

    round_noon_xmlhttp.open("GET",noon_url);
    round_noon_xmlhttp.send();

    resetSelection();
}

function checking_morning_round(){
    if (round_morning_xmlhttp.readyState == 4 && round_morning_xmlhttp.status == 200){
        var morning_response = round_morning_xmlhttp.responseText;
        var bt_morning = document.getElementById("round-morning");
        console.log("morning :" + morning_response);
        if(morning_response == "full"){
            bt_morning.disabled = true;
            bt_morning.style.opacity = "0.5";
        }else{
            bt_morning.disabled = false;
            bt_morning.style.opacity = "1";
        }
    }
}

function checking_noon_round(){
    if (round_noon_xmlhttp.readyState == 4 && round_noon_xmlhttp.status == 200){
        var noon_response = round_noon_xmlhttp.responseText;
        var bt_noon = document.getElementById("round-noon");
        console.log("noon :" +noon_response);
        if(noon_response == "full"){
            bt_noon.disabled = true;
            bt_noon.style.opacity = "0.5";
        }else{
            bt_noon.disabled = false;
            bt_noon.style.opacity = "1";
        }
    }
}

function Check_OutOfDate(){
    var previous_btn = document.getElementById("previous");
    var next_btn = document.getElementById("next");

    var before = new Date(current_year,current_month);
    var next = new Date(current_year,current_month+1)

    console.log("--------------------------");
    console.log("before : " + before);
    console.log("open : " + open_date);
    console.log("next : " + next);
    console.log("close : " + close_date);

    // previous
    if(before < open_date){
        previous_btn.disabled = true;
        previous_btn.style.opacity = "0.5";
    }
    else{
        previous_btn.disabled = false;
        previous_btn.style.opacity = "1";
    }

    // next
    if(next > close_date){
        next_btn.disabled = true;
        next_btn.style.opacity = "0.5";
    }
    else{
        next_btn.disabled = false;
        next_btn.style.opacity = "1";
    }
}



function ScrollMonth(id){
    var action = document.getElementById(id).value;

    if (action === "previous") {
        if (current_month === 0) {
            current_month = 11;
            current_year--;
        } else {
            current_month--;
        }
    } else { // next
        if (current_month === 11) {
            current_month = 0;
            current_year++;
        } else {
            current_month++;
        }
    }

    generate_calendar(new Date(current_year, current_month, 1));
}

function selected_round(id){
    const button = document.getElementsByClassName("reservation_round_bt");

    for (let i of button){
        i.classList.remove("round-selected");
    }

    const select_bt = document.getElementById(id);
    select_bt.classList.add("round-selected");

    var selected_round = document.getElementById("select_round_id");
    selected_round.value = select_bt.value;
    console.log(selected_round.value);

    Check_confirm_bt();
}

function Check_confirm_bt(){
    var reserv_date = lastSelectedID.dataset.value;
    var reserv_round = document.getElementById("select_round_id").value;

    var confirm_bt = document.getElementById("submit_bt_id");
    console.log(reserv_date + " , " + reserv_round);
    if(reserv_date != null && reserv_round != null){
        confirm_bt.removeAttribute("disabled");
    }else{
        confirm_bt.setAttribute("disabled" , "true");
    }
}

function resetSelection() {
    var selected_round = document.getElementById("select_round_id");
    selected_round.value = "";

    const buttons = document.getElementsByClassName("reservation_round_bt");
    for (let button of buttons) {
        button.classList.remove("round-selected");
    }
    var confirm_bt = document.getElementById("submit_bt_id");
    confirm_bt.setAttribute("disabled","true");

    console.log("Selection has been reset.");
}
function myFunction() {
    var myDropdown = document.getElementById("myDropdown-menu");
    myDropdown.classList.toggle("show");
  }
  
  // mobile
  function openNav() {
    document.getElementById("sidebar-mobile").style.width = "100%";
    document.getElementById("sidebar-mobile").classList.add("show");
  }
  
  function closeNav() {
    document.getElementById("sidebar-mobile").style.width = "0";
    document.getElementById("sidebar-mobile").classList.remove("show");
  }
  
  // mobile dropdown
  function myFunctionMobile() {
    var dropdown = document.getElementById("myDropdown-menu-mobile");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
  }
  
  // user menu
  function myFunctionUser() {
    var myDropdownuser = document.getElementById("myDropdown-menu-user");
    myDropdownuser.classList.toggle("show-user");
  }
  
  // Close dropdowns when clicking outside
  window.onclick = function(e) {
    // For main dropdown
    if (!e.target.closest('.dropdown-menu')) {
      var myDropdown = document.getElementById("myDropdown-menu");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
    }
    
    // For user menu dropdown
    if (!e.target.closest('.dropdown-menu-user')) {
      var myDropdownuser = document.getElementById("myDropdown-menu-user");
      if (myDropdownuser.classList.contains('show-user')) {
        myDropdownuser.classList.remove('show-user');
      }
    }
  }
  