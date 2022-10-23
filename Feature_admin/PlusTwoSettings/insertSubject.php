<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    var_dump($_POST);
    $belognsTo = implode(",",$_POST['belongsTo']);
    $name = $_POST['name'];
    $allSubjects = CollegePortalRepository::getInstance()->getPlustTwoSubjects();
    $allSubjects = array_map(fn ($v) => strtolower($v['name']), $allSubjects);
    if (in_array(strtolower($name), $allSubjects)) {
        $_SESSION['error'] = "subject already exists,Try a diffrent name";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
        die();
    }
    CollegePortalRepository::getInstance()->insertPlustwoSubject($name,$belognsTo,0);
    $_SESSION['success'] = "Subjected added successfully";
    header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");

} else {
    header("location: http://allotment/index.php");
    die();
}
