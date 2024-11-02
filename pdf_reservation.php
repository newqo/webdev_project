<?php
require_once('PDF/tcpdf.php');

include "connect.php";

class PDF extends TCPDF
{
    //constructor
    private $pdo; 
    public $data;
    public $months = array(
        1 => 'มกราคม',  
        2 => 'กุมภาพันธ์', 
        3 => 'มีนาคม',   
        4 => 'เมษายน',     
        5 => 'พฤษภาคม',  
        6 => 'มิถุนายน',   
        7 => 'กรกฎาคม',   
        8 => 'สิงหาคม',   
        9 => 'กันยายน',   
        10 => 'ตุลาคม',
        11 => 'พฤศจิกายน',
        12 => 'ธันวาคม'
    );

    public $label_document = array(
        1 => 'แบบยืนยันการเบิกเงินกู้ยืม จากระบบ DSL',
        2 => 'สัญญากู้ยืมเงินกองทุน กยศ. จากระบบ DSL',
        3 => 'สำเนาบัตรประชาชนผู้กู้ยืม',
        4 => 'เอกสารแสดงผลการลงทะเบียน 1/2567',
        5 => 'เอกสารแสดงค่าใช้จ่าย/ทุน 1/2567',
        6 => 'สำเนาใบเสร็จรับเงินค่าเทอม 1/2567',
        7 => 'บันทึกกิจกรรมจิตอาสาไม่น้อยกว่า 36 ชั่วโมง',
        8 => 'หนังสือยินยอมเปิดเผยข้อมูล'
    );

    public $amount_document = array(
        1 => '2 แผ่น',
        2 => '2 ชุด',
        3 => '2 แผ่น',
        4 => '1 ชุด',
        5 => '1 แผ่น',
        6 => '1 แผ่น',
        7 => '1 แผ่น',
        8 => '1 ชุด'
    );

    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchUserData($nid, $duration_id)
    {
        $stmt = $this->pdo->prepare("SELECT Users.national_id AS 'nid', Users.firstname AS 'firstname', Users.lastname AS 'lastname', 
                                            DATE_FORMAT(Users.birthdate,'%d/%m/%Y') AS 'birthdate', Users.phone_num AS 'phone_num', Users.Email AS 'email', 
                                            User_category.category_desc AS 'user_category', Education.std_ID AS 'std_id', 
                                            Education_Level_Category.ed_desc AS 'ed_level' , Faculty.Faculty_name AS 'faculty',
                                            Scholarship.scholarship_name AS 'scholarship',
                                            DATE_FORMAT(Reservation.reserve_date,'%e') AS 'Reserv_date' ,
                                            MONTH(Reservation.reserve_date) AS 'Reserv_month' ,
                                            YEAR(Reservation.reserve_date) AS 'Reserv_year',
                                            TIME_FORMAT(Reservation.reserve_time,'%H:%s') AS 'Reserv_time' ,
                                            Reservation.queue_no AS 'queue_no'
                            FROM Users 
                            JOIN Education ON Education.national_id = Users.national_id 
                            JOIN Faculty ON Faculty.Faculty_id = Education.Faculty_id 
                            JOIN Education_Level_Category ON Education_Level_Category.ed_category_id = Education.Education_Level 
                            JOIN User_category ON Users.user_cate_id = User_category.user_cate_id 
                            JOIN Checklist ON Checklist.national_id = Users.national_id 
                            JOIN Scholarship ON Checklist.scholarship_id = Scholarship.scholarship_id
                            JOIN Reservation ON Checklist.checklist_id = Reservation.checklist_id
                            WHERE Users.national_id = ? AND Reservation.duration_id = ?;");
        $stmt->bindParam(1, $nid);
        $stmt->bindParam(2, $duration_id);
        $stmt->execute();
        $this->data = $stmt->fetch();
    }

    // Header
    public function Header()
    {
        $this->Ln(8);
        $this->SetFillColor(50, 157, 156);
        $this->Rect(0, 0, 210, 30, 'F');
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('FreeSerif', 'B', 18);
        $this->Cell(0, 8, 'Check list 1/2567', 0, 1, 'C');
        $this->Ln(8);
    }
    public function Header2()
    {
        $this->Ln(8);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('FreeSerif', '', 12);
        $this->Cell(0, 8, 'รายการเอกสารขอกู้ยืม', 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        $this->Ln(5);
    }
    public function Footer()
    {
        $this->SetY(-25); // ตั้งตำแหน่ง Y ของ footer
        $this->SetFont('FreeSerif', '', 10);
        $this->Cell(0, 5, 'เวลาส่งเอกสารของท่านคือ', 0, 1, 'C');

        $this->SetFont('FreeSerif', 'B', 10);
        $this->SetTextColor(255, 0, 0);
        $this->Cell(0, 5, 'วันที่ ' .$this->data['Reserv_date'] . " " . $this->months[$this->data['Reserv_month']] . " พ.ศ. " . ($this->data['Reserv_year'] + 543) . " เวลา " . $this->data['Reserv_time'] . " น. ลำดับที่ " . $this->data['queue_no'] , 0, 1, 'C');

        $this->SetFont('FreeSerif', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 5, 'ส่งเอกสารที่ กลุ่มงานสวัสดิการนักศึกษา กองกิจการนักศึกษา ชั้น 4 อาคาร 40 ปี มจพ.', 0, 0, 'C');
    }

    // Create Form
    public function CreateForm()
    {
        $this->AddPage();

        $this->Header2();

        $this->SetFont('FreeSerif', 'B', 12);
        $this->Cell(0, 8, $this->data['user_category'], 0, 1,'R');

        // Section 1: General Information
        $this->SetFont('FreeSerif', '', 10);

        $this->Cell(0, 10, 'วัน/เดือน/ปีเกิด : ' . $this->data['birthdate'], 0, 0);
        $this->Cell(0,10,'เลขบัตรประชาชน : ' .$this->data['nid'],0,1,'R');


        $this->Cell(70, 7, 'ชื่อ-นามสกุล : ' . $this->data['firstname'] . " " . $this->data['lastname'], 1, 0);
        $this->Cell(50,7,'รหัสนักศึกษา : ' . $this->data['nid'],1,0);
        $this->Cell(20,7,'ระดับ : ' . $this->data['ed_level'],1,0);
        $this->Cell(50,7,'กลุ่ม ' . $this->data['user_category'],1,1,'C');
        
        $this->Cell(70,7,'วิทยาเขต : กรุงเทพ',1,0);
        $this->Cell(70,7,'เบอร์โทร : ' . $this->data['phone_num'],1,0);
        $this->setFillColor(255,255,255);
        $this->MultiCell(50,14,'ทุน : ' . $this->data['scholarship'],1,1,'C',1);

        $this->SetXY(10, 63);
        $this->Cell(70,7,$this->data['faculty'],1,0);
        $this->Cell(70,7,'Email : ' . $this->data['email'],1,1);
        
        $this->Ln(2);
        
        // Table header
        $this->SetFillColor(239, 251, 240);
        $this->SetFont('FreeSerif', 'B', 12);

        $this->Cell(10, 7, 'ที่', 1, 0, 'C', 1);
        $this->Cell(130, 7, 'รายการเอกสาร', 1, 0, 'C', 1);
        $this->Cell(15, 7, 'จำนวน', 1, 0, 'C', 1);
        $this->Cell(35, 7, 'เจ้าหน้าที่', 1, 1, 'C', 1);


        // Table content
        $this->SetFont('FreeSerif', '', 10);
        for ($i = 1; $i <= 8; $i++) {
            $this->Cell(10, 10, $i, 1, 0, 'C'); // Row number
            $this->Cell(130, 10, $this->label_document[$i], 1, 0); // Document placeholder
            $this->Cell(15,10,$this->amount_document[$i],1,0,'C');
            $this->Cell(35,10,'',1,1);
        }
        $this->Cell(10,10,'',1,0);
        $this->Cell(130,10,'',1,0);
        $this->Cell(15,10,'',1,0);
        $this->Cell(35,10,'',1,1);

        $this->Cell(10,10,'',1,0);
        $this->Cell(130,10,'',1,0);
        $this->Cell(15,10,'',1,0);
        $this->Cell(35,10,'',1,1);

        
        $this->Ln(5);

        $this->SetFont('FreeSerif', '', 10);
        $this->Cell(0,7,'ข้าพเจ้า '. $this->data['firstname'] . " " . $this->data['lastname'] .' ได้ตรวจสอบเอกสารแล้ว รับทราบข้อมูล/ยื่นเอกสาร หากสถานศึกษาตรวจสอบแล้วพบว่าไม่ครบถ้วนและหรือ',0,1,'R');
        $this->Cell(0,7,'ไม่เป็นไปตามหลักเกณฑ์ที่กองทุนฯกำหนด ยินดีให้ยกเลิกการกู้ยืมฯ ในทุกกรณีโดยไม่มีข้อโต้แย้ง จึงลงชื่อไว้เป็นหลักฐาน',0,1);

        $this->Ln(5);

        $this->SetFont('FreeSerif', '', 12);
        $this->Cell(140, 7,'', 0, 0);
        $this->Cell(50,7,'ลงชื่อ...........................................',0,1,'C');

        $this->SetFont('FreeSerif', '', 10);
        $this->Cell(140, 7,'', 0, 0);
        $this->Cell(50,7,'('. $this->data['firstname'] . " " . $this->data['lastname'] .')',0,1,'C');
        $this->Cell(140, 7,'', 0, 1);
        

        $this->SetFont('FreeSerif', 'B', 12);

        $this->Rect(10, 225, 190, 45, 'D'); // (x, y, width, height, style)

        $this->Ln(5);
        $this->Cell(0, 7, 'สำหรับเจ้าหน้าที่ตรวจเอกสาร', 0, 1, 'C');
        $this->Cell(0, 8, 'ตรวจเอกสารแล้ว', 0, 1);

        $this->SetFont('FreeSerif', '', 11);
        $this->Cell(5, 5, '', 0, 0, 'C');
        $this->Cell(5, 5, '', 1, 0, 'C');
        $this->Cell(30, 8, 'ถูกต้อง/ครบถ้วน', 0, 0);

        $this->Cell(5, 5, '', 1, 0, 'C');
        $this->Cell(0, 8, 'ส่งคืนแล้วให้แก้ไข..................................................................................................................', 0, 1);  //



        $this->SetFont('FreeSerif', '', 11);
        $this->MultiCell(0, 10, 
            "        1 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา.........................
        2 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา.........................
        3 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา........................."
            , 0, 'C', false, 1);

    }
}

$nid = $_GET['nid'];
$duration_id = $_GET['duration_id'];

// Create PDF
$pdf = new PDF();
$pdf->setPdo($pdo);
$pdf->fetchUserData($nid, $duration_id);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Check List Kmutnb');
$pdf->SetSubject('Check List');
$pdf->SetKeywords('TCPDF, PDF, form, checklist');

// Set default font
$pdf->SetFont('FreeSerif', '', 12);
// $pdf->fetchUserData($nid, $duration_id);
$pdf->CreateForm();
$pdf->Output('checklist.pdf', 'I');
?>
