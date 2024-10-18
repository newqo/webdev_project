function myFunction() {
  document.getElementById("myDropdown-menu").classList.toggle("show");
}

window.onclick = function(e) {
  if (!e.target.matches('.drop-menu-btn')) {
  var myDropdown = document.getElementById("myDropdown-menu");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}

// 

//mobile 
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

// menu user
function myFunctionUser() {
  var myDropdown = document.getElementById("myDropdown-menu-user");
  myDropdown.classList.toggle("show-user");
}

window.onclick = function(e) {
  if (!e.target.matches('.dropdown-menu-user a')) {
    var myDropdown = document.getElementById("myDropdown-menu-user");
    if (myDropdown.classList.contains('show-user')) {
      myDropdown.classList.remove('show-user');
    }
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
          <select name="user_nametitle" id="user_nametitle" required>
            <option value="">เลือกคำนำหน้า</option>
            <option value="mr">นาย</option>
            <option value="ms">นางสาว</option>
            <option value="mrs">นาง</option>
          </select>
        </div>
        <div class="form-group">
          <label>ชื่อ</label>
          <input type="text" id="user_firstname" name="user_firstname" pattern="[A-Za-zก-๗]{2,}" required />
        </div>
        <div class="form-group">
          <label>นามสกุล</label>
          <input type="text" id="user_lastname" name="user_lastname" pattern="[A-Za-zก-๗]{2,}" required />
        </div>
        <div class="form-group">
          <label>เลขบัตรประชาชน</label>
          <input type="text" id="user_id" name="user_id" pattern="[0-9]{13}" required />
        </div>
        <div class="form-group">
          <label>วัน/เดือน/ปีเกิด</label>
          <input type="date" id="birthdate" name="birthdate" required />
        </div>
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$" required />
        </div>
        <div class="form-group">
          <label>เบอร์โทร</label>
          <input type="text" id="phone_number" name="phone_number" pattern="[0-9]{10}" required />
        </div>
        <div class="form-group">
          <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)</label>
          <input type="text" id="user_address" name="user_address" required />
        </div>
        <button id="success-bt">แก้ไข</button>
      </form>`;
  } else if (page === "education") {
    articleContent.innerHTML = `
      <div class="form-group">
      <div class="section-title">ข้อมูลการศึกษา</div>
                        <label>ระดับชั้น</label>
                        <select name="user_year" id="user_year" onchange="updateFaculty()" required>
                            <option value="">เลือกระดับชั้น</option>
                            <option value="vc">ปวช.</option>
                            <option value="b">ป.ตรี</option>
                            <option value="m">ป.โท</option>
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <label>คณะ</label>
                        <select name="faculty" id="faculty" onchange="updateMajor()" required>
                            <option value="">เลือกคณะ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>สาขา</label>
                        <select name="major" id="major" required>
                            <option value="">เลือกสาขา</option>
                        </select>
                    </div>
                    <button id="success-bt">แก้ไข</button>`;
  }
  else if (page === "parents") {
    articleContent.innerHTML = `
    <div class="section-title">ข้อมูลของครอบครัว</div>
      <!-- ข้อมูลของบิดา -->
                    <div class="section" id="father-info" style="display: none;">
                        <div class="section-title">ข้อมูลของบิดา</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>คำนำหน้า</label>
                                    <select id="nametitle_father" name="nametitle_father" required>
                                        <option value="">เลือกคำนำหน้า</option>
                                        <option value="mr">นาย</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อจริง*</label>
                                <input type="text" id="firstname_father" name="firstname_father" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                            </div>
                            <div class="form-group">
                                <label>นามสกุล*</label>
                                <input type="text" id="lastname_father" name="lastname_father" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทร*</label>
                                <input type="text" id="phone_number_father" name="phone_number_father" placeholder="0981234567" pattern="[0-9]{10}" required>
                            </div>
                        </div>
                    </div>

        <!-- รายได้ของบิดา -->
        <div class="section" id="father-income-info" style="display: none;">
            <div class="section-title">รายได้ของบิดา</div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_father" name="job_detail_father" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของบิดา (ต่อปี)*</label>
                    <input type="text" id="annual_income_father" name="annual_income_father" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
        
        
        <!-- ข้อมูลของมารดา -->
        <div class="section" id="mother-info" style="display: none;">
            <div class="section-title">ข้อมูลของมารดา</div>
            <div class="form-row">
                <div class="form-group">
                    <label>คำนำหน้า</label>
                        <select id="nametitle_mother" name="nametitle_mother" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="ms">นางสาว</option>
                            <option value="mrs">นาง</option>
                        </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง*</label>
                    <input type="text" id="firstname_mother" name="firstname_mother" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>นามสกุล*</label>
                    <input type="text" id="lastname_mother" name="lastname_mother" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>เบอร์โทร*</label>
                    <input type="text" id="phone_number_mother" name="phone_number_mother" placeholder="0981234567" pattern="[0-9]{10}" required>
                </div>
            </div>
        </div>

        <!-- รายได้ของมารดา -->
        <div class="section" id="mother-income-info" style="display: none;">
            <div class="section-title">รายได้ของมารดา</div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_mother" name="job_detail_mother" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของมารดา (ต่อปี)*</label>
                    <input type="text" id="annual_income_mother" name="annual_income_mother" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
        
        <!-- ข้อมูลของผู้ปกครอง-->
        <div class="section" id="guardian-info" style="display: none;">
            <div class="section-title">ข้อมูลของผู้ปกครอง</div>
            <div class="form-row">
                <div class="form-group">
                    <label>คำนำหน้า</label>
                        <select id="nametitle_guardian" name="nametitle_guardian" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="mr">นาย</option>
                            <option value="ms">นางสาว</option>
                            <option value="mrs">นาง</option>
                        </select>
                </div>
                <div class="form-group">
                    <label>ชื่อจริง*</label>
                    <input type="text" id="firstname_guardian" name="firstname_guardian" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>นามสกุล*</label>
                    <input type="text" id="lastname_guardian" name="lastname_guardian" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>เบอร์โทร*</label>
                    <input type="text" id="phone_number_guardian" name="phone_number_guardian" placeholder="0981234567" pattern="[0-9]{10}" required>
                </div>
            </div>
        </div>

        <!-- รายได้ของผู้ปกครอง -->
        <div class="section" id="guardian-income-info" style="display: none;">
            <div class="section-title">รายได้ของผู้ปกครอง</div>
            <div class="form-row">
                <div class="form-group">
                    <label>ระบุอาชีพ หรือรายละเอียดของงาน*</label>
                    <input type="text" id="job_detail_guardian" name="job_detail_guardian" pattern="[A-Za-zก-ฮ-๗]{2,50}" required>
                </div>
                <div class="form-group">
                    <label>รายได้ของผู้ปกครอง (ต่อปี)*</label>
                    <input type="text" id="annual_income_guardian" name="annual_income_guardian" pattern="[0-9]{1,}" required>
                </div>
            </div>
        </div>
        <button id="success-bt">แก้ไข</button>`;
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
                <input type="password" id="password" name="password" pattern="\w{8,20}" required>
            </div>
              <div class="form-group">
                  <label>รหัสผ่านใหม่</label>
                  <input type="password" id="password" name="password" pattern="\w{8,20}" required>
              </div>
              <div class="form-group">
                  <label>ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                  <input type="password" id="re-password" name="password" pattern="\w{8,20}" required>
              </div>
          <button id="success-bt">ยืนยัน</button>
          </form>
      `;
  }
}
