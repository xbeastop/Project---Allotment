<?php 
session_start();
if(isset($_SESSION['adminId'])){
    require_once "../../Core/Data/Repository/collegePortalRepository.php";

    CollegePortalRepository::getInstance()->deleteAllRecords();
    header("location: index");

} else {
    header("location: http://allotment/index.php");
}
