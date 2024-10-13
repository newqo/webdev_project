<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/accountpage.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://kit.fontawesome.com/9703a87d5d.js"
      crossorigin="anonymous"
    ></script>
    <script src="javascript/accountpage.js"></script>
    <title>ข้อมูลส่วนตัวนักศึกษา</title>
  </head>

  <body>
    <header>
      <nav>
        <div class="menu-bar">
          <div class="logo-menu">
            <a href="homepage.php"
              ><img src="imgs/Student_Loan_logo.svg" alt="Logo" width="64px"
            /></a>
          </div>
          <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
            <div class="menu" id="mobile-menu" aria-hidden="true">
              <ul>
                <li><a href="#">หน้าหลัก</a></li>
                <li>
                  <a href="#" id="service" onclick="viewmore()">
                    บริการ
                    <ul id="sub-sevice-result">
                      <li><a href="#">ผู้กู้รายใหม่</a></li>
                      <li><a href="#">ผู้กู้รายเก่า</a></li>
                    </ul>
                  </a>
                </li>
                <li><a href="#">ติดต่อเรา</a></li>
                <div class="section-title-menu">หมวดหมู่</div>
                <li><a href="#">ข้อมูลส่วนตัวนักศึกษา</a></li>
                <li><a href="#">ข้อมูลการศึกษา</a></li>
                <li><a href="#">ข้อมูลของครอบครัว</a></li>
                <li><a href="#">ประวัติการจอง</a></li>
                <li><a href="#">เปลี่ยนแปลงรหัสผ่าน</a></li>
              </ul>
            </div>
          </div>
          <div class="menu-text-bar">
            <ul>
              <li><a href="#">หน้าหลัก</a></li>
              <li><a href="#">บริการ</a>
                <ul id="sub-sevice-result">
                  <li><a href="#">ผู้กู้รายใหม่</a></li>
                  <li><a href="#">ผู้กู้รายเก่า</a></li>
                </ul></li>
              <li><a href="#">ติดต่อเรา</a></li>
            </ul>
          </div>
          <div class="menu-user-bar">
            <a href="">ชื่อผู้ใช้</a>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div class="content-container">
        <aside>
          <div class="section-title-menu">หมวดหมู่</div>
          <div class="menu">
            <a href="#">ข้อมูลส่วนตัวนักศึกษา</a>
            <a href="#">ข้อมูลการศึกษา</a>
            <a href="#">ข้อมูลของครอบครัว</a>
            <a href="#">ประวัติการจอง</a>
            <a href="#">เปลี่ยนแปลงรหัสผ่าน</a>
          </div>
        </aside>

        <article>
          <div class="section-title">ข้อมูลส่วนตัวนักศึกษา</div>
          <div class="form-row">
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
              <input
                type="text"
                id="user_firstname"
                name="user_firstname"
                pattern="[A-Za-zก-๗]{2,50}"
                required
              />
            </div>
            <div class="form-group">
              <label>นามสกุล</label>
              <input
                type="text"
                id="user_lastname"
                name="user_lastname"
                pattern="[A-Za-zก-๗]{2,50}"
                required
              />
            </div>
            <div class="form-group">
              <label>เลขบัตรประชาชน</label>
              <input
                type="text"
                id="user_id"
                name="user_id"
                pattern="[0-9]{13}"
                required
              />
            </div>
            <div class="form-group">
              <label>วัน/เดือน/ปีเกิด</label>
              <input type="date" id="birthdate" name="birthdate" required />
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input
                type="email"
                id="email"
                name="email"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                required
              />
            </div>
            <div class="form-group">
              <label>เบอร์โทร</label>
              <input
                type="text"
                id="phone_number"
                name="phone_number"
                pattern="[0-9]{10}"
                required
              />
            </div>
            <div class="form-group">
              <label>ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้)</label>
              <input
                type="text"
                id="user_address"
                name="user_address"
                pattern="/d/w/s{1,200}"
                required
              />
            </div>
            <button id="success-bt">แก้ไข</button>
          </div>
        </article>
      </div>
    </main>

    <footer></footer>
  </body>
</html>
