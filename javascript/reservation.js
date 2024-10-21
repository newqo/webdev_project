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

var open = "2024-10-01";
var close = "2024-12-05";

var open_date = new Date(open);
var close_date = new Date(close);

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
                
                d = new Date(current_year,current_month,n_date)
                if(d.getDay() == 0 || d.getDay() == 6){
                    td.style.opacity = "0.5";
                }
                else{
                    td.onclick = function() {
                        printID(this);
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

function GetTotalDateinMonth(year,month){
    return new Date(year,month+1,0).getDate();
}

var lastSelectedID = null;

function printID(Td_Selected){
    var value = Td_Selected.dataset.value;
    console.log(value);
    var date_num = parseInt(value);
    var month_num = parseInt(current_month) + 1;
    console.log("this value is " + current_year + "-" 
        + (month_num < 10 ? '0' + month_num : month_num) + "-" 
        + (date_num < 10 ? '0' + date_num : date_num));

    if(lastSelectedID) {
        lastSelectedID.id = "";
    }
    Td_Selected.id = "selected";
    lastSelectedID = Td_Selected;
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

function Submit(){
    selected = document.getElementById("selected");
    if(selected != null){
        console.log(selected.dataset.value);
    }
    else{
        console.log("You didn't select date of reservation")
    }
}