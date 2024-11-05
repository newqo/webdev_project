<?php
include "connect.php";

function Insert_User_Relationship($pdo,$national_id,$parent_id){
    $userRelationshipStmt = $pdo->prepare("INSERT INTO User_Relationship (national_id, parent_id) VALUES (?, ?)");
    $userRelationshipStmt->bindParam(1,$national_id);
    $userRelationshipStmt->bindParam(2,$parent_id);
    $userRelationshipStmt->execute();
}

try {
    // Start a transaction
    $pdo->beginTransaction();

    // Insert Users
    $stmt = $pdo->prepare("INSERT INTO Users (national_id, Pre_name_id, firstname, lastname, Email, phone_num, birthdate, Address, user_role, user_cate_id, passwd)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?,0, 0, ?)");
    $nid = $_POST["user_id"];
    $stmt->bindParam(1, $nid); // nid
    $stmt->bindParam(2, $_POST["user_nametitle"]); // pre name_id
    $stmt->bindParam(3, $_POST["user_firstname"]); // firstname
    $stmt->bindParam(4, $_POST["user_lastname"]); // lastname
    $stmt->bindParam(5, $_POST["email"]); // Email
    $stmt->bindParam(6, $_POST["phone_number"]); // phone_num
    $stmt->bindParam(7, $_POST["birthdate"]); // birthdate

    $address = $_POST['user_address'] . " ตำบล " .$_POST['dist_name'] . " อำเภอ " . $_POST['sub_dist_name'] . " จังหวัด " . $_POST['province_name'] . " " . $_POST['postcode'];

    $stmt->bindParam(8, $address); // address
    $stmt->bindParam(9, $_POST["password"]); // password
    $stmt->execute();

    // Insert Education
    $stmt = $pdo->prepare("INSERT INTO Education (std_ID, national_id, Faculty_id, Department_id, Education_Level)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["user_stdID"]); // std id
    $stmt->bindParam(2, $_POST["user_id"]); // nid
    $stmt->bindParam(3, $_POST["faculty"]); // faculty
    $stmt->bindParam(4, $_POST["major"]); // Department
    $stmt->bindParam(5, $_POST["user_year"]); // ed level
    $stmt->execute();

    // // Insert parent
    if($_POST["pattern_status_name"] != 2){
        $stmt = $pdo->prepare("INSERT INTO Parent (Pre_name_id, firstname, lastname, phone_num, career, income, income_cate_id, parent_status_id)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if($_POST["pattern_status_name"] == 0){ //father
            $stmt->bindParam(1,$_POST["father_pre_name"]); // pre name
            $stmt->bindParam(2,$_POST["father_fst_name"]); // first name
            $stmt->bindParam(3,$_POST["father_lst_name"]); // last name
            $stmt->bindParam(4,$_POST["father_phone_num"]); // phone num
            $stmt->bindParam(5,$_POST["father_career"]); // career
            $father_income = (int)$_POST["father_annual_income"];
            $stmt->bindParam(6,$father_income); // income
            $stmt->bindParam(7,$_POST["father_income_type"]); // income category
            $stmt->bindParam(8,$_POST["pattern_status_name"]); // parent status
        }
        else if ($_POST["pattern_status_name"] == 1){ //mother
            $stmt->bindParam(1,$_POST["mother_pre_name"]); // pre name
            $stmt->bindParam(2,$_POST["mother_fst_name"]); // first name
            $stmt->bindParam(3,$_POST["mother_lst_name"]); // last name
            $stmt->bindParam(4,$_POST["mother_phone_num"]); // phone num
            $stmt->bindParam(5,$_POST["mother_career"]); // career
            $mother_income = (int)$_POST["mother_annual_income"];
            $stmt->bindParam(6,$mother_income); // income
            $stmt->bindParam(7,$_POST["mother_income_type"]); // income category
            $stmt->bindParam(8,$_POST["pattern_status_name"]); // parent status
        }
        else{ // ผปค    
            $stmt->bindParam(1,$_POST["guardian_pre_name"]); // pre name
            $stmt->bindParam(2,$_POST["guardian_fst_name"]); // first name
            $stmt->bindParam(3,$_POST["guardian_lst_name"]); // last name
            $stmt->bindParam(4,$_POST["guardian_phone_num"]); // phone num
            $stmt->bindParam(5,$_POST["guardian_career"]); // career
            $guardian_income = (int)$_POST["guardian_annual_income"];
            $stmt->bindParam(6,$guardian_income); // income
            $stmt->bindParam(7,$_POST["guardian_income_type"]); // income category
            $stmt->bindParam(8,$_POST["pattern_status_name"]); // parent status
        }
        $stmt->execute();
        $lastParentId = $pdo->lastInsertId();
        Insert_User_Relationship($pdo,$nid,$lastParentId);
        

    }else{ // father and mother
        $stmt = $pdo->prepare("INSERT INTO Parent (Pre_name_id, firstname, lastname, phone_num, career, income, income_cate_id, parent_status_id)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?),
        (?, ?, ?, ?, ?, ?, ?, ?)");

        //father
        $stmt->bindParam(1,$_POST["father_pre_name"]); // pre name
        $stmt->bindParam(2,$_POST["father_fst_name"]); // first name
        $stmt->bindParam(3,$_POST["father_lst_name"]); // last name
        $stmt->bindParam(4,$_POST["father_phone_num"]); // phone num
        $stmt->bindParam(5,$_POST["father_career"]); // career
        $father_income = (int)$_POST["father_annual_income"];
        $stmt->bindParam(6,$father_income); // income
        $stmt->bindParam(7,$_POST["father_income_type"]); // income category
        $stmt->bindParam(8,$_POST["pattern_status_name"]); // parent status

        // mother
        $stmt->bindParam(9,$_POST["mother_pre_name"]); // pre name
        $stmt->bindParam(10,$_POST["mother_fst_name"]); // first name
        $stmt->bindParam(11,$_POST["mother_lst_name"]); // last name
        $stmt->bindParam(12,$_POST["mother_phone_num"]); // phone num
        $stmt->bindParam(13,$_POST["mother_career"]); // career
        $mother_income = (int)$_POST["mother_annual_income"];
        $stmt->bindParam(14,$mother_income); // income
        $stmt->bindParam(15,$_POST["mother_income_type"]); // income category
        $stmt->bindParam(16,$_POST["pattern_status_name"]); // parent status
        
        $stmt->execute();
        $lastFatherId = $pdo->lastInsertId();
        $lastMotherId = $lastFatherId + 1;
        Insert_User_Relationship($pdo,$nid,$lastFatherId);
        Insert_User_Relationship($pdo,$nid,$lastMotherId);
    }

    // Commit transaction
    $pdo->commit();
    // print_r($_POST);
    header("Location: login.php");
} catch (PDOException $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    // print_r($_POST);
    echo "Error: " . $e->getMessage();
}