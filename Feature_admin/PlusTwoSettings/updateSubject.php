<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    var_dump($_POST);
    $name = $_POST['name'];
    $allSubjects = CollegePortalRepository::getInstance()->getPlustTwoSubjects();
    $allSubjects = array_map(fn ($v) => strtolower($v['name']), $allSubjects);
    if (in_array(strtolower($name), $allSubjects)) {
        $_SESSION['error'] = "subject already exists,Try a diffrent name";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
        die();
    }
    CollegePortalRepository::getInstance()->updatePlustwoSubject($_POST['id'],$name);
    $_SESSION['success'] = "Subject name updated successfully";
    header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");

} else {
    header("location: http://allotment/index.php");
    die();
}

