<?php
session_start();
if (isset($_SESSION['adminId'])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    var_dump($_POST);
    $belognsTo = isset($_POST['belongsTo']) ? implode(",", $_POST['belongsTo']) : "";
    $name = $_POST['name'];

    $isLanguage = "0";
    if (isset($_POST['isLanguage'])) {
        $isLanguage = "1";
        $belognsTo = "";
    }
    if ($_POST['type'] == "insert") {
        $allSubjects = CollegePortalRepository::getInstance()->getPlustTwoSubjects();
        $allSubjects = array_map(fn ($v) => strtolower($v['name']), $allSubjects);
        if (in_array(strtolower($name), $allSubjects)) {
            $_SESSION['error'] = "subject already exists,Try a diffrent name";
            header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
            die();
        }
        CollegePortalRepository::getInstance()->insertPlustwoSubject($name, $belognsTo, $isLanguage);
        $_SESSION['success'] = "Subjected added successfully";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
    } else {
        CollegePortalRepository::getInstance()->updatePlustwoSubject($_POST['id'], $name, $belognsTo, $isLanguage);
        $_SESSION['success'] = "Subjected updated successfully";
        header("location: http://allotment/Feature_admin/PlusTwoSettings/index.php");
    }
} else {
    header("location: http://allotment/index.php");
    die();
}
