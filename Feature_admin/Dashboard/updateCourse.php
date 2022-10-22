<?php
if (isset($_POST["courseName"])) {
    include_once "../../Core/Data/Repository/collegePortalRepository.php";
    $arr = $_POST;
    $arr['name'] = $_POST['courseName'];
    unset($arr['courseName']);
    $whoCanApply = $arr['whoCanApply'];
    $indexingSubjects = "";
    foreach ($whoCanApply as $id) {
        unset($arr[$id]);
    }
    if (isset($_POST['indexingSubjects'])) {
        $indexingSubjects = implode(",", $_POST['indexingSubjects']);
        unset($arr['indexingSubjects']);
    }
    $arr['whoCanApply'] = implode(",", $whoCanApply);
    $arr['indexingSubjects'] = $indexingSubjects;
    CollegePortalRepository::getInstance()->updateCourse($arr);
    $courseId = $_POST['courseId'];
    CollegePortalRepository::getInstance()->deleteAllWeightageForCourse($courseId);
    foreach ($whoCanApply as $id) {
        if ($_POST[$id] > 0)
            CollegePortalRepository::getInstance()->insertWeightage($courseId, $id, $_POST[$id]);
    }
}
