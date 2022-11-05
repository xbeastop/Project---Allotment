<?php
session_start();
if(isset($_SESSION['adminId'])){
    if(isset($_POST['courseId'])){
        include_once "../../Core/Data/Repository/collegePortalRepository.php";
        CollegePortalRepository::getInstance()->deleteCourseById($_POST['courseId']);
    }
}else {
    header("location: http://allotment/index.php");
}