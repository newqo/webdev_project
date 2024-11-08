DROP TABLE IF EXISTS `User_category`;
CREATE TABLE User_category(
    user_cate_id TINYINT(1) NOT NULL,
    category_desc VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (user_cate_id)
);

DROP TABLE IF EXISTS `Pre_name`;
CREATE TABLE Pre_name(
    Pre_name_id INT AUTO_INCREMENT NOT NULL,
    Pre_name_desc VARCHAR(20) NOT NULL,

    PRIMARY KEY (Pre_name_id)
);

DROP TABLE IF EXISTS `Users`;
CREATE TABLE Users (
    national_id VARCHAR(13) NOT NULL,
    Pre_name_id INT,
    firstname VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    lastname VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    Email VARCHAR(50) COLLATE utf8_unicode_ci,
    phone_num VARCHAR(10), 
    birthdate DATE,
    Address VARCHAR(200),
    user_role TINYINT(1),
    user_cate_id TINYINT(1) NOT NULL,
    passwd VARCHAR(100),

    PRIMARY KEY (national_id),
    FOREIGN KEY (Pre_name_id) REFERENCES Pre_name(Pre_name_id),
    FOREIGN KEY (user_cate_id) REFERENCES User_category(user_cate_id)
);

DROP TABLE IF EXISTS `Faculty`;
CREATE TABLE Faculty (
    Faculty_id VARCHAR(2) NOT NULL,
    Faculty_name VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (Faculty_id)
);

DROP TABLE IF EXISTS `Department`;
CREATE TABLE Department (
    Department_id VARCHAR(4) NOT NULL,
    Department_name VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    Faculty_id VARCHAR(2) NOT NULL,

    PRIMARY KEY (Department_id),
    FOREIGN KEY (Faculty_id) REFERENCES Faculty(Faculty_id)
);

DROP TABLE IF EXISTS `Education_Level_Category`;
CREATE TABLE Education_Level_Category(
    ed_category_id INT AUTO_INCREMENT NOT NULL,
    ed_desc VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (ed_category_id)
);

DROP TABLE IF EXISTS `Education`;
CREATE TABLE Education (
    std_ID VARCHAR(13),
    national_id VARCHAR(13) NOT NULL,
    Faculty_id VARCHAR(2) NOT NULL,
    Department_id VARCHAR(4) NOT NULL,
    Education_Level INT,

    PRIMARY KEY (std_ID),
    FOREIGN KEY (national_id) REFERENCES Users(national_id),
    FOREIGN KEY (Faculty_id) REFERENCES Faculty(Faculty_id),
    Foreign Key (Department_id) REFERENCES Department(Department_id),
    FOREIGN KEY (Education_Level) REFERENCES Education_Level_Category(ed_category_id)
);

DROP TABLE IF EXISTS `Parent_status`;
CREATE TABLE Parent_status (
    parent_status_id VARCHAR(10) NOT NULL,
    status_description VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (parent_status_id)
);

DROP TABLE IF EXISTS `Income_Category`;
CREATE TABLE Income_Category (
    income_cate_id INT AUTO_INCREMENT NOT NULL,
    income_cate_desc VARCHAR(30) NOT NULL,

    PRIMARY KEY (income_cate_id)
);

DROP TABLE IF EXISTS `Parent`;
CREATE TABLE Parent (
    parent_id INT AUTO_INCREMENT NOT NULL,
    Pre_name_id INT,
    firstname VARCHAR(50) COLLATE utf8_unicode_ci,
    lastname VARCHAR(50) COLLATE utf8_unicode_ci,
    phone_num VARCHAR(10),
    career VARCHAR(50),
    income INT,
    income_cate_id INT,
    parent_status_id VARCHAR(10) NOT NULL,

    PRIMARY KEY (parent_id),
    FOREIGN KEY (Pre_name_id) REFERENCES Pre_name(Pre_name_id),
    FOREIGN KEY (income_cate_id) REFERENCES Income_Category(income_cate_id),
    FOREIGN Key (parent_status_id) REFERENCES Parent_status(parent_status_id)
);

DROP TABLE IF EXISTS `User_Relationship`;
CREATE TABLE User_Relationship (
    national_id VARCHAR(13) NOT NULL,
    parent_id INT NOT NULL,

    PRIMARY KEY (national_id , parent_id),
    FOREIGN KEY (national_id) REFERENCES Users(national_id),
    Foreign Key (parent_id) REFERENCES Parent(parent_id)
);

DROP TABLE IF EXISTS `Scholarship`;
CREATE TABLE Scholarship (
    scholarship_id VARCHAR(10) NOT NULL,
    scholarship_name VARCHAR(50) NOT NULL,

    PRIMARY KEY (scholarship_id)
);

DROP TABLE IF EXISTS `Cost_of_living_status`;
CREATE TABLE Cost_of_living_status (
    cost_of_living_id TINYINT(1) NOT NULL,
    amount INT NOT NULL,

    PRIMARY KEY (cost_of_living_id)
);

DROP TABLE IF EXISTS `Post_Duration`;
CREATE TABLE Post_Duration (
    Duration_id VARCHAR(10) NOT NULL,
    Start_date DATETIME NOT NULL,
    End_date DATETIME NOT NULL,
    Checklist TINYINT(1) NOT NULL,
    Reservation TINYINT(1) NOT NULL,
    Event_status TINYINT(1) NOT NULL,

    PRIMARY KEY (Duration_id)
);

DROP TABLE IF EXISTS `Checklist`;
CREATE TABLE Checklist (
    checklist_id INT AUTO_INCREMENT NOT NULL,
    national_id VARCHAR(13) NOT NULL,
    scholarship_id VARCHAR(10) NOT NULL,
    cost_of_living_id TINYINT(1) NOT NULL,
    duration_id VARCHAR(10) NOT NULL,

    PRIMARY KEY (checklist_id),
    Foreign Key (national_id) REFERENCES Users(national_id),
    Foreign Key (scholarship_id) REFERENCES Scholarship(scholarship_id),
    Foreign Key (cost_of_living_id) REFERENCES Cost_of_living_status(cost_of_living_id),
    Foreign key (duration_id) REFERENCES Post_Duration(Duration_id)
);

DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE Reservation (
    reservation_id INT AUTO_INCREMENT NOT NULL,
    reserve_date DATE NOT NULL,
    reserve_time TIME NOT NULL,
    queue_no INT NOT NULL,
    checklist_id INT NOT NULL,
    national_id VARCHAR(13) NOT NULL,
    duration_id VARCHAR(10) NOT NULL,

    PRIMARY KEY (reservation_id),
    Foreign Key (checklist_id) REFERENCES Checklist(checklist_id),
    Foreign Key (national_id) REFERENCES Users(national_id),
    Foreign key (duration_id) REFERENCES Post_Duration(Duration_id)
);

INSERT INTO Pre_name(Pre_name_desc)
VALUES
('นาย'),
('นางสาว'),
('นาง');

-- INSERT VALUE INTO User_category Table
INSERT INTO User_category(user_cate_id,category_desc)
VALUES 
(0,"ผู้กู้รายใหม่"),
(1,"ผู้กู้รายเก่า");

INSERT INTO Users (national_id, pre_name_id, firstname, lastname, Email, phone_num, birthdate, user_role, user_cate_id, passwd)
VALUES
('1000000000001',1,'สมชาย', 'ใจดี', 'somchai@example.com', '0812345678', '1990-01-01', 0, 0, 'password1'),
('1000000000002',2, 'สมศรี', 'ใจงาม', 'somsri@example.com', '0812345679', '1990-02-01', 0, 1, 'password2'),
('1000000000003',1, 'สมปอง', 'มีชัย', 'sompong@example.com', '0812345680', '1990-03-01', 0, 1, 'password3'),
('1000000000004',1, 'สมหวัง', 'สุขสม', 'somwang@example.com', '0812345681', '1990-04-01', 0, 1, 'password4'), 
('1000000000005',1, 'สมศักดิ์', 'เจริญรุ่ง', 'somsak@example.com', '0812345682', '1990-05-01', 0, 0, 'password5'),
('1000000000006',1, 'สมบัติ', 'อยู่ดี', 'sombat@example.com', '0812345683', '1990-06-01', 0, 1, 'password6'),
('1000000000007',1, 'สมควร', 'เจริญสุข', 'somkuan@example.com', '0812345684', '1990-07-01', 0, 0, 'password7'),
('1000000000008',1, 'สมใจ', 'อยู่สุข', 'somjai@example.com', '0812345685', '1990-08-01', 0, 1, 'password8'),
('1000000000009',1, 'สมคิด', 'รักดี', 'somkid@example.com', '0812345686', '1990-09-01', 0, 0, 'password9'),
('1000000000010',1, 'สมหมาย', 'สวยงาม', 'sommai@example.com', '0812345687', '1990-10-01', 0, 1, 'password10'), 
('1000000000011',2, 'สมจิต', 'สุขสันต์', 'somjit@example.com', '0812345688', '1990-11-01', 0, 0, 'password11'), 
('1000000000012',1, 'สมร', 'ใจดี', 'somron@example.com', '0812345689', '1990-12-01', 0, 1, 'password12'),
('1000000000013',2, 'สมฤดี', 'เจริญก้าวหน้า', 'somruedee@example.com', '0812345690', '1990-01-15', 0, 0, 'password13'), 
('1000000000014',2, 'สมบุญ', 'อยู่สุข', 'sombun@example.com', '0812345691', '1990-02-15', 0, 1, 'password14'), 
('1000000000015',1, 'สมบูรณ์', 'ใจกล้า', 'sombunr@example.com', '0812345692', '1990-03-15', 0, 0, 'password15'),
('1000000000016',1, 'สมรัก', 'อยู่ดี', 'somrak@example.com', '0812345693', '1990-04-15', 0, 1, 'password16'), 
('1000000000017',1, 'สมพงษ์', 'สมหมาย', 'somphong@example.com', '0812345694', '1990-05-15', 0, 1, 'password17'), 
('1000000000018',1, 'สมชาย', 'เจริญสุข', 'somchai2@example.com', '0812345695', '1990-06-15', 0, 1, 'password18'), 
('1000000000019',2, 'สมหญิง', 'ใจดี', 'somying@example.com', '0812345696', '1990-07-15', 0, 0, 'password19'),
('1000000000020',2, 'สมฤทัย', 'สุขสันต์', 'somruethai@example.com', '0812345697', '1990-08-15', 0, 1, 'password20'),

('Admin1',NULL,'Admin', 'Admin', 'admin@example.com', '-', '1990-01-01', 1, 0, 'adminpswd');

INSERT INTO Income_Category(income_cate_desc)
VALUES
('มีรายได้ประจำ'),
('มีรายได้ไม่ประจำ'),
('ไม่มีรายได้');

INSERT INTO Parent_status (parent_status_id, status_description)
VALUES 
('0', 'อาศัยอยู่กับบิดา'),
('1', 'อาศัยอยู่กับมารดา'),
('2', 'อาศัยอยู่ร่วมกับบิดาและมารดา'),
('3','อาศัยอยู่กับผู้ปกครอง');

INSERT INTO Parent (pre_name_id, firstname, lastname, phone_num, career, income,income_cate_id, parent_status_id)
VALUES
(1,'ก้อง', 'กรุณา', '0812345678', 'วิศวกร', 50000, 1,0),
(1,'ปาล์ม', 'นภัส', '0812345679', 'แพทย์', 60000,1, 1),
(2,'เนตร', 'พิมพ์', '0812345680', 'ครู', 40000,2,2),
(3,'แป้ง', 'หอมหวล', '0812345681', 'นักธุรกิจ', 70000,2, 2),
(1,'ดีใจ', 'รัตนา', '0812345683', 'พยาบาล', 48000,1, 3),
(1,'อิ่ม', 'สุขสม', '0812345684', 'ช่างยนต์', 52000,1, 1),
(1,'ดิน', 'ดีเลิศ', '0812345685', 'ศิลปิน', 65000,1, 0),
(1,'อารมณ์', 'ขันทอง', '0812345686', 'พ่อค้า', 49000,1, 3),
(3,'พลอย', 'สวยงาม', '0812345688', 'นักวิทยาศาสตร์', 71000,1, 2),
(1,'เมฆ', 'จันทร์เจ้า', '0812345689', 'นักเขียน', 43000,2, 2),
(2,'น้ำฟ้า', 'มาลี', '0812345690', 'นักจิตวิทยา', 47000,2, 3),
(2,'ทราย', 'นิลรัตน์', '0812345691', 'ช่างภาพ', 60000,1, 1),
(1,'สบาย', 'สุขใจ', '0812345693', 'นักกีฬา', 51000,1, 0),
(1,'มิตร', 'สัมพันธ์', '0812345694', 'เกษตรกร', 44000,1, 2),
(3,'กุลธิดา', 'ประทุม', '0812345695', 'ธุรกิจส่วนตัว', 80000,2, 2),
(1,'ยิ้ม', 'สันติ', '0812345696', 'ผู้จัดการ', 60000,2, 1),
(1,'สมศรี', 'ดีใจ', '0812345698', 'นักกฎหมาย', 60000,1, 2),
(1,'สมนึก', 'สุขใจ', '0812345699', 'นักดนตรี', 45000,1, 2),
(1,'สายฟ้า', 'รวี', '0812345700', 'นักบิน', 70000,2, 1),
(2,'ชล', 'สุขสม', '0812345702', 'นักพัฒนา', 60000,2, 0),
(1,'พรชัย', 'ปรีดา', '0812345703', 'วิศวกรโยธา', 55000,1, 1),
(1,'วาสนา', 'สมบัติ', '0812345704', 'นักบัญชี', 49000,1, 3),
(3,'ชุติมา', 'ศรีสวัสดิ์', '0812345705', 'เภสัชกร', 68000,1, 3),
(1,'วรชัย', 'รุ่งโรจน์', '0812345706', 'ทนายความ', 72000,2, 1);

INSERT INTO User_Relationship (national_id, parent_id)
VALUES
('1000000000001', 1),
('1000000000002', 2),
('1000000000003', 3),
('1000000000003', 4),
('1000000000004', 5),
('1000000000005', 6),
('1000000000006', 7),
('1000000000007', 8),
('1000000000008', 9),
('1000000000008', 10),
('1000000000009', 11),
('1000000000010', 12),
('1000000000011', 13),
('1000000000012', 14),
('1000000000012', 15),
('1000000000013', 16),
('1000000000014', 17),
('1000000000014', 18),
('1000000000015', 19),
('1000000000016', 20),
('1000000000017', 21),
('1000000000018', 22),
('1000000000019', 23),
('1000000000020', 24);

INSERT INTO Scholarship (scholarship_id,scholarship_name)
VALUES 
("1", "ทุนนักศึกษาที่สร้างชื่อเสียงดีเด่นให้แก่สถาบัน"),
("2","ทุนผู้มีความสามารถพิเศษ"),
("3","ทุนขาดแคลน"),
("4","ทุนเฉลิมราชกุมารี"),
("5","ทุนอุดมศึกษาเพื่อการพัฒนาจังหวัดชายแดนภาคใต้"),
("6","ทุนอุดหนุนการศึกษา ประเภทขาดแคลนแก่นักศึกษาโครงการสมทบพิเศษ (เฉพาะคณะวิทยาศาสตร์ประยุกต์)");

INSERT INTO Cost_of_living_status (Cost_of_living_id,amount)
VALUES
(0,0),
(1,3000);

INSERT INTO Faculty (Faculty_id,Faculty_name)
VALUES
("01","คณะวิศวกรรมศาสตร์"),
("02","คณะครุศาสตร์อุตสาหกรรม"),
("03","วิทยาลัยเทคโนโลยีอุตสาหกรรม"),
("04","คณะวิทยาศาสตร์ประยุกต์"),
("05","คณะอุตสาหกรรมเกษตรดิจิทัล"),
("06","คณะเทคโนโลยีและการจัดการอุตสาหกรรม"),
("07","คณะเทคโนโลยีสารสนเทศและนวัตกรรมดิจิทัล"),
("08","คณะศิลปศาสตร์ประยุกต์"),
("09","บัณฑิตวิทยาลัยวิศวกรรมศาสตร์นานาชาติฯ"),
("10","บัณฑิตวิทยาลัย"),
("11","คณะสถาปัตยกรรมและการออกแบบ"),
("12","คณะวิศวกรรมและเทคโนโลยี"),
("13","คณะวิทยาศาสตร์ พลังงานและสิ่งแวดล้อม"),
("14","คณะบริหารธุรกิจ"),
("15","วิทยาลัยนานาชาติ"),
("16","คณะพัฒนาธุรกิจและอุตสาหกรรม"),
("17","คณะบริหารธุรกิจและอุตสาหกรรมบริการ"),
("18","อุทยานเทคโนโลยี มจพ.");


INSERT INTO Department (Department_id, Department_name, Faculty_id)
VALUES
("0100","วิศวกรรมเครื่องกลและการบิน - อวกาศ","01"),
("0101","วิศวกรรมไฟฟ้าและคอมพิวเตอร์","01"),
("0102","วิศวกรรมการผลิตและหุ่นยนต์","01"),
("0103","วิศวกรรมเคมี","01"),
("0105","วิศวกรรมขนถ่ายวัสดุและอิเล็กทรอนิกส์","01"),
("0106","วิศวกรรมวัสดุและเทคโนโลยีการผลิต","01"),
("0107","วิศวกรรมเครื่องมือวัดและอิเล็กทรอนิกส์","01"),
("0108","วิศวกรรมโยธา","01"),
("0109","วิศวกรรมอุตสาหการ","01"),
("0199","-ไม่ระบุ-","01"),

("0201","ครุศาสตร์เครื่องกล","02"),
("0202","ครุศาสตร์ไฟฟ้า","02"),
("0203","ครุศาสตร์โยธา","02"),
("0204","คอมพิวเตอร์ศึกษา","02"),
("0205","ครุศาสตร์เทคโนโลยีสารสนเทศ","02"),
("0206","บริหารเทคนิคศึกษา","02"),
("0207","บริหารธุรกิจอุตสาหกรรม","02"),
("0299","-ไม่ระบุ-","02"),

("0300","เทคโนโลยีศิลปอุตสาหกรรม","03"),
("0301","เทคโนโลยีวิศวกรรมเครื่องกล","03"),
("0302","เทคโนโลยีวิศวกรรมเครื่องต้นกำลัง","03"),
("0303","เทคโนโลยีวิศวกรรมการเชื่อม","03"),
("0304","เทคโนโลยีวิศวกรรมไฟฟ้า","03"),
("0305","เทคโนโลยีวิศวกรรมอิเล็กทรอนิกส์","03"),
("0306","เทคโนโลยีวิศวกรรมโยธาและสิ่งแวดล้อม","03"),
("0307","เทคโนโลยีวิศวกรรมอุตสาหการ","03"),
("0308","การจัดการเทคโนโลยีการผลิตและสารสนเทศ","03"),
("0309","วิทยาศาสตร์ประยุกต์และสังคม","03"),
("0310","โรงเรียนเตรียมวิศวกรรมศาสตร์ ไทย - เยอรมัน","03"),

("0400","นวัตกรรมและเทคโนโลยีความมั่นคง","04"),
("0401","เคมีอุตสาหกรรม","04"),
("0402","คณิตศาสตร์","04"),
("0403","ฟิสิกส์อุตสาหกรรมและอุปกรณ์การแพทย์","04"),
("0404","เทคโนโลยีอุตสาหกรรมเกษตร อาหาร และสิ่งแวดล้อม","04"),
("0405","สถิติประยุกต์","04"),
("0406","วิทยาการคอมพิวเตอร์และสารสนเทศ","04"),
("0407","เทคโนโลยีชีวภาพ","04"),

("0501","เทคโนโลยีอุตสาหกรรมเกษตรและการจัดการ","05"),
("0502","พัฒนาผลิตภัณฑ์อุตสาหกรรมเกษตร","05"),
("0503","นวัตกรรมและเทคโนโลยีการพัฒนาผลิตภัณฑ์","05"),

("0601","การจัดการอุตสาหกรรม","06"),
("0602","เทคโนโลยีสารสนเทศ","06"),
("0603","การออกแบบและบริหารงานก่อสร้าง","06"),
("0604","วิศวกรรมเกษตรเพื่ออุตสาหกรรม","06"),
("0605","การจัดการอุตสาหกรรมการท่องเที่ยว","06"),

("0701","เทคโนโลยีสารสนเทศ","07"),
("0702","การจัดการเทคโนโลยีสารสนเทศ","07"),
("0703","การบริหารเครือข่ายดิจิทัลและความมั่นคงปลอดภัยสารสนเทศ","07"),

("0801","ภาษา","08"),
("0802","สังคมศาสตร์","08"),
("0803","มนุษยศาสตร์","08"),

("0901","วิศวกรรมเครื่องกลการจำลองและการออกแบบ (นานาชาติ)","09"),
("0902","วิศวกรรมไฟฟ้ากำลังและพลังงาน (นานาชาติ)","09"),
("0903","วิศวกรรมการผลิต (นานาชาติ)","09"),
("0904","วิศวกรรมโทรคมนาคม (นานาชาติ)","09"),
("0905","วิศวกรรมยานยนต์ (นานาชาติ)","09"),
("0906","วิศวกรรมเคมีและกระบวนการ (นานาชาติ)","09"),
("0907","วิศวกรรมระบบซอฟต์แวร์ (นานาชาติ)","09"),
("0908","วิศวกรรมวัสดุและโลหะการ (นานาชาติ)","09"),
("0909","วิศวกรรมเครื่องกลและกระบวนการ","09"),
("0910","วิศวกรรมไฟฟ้าและระบบซอฟต์แวร์","09"),

("0999","ร่วมคณะ","10"),
("1099","- ไม่ระบุ-","10"),

("1100","ช่างทองหลวง","11"),
("1101","เทคโนโลยีศิลปอุตสาหกรรม","11"),
("1102","สถาปัตยกรรม","11"),
("1103","การจัดการงานออกแบบและพัฒนาธุรกิจ","11"),

("1201","เทคโนโลยีวิศวกรรมกระบวนการเคมี","12"),
("1202","เทคโนโลยีวิศวกรรมการวัดคุมและอัตโนมัติ","12"),
("1203","เทคโนโลยีวิศวกรรมวัสดุและกระบวนการผลิต","12"),
("1204","เทคโนโลยีวิศวกรรมอุตสาหการและโลจิสติกส์","12"),
("1205","เทคโนโลยีวิศวกรรมเครื่องกลและยานยนต์","12"),
("1206","เทคโนโลยียานยนต์สมัยใหม่และระบบอัตโนมัติ","12"),

("1301","กระบวนการอุตสาหกรรมเคมีและสิ่งแวดล้อม","13"),
("1302","เทคโนโลยีพลังงานและการจัดการ","13"),
("1303","วิทยาการข้อมูลและการคำนวณเชิงธุรกิจและอุตสาหกรรม","13"),
("1304","เทคโนโลยีดิจิทัลและธุรกิจอัจฉริยะ","13"),
("1399","-","13"),

("1401","บริหารธุรกิจอุตสาหกรรม","14"),
("1402","คอมพิวเตอร์ธุรกิจ","14"),
("1403","การบัญชี","14"),
("1404","การตลาดดิจิทัล","14"),

("1501","บริหารธุรกิจ","15"),

("1601","การพัฒนาธุรกิจอุตสาหกรรมและทรัพยากรมนุษย์","16"),
("1602","การบริหารอุตสาหกรรมการผลิตและบริการ","16"),

("1701","บริหารธุรกิจท่องเที่ยวและโรงแรม","17"),
("1702","บริหารธุรกิจอุตสาหกรรมและการค้า","17"),

("1801","เทคโนโลยียานยนต์สมัยใหม่และระบบอัตโนมัติ","18");

INSERT INTO Education_Level_Category (ed_desc)
VALUES 
('ปวช.'),
('ป.ตรี'),
('ป.โท');

INSERT INTO Education (std_ID, national_id, Faculty_id, Department_id) 
VALUES
('6501010001','1000000000001', '01', '0100'),
('6501010002','1000000000002', '01', '0100'),
('6501010003','1000000000003', '01', '0101'),
('6501020001','1000000000004', '01', '0101'),
('6501020002','1000000000005', '01', '0100'),
('6501020003','1000000000006', '01', '0101'),
('6502010001','1000000000007', '02', '0201'),
('6502010002','1000000000008', '02', '0201'),
('6502020001','1000000000009', '02', '0202'),
('6502020002','1000000000010', '02', '0202'),
('6503010001','1000000000011', '03', '0301'),
('6503010002','1000000000012', '03', '0301'),
('6503010003','1000000000013', '03', '0301'),
('6503020001','1000000000014', '03', '0302'),
('6503020002','1000000000015', '03', '0302'),
('6503020003','1000000000016', '03', '0302'),
('6504010001','1000000000017', '04', '0401'),
('6504010002','1000000000018', '04', '0401'),
('6504020001','1000000000019', '04', '0402'),
('6504020002','1000000000020', '04', '0402');

INSERT INTO Post_Duration (Duration_id, Start_date, End_date, Checklist, Reservation, Event_status)
VALUES 
('C1', '2024-10-07 10:00:00', '2024-10-31 23:59:00', 1, 0, 1),
('R_OLD1', '2024-10-17 10:00:00', '2024-10-21 23:59:00', 0, 1, 1),
('R_NEW1','2024-10-22 10:00:00','2024-10-31 23:59:00',0,1,1);

INSERT INTO Checklist (national_id, scholarship_id, cost_of_living_id,duration_id) 
VALUES
('1000000000001', '1', 1,'C1'),
('1000000000002', '2', 1,'C1'),
('1000000000003', '3', 1,'C1'),
('1000000000004', '4', 1,'C1'),
('1000000000005', '5', 1,'C1'),
('1000000000006', '6', 1,'C1'),
('1000000000007', '1', 1,'C1'),
('1000000000008', '2', 1,'C1'),
('1000000000009', '3', 1,'C1'),
('1000000000010', '4', 1,'C1'),
('1000000000011', '5', 1,'C1'),
('1000000000012', '6', 1,'C1'),
('1000000000013', '1', 1,'C1'),
('1000000000014', '2', 1,'C1'),
('1000000000015', '3', 1,'C1'),
('1000000000016', '4', 1,'C1'),
('1000000000017', '5', 1,'C1'),
('1000000000018', '6', 1,'C1'),
('1000000000019', '1', 1,'C1'),
('1000000000020', '2', 1,'C1');


INSERT INTO Reservation (reserve_date, reserve_time, queue_no, checklist_id, national_id, duration_id)
VALUES
('2024-10-17', '09:00:00', 1, 1, '1000000000001', 'R_OLD1'),
('2024-10-17', '13:00:00', 2, 2, '1000000000002', 'R_OLD1'),
('2024-10-18', '09:00:00', 3, 3, '1000000000003', 'R_OLD1'),
('2024-10-18', '13:00:00', 4, 4, '1000000000004', 'R_OLD1'),
('2024-10-19', '09:00:00', 5, 5, '1000000000005', 'R_OLD1'),
('2024-10-19', '13:00:00', 6, 6, '1000000000006', 'R_OLD1'),
('2024-10-20', '09:00:00', 7, 7, '1000000000007', 'R_OLD1'),
('2024-10-20', '13:00:00', 8, 8, '1000000000008', 'R_OLD1'),
('2024-10-21', '09:00:00', 9, 9, '1000000000009', 'R_OLD1'),
('2024-10-21', '13:00:00', 10, 10, '1000000000010', 'R_OLD1'),
('2024-10-22', '09:00:00', 11, 11, '1000000000011', 'R_NEW1'),
('2024-10-22', '13:00:00', 12, 12, '1000000000012', 'R_NEW1'),
('2024-10-23', '09:00:00', 13, 13, '1000000000013', 'R_NEW1'),
('2024-10-23', '13:00:00', 14, 14, '1000000000014', 'R_NEW1'),
('2024-10-24', '09:00:00', 15, 15, '1000000000015', 'R_NEW1'),
('2024-10-24', '13:00:00', 16, 16, '1000000000016', 'R_NEW1'),
('2024-10-25', '09:00:00', 17, 17, '1000000000017', 'R_NEW1'),
('2024-10-25', '13:00:00', 18, 18, '1000000000018', 'R_NEW1'),
('2024-10-26', '09:00:00', 19, 19, '1000000000019', 'R_NEW1'),
('2024-10-26', '13:00:00', 20, 20, '1000000000020', 'R_NEW1');

