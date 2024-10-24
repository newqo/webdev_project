<?php
require_once('PDF/tcpdf.php');

class PDF extends TCPDF
{
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
        $this->Cell(0, 5, 'วันที่...เดือน.....ปี..... เวลา ......น. ลำดับที่ ....', 0, 1, 'C');

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
        $this->Cell(0, 8, 'นักศึกษากู้ใหม่/เก่า ', 0, 1,'R');

        // Section 1: General Information
        $this->SetFont('FreeSerif', '', 12);

        $this->Cell(0, 10, 'วัน/เดือน/ปีเกิด: __ (อายุ: __)', 0, 0);
        $this->Cell(0,10,'เลขบัตรประชาชน',0,1,'R');


        $this->Cell(70, 7, 'ชื่อ-นามสกุล ', 1, 0);
        $this->Cell(40,7,'รหัสนักศึกษา ',1,0);
        $this->Cell(30,7,'ระดับ ',1,0);
        $this->Cell(50,7,'กลุ่ม ',1,1,'C');
        
        $this->Cell(70,7,'วิทยาเขต',1,0);
        $this->Cell(70,7,'เบอร์โทร ',1,0);
        $this->Cell(50,7,'ทุน : ',1,1);

        $this->Cell(70,7,'คณะ',1,0);
        $this->Cell(70,7,'Email',1,0);
        $this->Cell(50,7,'ล็อค/ไม่ล็อค',1,1);
        
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
        for ($i = 1; $i <= 14; $i++) {
            $this->Cell(10, 7, $i, 1, 0, 'C'); // Row number
            $this->Cell(130, 7, '__', 1, 0); // Document placeholder
            $this->Cell(15,7,'',1,0,'C');
            $this->Cell(35,7,'',1,1);
        }

        $this->Ln(5);

        $this->SetFont('FreeSerif', '', 10);
        $this->Cell(0,7,'ข้าพเจ้า (ชื่อ-นามสกุล) ได้ตรวจสอบเอกสารแล้ว รับทราบข้อมูล/ยื่นเอกสาร หากสถานศึกษาตรวจสอบแล้วพบว่าไม่ครบถ้วนและหรือ',0,1,'R');
        $this->Cell(0,7,'ไม่เป็นไปตามหลักเกณฑ์ที่กองทุนฯกำหนด ยินดีให้ยกเลิกการกู้ยืมฯ ในทุกกรณีโดยไม่มีข้อโต้แย้ง จึงลงชื่อไว้เป็นหลักฐาน',0,1);

        $this->Ln(5);

        $this->SetFont('FreeSerif', '', 12);
        $this->Cell(140, 7,'', 0, 0);
        $this->Cell(50,7,'ลงชื่อ...........................................',0,1,'C');

        $this->SetFont('FreeSerif', '', 10);
        $this->Cell(140, 7,'', 0, 0);
        $this->Cell(50,7,'(ชื่อ-นามสกุล)',0,1,'C');
        $this->Cell(140, 7,'', 0, 0);
        $this->Cell(50,7,'วันเวลาที่บันทึกข้อมูล',0,1,'C');
        

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
    "1 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา.........................
2 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา.........................
3 ผู้ตรวจ................................. วันที่................................. นัดมายื่นอีกครั้งในวันที่.......................... เวลา........................."
    , 0, 'C', false, 1);

    }
}

// Create PDF
$pdf = new PDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Check List Kmutnb');
$pdf->SetSubject('Check List');
$pdf->SetKeywords('TCPDF, PDF, form, checklist');

// Set default font
$pdf->SetFont('FreeSerif', '', 12);
$pdf->CreateForm();
$pdf->Output('checklist.pdf', 'I');
?>
