<?php
    include "connect.php";

    $nid = $_POST['nid'];
    $status = $_POST['parent_status_name'];

    if($status != 2){
        $stmt = $pdo->prepare("UPDATE Parent 
                                    SET Pre_name_id = ? , firstname = ? , lastname = ?, phone_num = ?, career = ?, income = ?, income_cate_id = ?
                                    WHERE parent_id = ?");
        if($status == 0){ //father
            $stmt->bindParam(1,$_POST["father_pre_name"]); // pre name
            $stmt->bindParam(2,$_POST["father_fst_name"]); // first name
            $stmt->bindParam(3,$_POST["father_lst_name"]); // last name
            $stmt->bindParam(4,$_POST["father_phone_num"]); // phone num
            $stmt->bindParam(5,$_POST["father_career"]); // career
            $father_income = (int)$_POST["father_annual_income"];
            $stmt->bindParam(6,$father_income); // income
            $stmt->bindParam(7,$_POST["father_income_type"]); // income category
            $stmt->bindParam(8,$_POST["father_parent_id"]); // parent_id

        }
        else if ($status == 1){ //mother
            $stmt->bindParam(1,$_POST["mother_pre_name"]); // pre name
            $stmt->bindParam(2,$_POST["mother_fst_name"]); // first name
            $stmt->bindParam(3,$_POST["mother_lst_name"]); // last name
            $stmt->bindParam(4,$_POST["mother_phone_num"]); // phone num
            $stmt->bindParam(5,$_POST["mother_career"]); // career
            $mother_income = (int)$_POST["mother_annual_income"];
            $stmt->bindParam(6,$mother_income); // income
            $stmt->bindParam(7,$_POST["mother_income_type"]); // income category
            $stmt->bindParam(8,$_POST["mother_parent_id"]); // parent_id
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
            $stmt->bindParam(8,$_POST["guardian_parent_id"]); // parent_id
        }
        $stmt->execute();

    }else{ // father and mother
        //father
        $stmt = $pdo->prepare("UPDATE Parent 
                                    SET Pre_name_id = ? , firstname = ? , lastname = ?, phone_num = ?, career = ?, income = ?, income_cate_id = ?
                                    WHERE parent_id = ?");
        $stmt->bindParam(1,$_POST["father_pre_name"]); // pre name
        $stmt->bindParam(2,$_POST["father_fst_name"]); // first name
        $stmt->bindParam(3,$_POST["father_lst_name"]); // last name
        $stmt->bindParam(4,$_POST["father_phone_num"]); // phone num
        $stmt->bindParam(5,$_POST["father_career"]); // career
        $father_income = (int)$_POST["father_annual_income"];
        $stmt->bindParam(6,$father_income); // income
        $stmt->bindParam(7,$_POST["father_income_type"]); // income category
        $stmt->bindParam(8,$_POST["father_parent_id"]); // parent_id
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE Parent 
                                    SET Pre_name_id = ? , firstname = ? , lastname = ?, phone_num = ?, career = ?, income = ?, income_cate_id = ?
                                    WHERE parent_id = ?");
        $stmt->bindParam(1,$_POST["mother_pre_name"]); // pre name
        $stmt->bindParam(2,$_POST["mother_fst_name"]); // first name
        $stmt->bindParam(3,$_POST["mother_lst_name"]); // last name
        $stmt->bindParam(4,$_POST["mother_phone_num"]); // phone num
        $stmt->bindParam(5,$_POST["mother_career"]); // career
        $mother_income = (int)$_POST["mother_annual_income"];
        $stmt->bindParam(6,$mother_income); // income
        $stmt->bindParam(7,$_POST["mother_income_type"]); // income category
        $stmt->bindParam(8,$_POST["mother_parent_id"]); // parent_id
        $stmt->execute();
    }

    header("location: edit_success_account.php");
?>