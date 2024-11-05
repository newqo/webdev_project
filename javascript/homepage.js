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


//menu dropdown
function myFunction() {
  var myDropdown = document.getElementById("myDropdown-menu");
  myDropdown.classList.toggle("show");
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
