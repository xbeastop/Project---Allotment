<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";

    CollegePortalRepository::getInstance()->startAllotment();

    // $_SESSION['success'] = "Stream deleted successfully";
    header("location: http://allotment/feature_admin/Verified/generateResults");
} else {
    header("location: http://allotment/index.php");
    die();
}

