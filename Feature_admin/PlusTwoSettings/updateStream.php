<?php
var_dump($_GET);
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    $allStreams = CollegePortalRepository::getInstance()->getPlustTwoStreams();
    $allStreams = array_map(fn ($v) => strtolower($v['name']), $allStreams);
    if (in_array(strtolower($_GET['name']), $allStreams)) {
        $_SESSION['error'] = "Stream name already exists,Try a diffrent name";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
        die();
    }
    CollegePortalRepository::getInstance()->updateStreamById($_GET['id'], $_GET['name']);
    $_SESSION['success'] = "Stream name update successfully";
    header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
} else {
    header("location: http://allotment/index.php");
    die();
}
