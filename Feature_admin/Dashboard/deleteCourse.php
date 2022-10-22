<?php
    if(isset($_POST['courseId'])){
        include_once "../../Core/Data/Repository/collegePortalRepository.php";
        CollegePortalRepository::getInstance()->deleteCourseById($_POST['courseId']);
    }