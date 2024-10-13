document.addEventListener("DOMContentLoaded", function () {
    // Load the navbar via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "navbar.html", true);

    
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("menu-bar").innerHTML = xhr.responseText;


        // After the navbar is loaded, attach event listener for menu toggle
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");
        const imgLogo = document.querySelector(".logo-menu");

        menuToggle.addEventListener("click", function () {
          mobileMenu.classList.toggle("active");

          if (mobileMenu.classList.contains("active")) {
            mobileMenu.style.display = "flex";
            imgLogo.style.display = "none"; // Hide logo when menu is open
          } else {
            mobileMenu.style.display = "none";
            imgLogo.style.display = "block"; // Show logo when menu is closed
          }
        });
      }
    };
    xhr.send();
  });