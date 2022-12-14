<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    $allStreams = CollegePortalRepository::getInstance()->getPlustTwoStreams();
    $allStreams = array_map(fn ($v) => strtolower($v['name']), $allStreams);
    if (in_array(strtolower($_POST['name']), $allStreams)) {
        $_SESSION['error'] = "Stream already exists,Try a diffrent name";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
        die();
    }

    CollegePortalRepository::getInstance()->insertPlustwoStream($_POST);
    $_SESSION['success'] = "Stream added successfully";
    header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");

} else {
    header("location: http://allotment/index.php");
    die();
}
