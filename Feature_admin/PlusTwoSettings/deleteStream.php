<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    CollegePortalRepository::getInstance()->deleteStreamById($_GET['id']);
    $_SESSION['success'] = "Stream deleted successfully";
    header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
} else {
    header("location: http://allotment/index.php");
    die();
}
