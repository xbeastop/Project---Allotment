<?php
require_once("../../Core/Data/Repository/collegePortalRepository.php");

if (isset($_POST['selectedStreamIds'])) {
    $id = $_POST['selectedStreamIds'];
    $subjects = CollegePortalRepository::getInstance()->getIndexingSubjectsByStreamId($id);
    echo "<option disabled selected>Select Subject</option>";
    foreach ($subjects as $subject) {
        echo "<option value =" . $subject['id'] . "> " . $subject['name'] . "</option>";
    }
}

if (isset($_POST['allCourseNames'])) {
    echo json_encode(
        CollegePortalRepository::getInstance()->getAllCourseNames()
    );
}
if (isset($_POST["courseName"])) {
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
    $courseId = CollegePortalRepository::getInstance()->insertCourse($arr);
    foreach ($whoCanApply as $id) {
        if ($_POST[$id] > 0) {
            CollegePortalRepository::getInstance()->insertWeightage($courseId, $id, $_POST[$id]);
        }
    }
}
