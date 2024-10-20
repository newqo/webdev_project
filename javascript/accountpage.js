
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
function showContent(page) {
  const articleContent = document.getElementById("article-content");

  if (page === "student") {
    articleContent.innerHTML = `
      <div class="section-title">ข้อมูลส่วนตัวนักศึกษา</div>
      <form action="#" method="post">
        <div class="form-group">
          <label>คำนำหน้า</label>
          <select name="user_nametitle" id="user_nametitle" disabled="disabled">
            <option value="">เลือกคำนำหน้า</option>
  
          </select>
        </div>
        <div class="form-group">
          <label>ชื่อจริง</label>
          <input type="text" id="user_firstname" name="user_firstname" pattern="[A-Za-zก-๗]{2,}" disabled="disabled" />
        </div>
        <div class="form-group">
          <label>นามสกุล</label>
          <input type="text" id="user_lastname" name="user_lastname" pattern="[A-Za-zก-๗]{2,}" disabled="disabled" />
        </div>
        <div class="form-group">
          <label>รหัสนักศึกษา*</label>
          <input type="text" id="user_stdID" name="user_stdID" pattern="[0-9]{13}" maxlength="13" onkeyup="check_std_id()" disabled="disabled">
        </div>
        <div class="form-group">
          <label>เลขบัตรประชาชน*</label>
          <input type="text" id="user_id" name="user_id" pattern="[0-9]{13}" maxlength="13" onkeyup="check_national_id()" disabled="disabled">
        </div>
        <div class="form-group">
          <label>วัน/เดือน/ปีเกิด</label>
          <input type="date" id="birthdate" name="birthdate" disabled="disabled" />
        </div>
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$" disabled="disabled" />
        </div>
        <div class="form-group">
          <label>เบอร์โทร</label>
          <input type="text" id="phone_number" name="phone_number" pattern="[0-9]{10}" disabled="disabled" />
        </div>
        <div class="form-group" style="flex: 2;">
          <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)*</label>
          <input type="text" id="user_address" name="user_address" pattern="[A-Za-z0-9\s,.]{2,200}" maxlength="200" disabled="disabled">
        </div>
        <button id="success-bt">แก้ไข</button>
      </form>`;
  } else if (page === "education") {
    articleContent.innerHTML = `
      <div class="section-title">ข้อมูลการศึกษา</div>
      <div class="form-group">
      <form action="#" method="post">
      <div class="form-group">
        <label>ระดับชั้น</label>
        <select name="user_year" id="user_year" onchange="updateFaculty()" disabled="disabled">
            <option value="">เลือกระดับชั้น</option>
        </select>
      </div>
      <div class="form-group">
          <label>คณะ</label>
          <select name="faculty" id="faculty" onchange="updateMajor()" disabled="disabled">
            <option value="">เลือกคณะ</option>
          </select>
      </div>
      <div class="form-group">
          <label>สาขา</label>
          <select name="major" id="major" disabled="disabled">
              <option value="">เลือกสาขา</option>
          </select>
      </div>
      <button id="success-bt">แก้ไข</button>`;
  }
  else if (page === "parents") {
    articleContent.innerHTML = `
    <div class="section-title">ข้อมูลของครอบครัว</div>
    <form action="#" method="post">
        <!-- ส่วนข้อมูลของบิดา -->
        <div class="section" id="father-info">
            <div class="section-title-parents">ข้อมูลของบิดา</div>
                <div class="form-group">
                    <label>คำนำหน้า</label>
                    <select id="nametitle_father" name="father_pre_name" disabled="disabled">
                        <option value="">เลือกคำนำหน้า</option>
                        <?php
                            $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_id = 1");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            echo "<option value='". $row["Pre_name_id"] ."'>". $row["Pre_name_desc"] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง</label>
                    <input type="text" id="firstname_father" name="father_fst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" id="lastname_father" name="father_lst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>เบอร์โทร</label>
                    <input type="text" id="phone_number_father" name="father_phone_num" maxlength="10" pattern="[0-9]{10}" disabled="disabled">
                </div>
                    <div class="form-group">
                        <label>อาชีพ</label>
                        <input type="text" id="job_detail_father" name="father_career" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของบิดา (ต่อปี)</label>
                        <input type="number" id="annual_income_father" name="father_annual_income" min="0" max="9999999999" disabled="disabled">
                    </div>
                </div>
            </div>

        <!-- ส่วนข้อมูลของมารดา -->
        <div class="section" id="mother-info">
            <div class="section-title-parents">ข้อมูลของมารดา</div>
                <div class="form-group">
                    <label>คำนำหน้า</label>
                    <select id="nametitle_mother" name="mother_pre_name" disabled="disabled">
                        <option value="">เลือกคำนำหน้า</option>
                        <?php
                            $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_id = 2");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            echo "<option value='". $row["Pre_name_id"] ."'>". $row["Pre_name_desc"] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง</label>
                    <input type="text" id="firstname_mother" name="mother_fst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" id="lastname_mother" name="mother_lst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>เบอร์โทร</label>
                    <input type="text" id="phone_number_mother" name="mother_phone_num" maxlength="10" pattern="[0-9]{10}" disabled="disabled">
                </div>
                <div class="form-group">
                        <label>อาชีพ</label>
                        <input type="text" id="job_detail_mother" name="mother_career" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของมารดา (ต่อปี)</label>
                        <input type="number" id="annual_income_mother" name="mother_annual_income" min="0" max="9999999999" disabled="disabled">
                    </div>
            </div>

        <!-- ส่วนข้อมูลของผู้ปกครอง -->
        <div class="section" id="guardian-info">
            <div class="section-title-parents">ข้อมูลของผู้ปกครอง</div>
                <div class="form-group">
                    <label>คำนำหน้า</label>
                    <select id="nametitle_guardian" name="guardian_pre_name" disabled="disabled">
                        <option value="">เลือกคำนำหน้า</option>
                        <?php
                            $stmt = $pdo->prepare("SELECT Pre_name_id,Pre_name_desc FROM Pre_name WHERE Pre_name_id = 3");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            echo "<option value='". $row["Pre_name_id"] ."'>". $row["Pre_name_desc"] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง</label>
                    <input type="text" id="firstname_guardian" name="guardian_fst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" id="lastname_guardian" name="guardian_lst_name" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                </div>
                <div class="form-group">
                    <label>เบอร์โทร</label>
                    <input type="text" id="phone_number_guardian" name="guardian_phone_num" maxlength="10" pattern="[0-9]{10}" disabled="disabled">
                </div>
                <div class="form-group">
                        <label>อาชีพ</label>
                        <input type="text" id="job_detail_guardian" name="guardian_career" pattern="[A-Za-zก-ฮ-๗]{2,50}" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label>รายได้ของผู้ปกครอง (ต่อปี)</label>
                        <input type="number" id="annual_income_guardian" name="guardian_annual_income" min="0" max="9999999999" disabled="disabled">
                    </div>
            </div>
        <button id="success-bt">แก้ไข</button>
    </form>`
    document.getElementById("relation-select").addEventListener("change", function() {
      showSection(this.value);
  });
  ;
  }
  else if (page === "history") {
    articleContent.innerHTML = `
    <div class="section-title">ประวัติการจอง</div>
          <form action="#" method="post">
            <div class="box">
              <div class="section-title-box">จองคิว</div>
              <p>วันที่จอง</p>
              <p>ลำดับคิว</p>
              <p>สถานที่</p>
              <button id="success-bt">พิมพ์</button>
            </div>
          </form>
      `;
  }
  else if (page === "changepassword") {
    articleContent.innerHTML = `
    <div class="section-title">เปลี่ยนแปลงรหัสผ่าน</div>
          <form action="#" method="post">
              <div class="form-group">
                <label>รหัสผ่านปัจจุบัน</label>
                <input type="password" id="password" name="password" pattern="\w{8,20}">
            </div>
              <div class="form-group">
                  <label>รหัสผ่านใหม่</label>
                  <input type="password" id="password" name="password" pattern="\w{8,20}">
              </div>
              <div class="form-group">
                  <label>ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                  <input type="password" id="re-password" name="password" pattern="\w{8,20}">
              </div>
          <button id="success-bt">ยืนยัน</button>
          </form>
      `;
  }
}
