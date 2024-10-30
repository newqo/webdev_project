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
  