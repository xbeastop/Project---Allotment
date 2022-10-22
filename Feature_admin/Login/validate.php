<?php
include_once "../../Core/Data/Repository/collegePortalRepository.php";
if($admin = CollegePortalRepository::getInstance()->loginAdmin($_POST)){
    session_start();
    $_SESSION['adminId'] = $admin[0]['id'];
    $_SESSION['name'] = $admin[0]['name'];
    header("location: http://allotment/Feature_admin/Dashboard/index.php");
} else {
    header("location: http://allotment/index.php?error");
}
