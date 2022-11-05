<?php
session_start();
if(isset($_SESSION['adminId'])){
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    CollegePortalRepository::getInstance()->activatePortal();
    header("location: http://allotment/Feature_admin/Dashboard/index.php");


} else {
    header("location: http://allotment/index.php");
}