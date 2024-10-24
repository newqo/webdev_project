
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
window.onclick = function (e) {
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
// parents
function showSection(selectedValue) {
  // console.log(selectedValue);
  document.getElementById("father-info").style.display = "none";
  document.getElementById("father-income-info").style.display = "none";
  document.getElementById("mother-info").style.display = "none";
  document.getElementById("mother-income-info").style.display = "none";
  document.getElementById("guardian-info").style.display = "none";
  document.getElementById("guardian-income-info").style.display = "none";

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

// article
var article;
function showContent(page) {
  article = new XMLHttpRequest();
  article.onreadystatechange = Query_Content;

  var url = "account_page_content.php?content=" + page;

  article.open("GET",url);
  article.send();
}

function Query_Content(){
  if (article.readyState == 4 && article.status == 200) {
    var articleContent = document.getElementById("article-content");
    articleContent.innerHTML = article.responseText;
  }
}

var pswd;
function changepassword(){
  pswd = new XMLHttpRequest();
  pswd.onreadystatechange = changing_password;

  current_pswd = document.getElementById('password_id').value;
  new_pswd = document.getElementById('new_password_id').value;
  re_new_pswd = document.getElementById('re_new_password_id').value;

  var url = "checking_password.php?current=" + current_pswd + "&new=" + new_pswd + "&renew=" + re_new_pswd;
  console.log(url);
  pswd.open("GET",url);
  pswd.send();
}

function changing_password(){
  if (pswd.readyState == 4 && pswd.status == 200){
    console.log("changing_password()");
    console.log(pswd.responseText);
    var span = document.getElementById('result');
    span.innerHTML = pswd.responseText;
  } 
}

var faculty;
function updateFaculty(nid){
    faculty = new XMLHttpRequest();
    faculty.onreadystatechange = function(){
      Faculty_query(nid);
    }

    var ed_level = document.getElementById("user_year").value;
    // console.log(ed_level)
    var url = "Edit_account_update_faculty.php?ed_level=" + ed_level + "&nid=" + nid;
    faculty.open("GET",url,true);
    faculty.send()
}

function Faculty_query(nid){
    if (faculty.readyState == 4 && faculty.status == 200){
        var faculty_select = document.getElementById("faculty");
        // console.log(faculty.responseText);
        faculty_select.innerHTML = faculty.responseText;
        updateMajor(nid);
    }
}

var major;
function updateMajor(nid){
    major = new XMLHttpRequest();
    major.onreadystatechange = Major_query;

    var faculty_select = document.getElementById("faculty").value;
    var ed_level = document.getElementById("user_year").value;
    var url = "Edit_account_update_major.php?ed_level="+ ed_level + "&Faculty=" + faculty_select + "&nid=" + nid;

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