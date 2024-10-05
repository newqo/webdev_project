-- test query
SELECT Parent.* , Users.firstname , Users.lastname 
FROM Parent 
JOIN User_Relationship ON User_Relationship.parent_id = Parent.parent_id 
JOIN Users ON Users.national_id = User_Relationship.national_id;

-- q1 Admin อยากรู้ว่าเดือน 10 มีผู้กู้รายใหม่กี่คน
SELECT SUM(Users.user_cate_id=1) AS "ผู้กู้รายเก่า" FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = "10";

-- q1.1 Admin อยากรู้ว่าเดือน 10 มีผู้กู้รายใหม่เป็นใครบ้าง วันและเวลาไหนบ้าง
SELECT Users.national_id, Users.firstname, Users.lastname, Reservation.reserve_date, Reservation.reserve_time 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = "10" 
AND Users.user_cate_id = 0;

-- q2 Admin อยากรู้ว่าเดือน 10 มีผู้กู้รายเก่ากี่คน
SELECT SUM(Users.user_cate_id=0) AS "ผู้กู้รายใหม่" 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = "10";

-- q2.1 Admin อยากรู้ว่าเดือน 10 มีผู้กู้รายเก่าเป็นใครบ้าง วันและเวลาไหนบ้าง
SELECT Users.national_id, Users.firstname, Users.lastname, Reservation.reserve_date, Reservation.reserve_time 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
WHERE MONTH(Reservation.reserve_date) = "10" AND Users.user_cate_id = 1;

-- q3 ยอดรวมการจองผู้กู้ในแต่ละเดือน
SELECT MONTH(Reservation.reserve_date) AS "เดือน" ,SUM(Users.user_cate_id=0)AS "ผู้กู้รายใหม่" , SUM(Users.user_cate_id=1) AS "ผู้กู้รายเก่า" 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
GROUP BY MONTH(Reservation.reserve_date);

-- q4 สถานภาพครอบครัวของนักศึกษา
SELECT Users.national_id, Users.firstname, Users.lastname, Parent_status.status_description 
FROM Users 
JOIN User_Relationship ON Users.national_id = User_Relationship.national_id 
JOIN Parent ON Parent.parent_id = User_Relationship.parent_id 
JOIN Parent_status ON Parent.parent_status_id = Parent_status.parent_status_id;

-- q5 ประวัติการจอง
SELECT Users.national_id, Users.firstname , Users.lastname, Scholarship.scholarship_name AS "ชื่อทุน", Cost_of_living_status.amount AS "ค่่าครองชีพต่อเดือน", Reservation.reserve_date, Reservation.reserve_time, Reservation.queue_no 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
JOIN Checklist ON Reservation.checklist_id = Checklist.checklist_id 
JOIN Scholarship ON Checklist.scholarship_id = Scholarship.scholarship_id 
JOIN Cost_of_living_status ON Checklist.cost_of_living_id = Cost_of_living_status.cost_of_living_id
ORDER BY 
Reservation.reserve_date DESC,
Reservation.reserve_time DESC;

-- q6 จำนวนผู้กู้ของแต่ละคณะ,สาขา
SELECT Faculty.Faculty_name, Department.Department_name , COUNT(Reservation.reservation_id) AS "จำนวนผู้กู้" 
FROM Reservation 
JOIN Users ON Reservation.national_id = Users.national_id 
JOIN Education ON Users.national_id = Education.national_id 
JOIN Faculty ON Education.Faculty_id = Faculty.Faculty_id 
JOIN Department ON Education.Department_id = Department.Department_id 
GROUP BY Department.Department_name
ORDER BY Faculty.Faculty_name ASC;

-- Optional รายได้ครอบครัวต่อปีของแต่ละคน
SELECT Users.national_id, Users.firstname, Users.lastname, SUM(Parent.income)*12 AS "รายได้ครอบครัวต่อปี" 
FROM Users 
JOIN User_Relationship ON Users.national_id = User_Relationship.national_id 
JOIN Parent ON Parent.parent_id = User_Relationship.parent_id 
GROUP BY Users.national_id;