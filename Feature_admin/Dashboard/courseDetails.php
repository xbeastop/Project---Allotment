<?php
if(isset($_POST['courseId'])){
    include_once "../../Core/Data/Repository/collegePortalRepository.php";

    $courses = CollegePortalRepository::getInstance()->getCourseById($_POST['courseId']);
    foreach($courses as $key => $course){
        $whoCanApply = explode(",",$course['whoCanApply']);
        foreach($whoCanApply as $id){
            $courses[$key][$id] = CollegePortalRepository::getInstance()->getWeightByStreamIdandCoureseId($id,$course['id']);
        }
    }
    echo json_encode($courses);
}