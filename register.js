const facultyByYear = {
    'vc': ['วิทยาลัยเทคโนโลยีอุตสาหกรรม'],
    'b': ['วิศวกรรมศาสตร์', 'ครุศาสตร์อุตสาหกรรม', 'วิทยาลัยเทคโนโลยีอุตสาหกรรม', 'วิทยาศาสตร์ประยุกต์', 'สถาปัตยกรรมและการออกแบบ', 'วิทยาลัยนานาชาติ', 'พัฒนาธุรกิจและอุตสาหกรรม', 'เทคโนโลยีสารสนเทศ'],
    'm': ['วิทยาศาสตร์ประยุกต์', 'วิศวกรรมศาสตร์', 'วิทยาลัยเทคโนโลยีอุตสาหกรรม', 'เทคโนโลยีสารสนเทศ']
};

const majorByFacultyAndYear = {
    'b': {
        'วิศวกรรมศาสตร์': ['วิศวกรรมการผลิต','วิศวกรรมขนถ่ายวัสดุ','วิศวกรรมคอมพิวเตอร์','วิศวกรรมวัสดุ','วิศวกรรมวัสดุเชิงนวัตกรรม','วิศวกรรมหุ่นยนต์และระบบอัตโนมัติ','วิศวกรรมอุตสาหการ','วิศวกรรมเครื่องกล','วิศวกรรมเครื่องมือวัดและอัตโนมัติ','วิศวกรรมโลจิสติกส์','วิศวกรรมไฟฟ้า'],
        'ครุศาสตร์อุตสาหกรรม': ['วิศวกรรมไฟฟ้า','เทคโนโลยีคอมพิวเตอร์','วิศวกรรมการผลิตและอุตสาหการ','วิศวกรรมแมคคาทรอนิกส์และหุ่นยนต์','วิศวกรรมโยธาและการศึกษา','วิศวกรรมไฟฟ้าและการศึกษา','วิชาวิศวกรรมเครื่องกล'],
        'วิทยาลัยเทคโนโลยีอุตสาหกรรม': ['เทคโนโลยีการเชื่อม','เทคโนโลยีวิศวกรรมการทําความเย็นและการปรับอากาศ','เทคโนโลยีวิศวกรรมการออกแบบและผลิตเครื่องจักรกล','เทคโนโลยีวิศวกรรมซ่อมบำรุงอากาศยาน','เทคโนโลยีวิศวกรรมพอลิเมอร์และอุตสาหกรรมยาง','เทคโนโลยีวิศวกรรมอุตสาหการ','เทคโนโลยีวิศวกรรมแมคคาทรอนิกส์','เทคโนโลยีวิศวกรรมแม่พิมพ์และเครื่องมือ','เทคโนโลยีวิศวกรรมไฟฟ้าและอิเล็กทรอนิกส์กำลัง'],
        'วิทยาศาสตร์ประยุกต์': ['คณิตศาสตร์ประยุกต์','คณิตศาสตร์เชิงวิทยาการคอมพิวเตอร์','นวัตกรรมและเทคโนโลยีความมั่นคง','ฟิสิกส์อุตสาหกรรมและอุปกรณ์การแพทย','วิทยาการคอมพิวเตอร์','วิทยาศาสตร์และเทคโนโลยีทางอาหาร','วิทยาศาสตร์และเทคโนโลยีสิ่งแวดล้อม','วิศวกรรมชีวการแพทย','สถิติธุรกิจและการประกันภัย','สถิติประยุกต์','เคมีอุตสาหกรรม','เทคโนโลยีชีวภาพ','เทคโนโลยีอุตสาหกรรมเกษตร','เทคโนโลยีอุตสาหกรรมเกษตรและนวัตกรรม'],
        'สถาปัตยกรรมและการออกแบบ': ['สถาปัตยกรรม','การจัดการงานออกแบบภายในและพัฒนาธุรกิจ','ออกแบบผลิตภัณฑ์นวัตกรรมเซรามิกส์','ศิลปประยุกต์และออกแบบผลิตภัณฑ์'],
        'วิทยาลัยนานาชาติ': ['การค้าระหว่างประเทศและธุรกิจโลจิสติกส์'],
        'พัฒนาธุรกิจและอุตสาหกรรม': ['การบริหารอุตสาหกรรมการผลิตและบริการ','การพัฒนาธุรกิจอุตสาหกรรมและทรัพยากรมนุษย','การบริหารอุตสาหกรรมการผลิตและบริการ'],
        'เทคโนโลยีสารสนเทศ': ['วิทยาการสารสนเทศเพื่อเศรษฐกิจดิจิทัล']
    },
    'm': {
        'วิศวกรรมศาสตร์': ['วิศวกรรมการจัดการอุตสาหกรรม','วิศวกรรมอุตสาหการ','วิศวกรรมการบินและอวกาศ','วิศวกรรมเครื่องกล','วิศวกรรมไฟฟ้า'],
        'วิทยาศาสตร์ประยุกต์': ['อุปกรณ์การแพทย์', 'วิทยาการคอมพิวเตอร์'],
        'วิทยาลัยเทคโนโลยีอุตสาหกรรม': ['การบริหารงานก่อสร้าง','เทคโนโลยีวิศวกรรมยานยนต์และพลังงาน','เทคโนโลยีวิศวกรรมการก่อสร้าง','เทคโนโลยีวิศวกรรมเครื่องกล'],
        'เทคโนโลยีสารสนเทศ': ['สารสนเทศและวิทยาศาสตร์ข้อมูล']
    }
};

function updateFaculty() {
    const year = document.getElementById('user_year').value;
    const facultySelect = document.getElementById('faculty');
    facultySelect.innerHTML = '<option value="">เลือกคณะ</option>';

    if (year && facultyByYear[year]) {
        facultyByYear[year].forEach(faculty => {
            const option = document.createElement('option');
            option.value = faculty;
            option.textContent = faculty;
            facultySelect.appendChild(option);
        });
    }

    updateMajor();
}

function updateMajor() {
    const year = document.getElementById('user_year').value;
    const faculty = document.getElementById('faculty').value;
    const majorSelect = document.getElementById('major');
    majorSelect.innerHTML = '<option value="">เลือกสาขา</option>';

    if (year && faculty && majorByFacultyAndYear[year] && majorByFacultyAndYear[year][faculty]) {
        majorByFacultyAndYear[year][faculty].forEach(major => {
            const option = document.createElement('option');
            option.value = major;
            option.textContent = major;
            majorSelect.appendChild(option);
        });
    }
}

function showSection() {
    document.getElementById("father-info").style.display = "none";
    document.getElementById("mother-info").style.display = "none";
    document.getElementById("guardian-info").style.display = "none";
    document.getElementById("father-income-info").style.display = "none";
    document.getElementById("mother-income-info").style.display = "none";
    document.getElementById("guardian-income-info").style.display = "none";

    var selectedValue = document.getElementById("pattern_status").value;
    
    if (selectedValue === "father") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
    } else if (selectedValue === "mother") {
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
    } else if (selectedValue === "guardian") {
        document.getElementById("guardian-info").style.display = "block";
        document.getElementById("guardian-income-info").style.display = "block";
    } else if (selectedValue === "both") {
        document.getElementById("father-info").style.display = "block";
        document.getElementById("father-income-info").style.display = "block";
        document.getElementById("mother-info").style.display = "block";
        document.getElementById("mother-income-info").style.display = "block";
    }
}
