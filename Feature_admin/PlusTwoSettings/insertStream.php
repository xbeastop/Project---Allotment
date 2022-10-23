<?php
session_start();
if(isset($_SESSION['adminId']))
{
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    CollegePortalRepository::getInstance()->insertPlustwoStream($_POST);
}
else {
    header("location: http://allotment/index.php");
    die();
}