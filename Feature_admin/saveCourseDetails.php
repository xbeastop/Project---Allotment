<?php
    include_once("../Core/Models/courseModel.php");
    $courseModel = new CourseModel();
    $courseModel->readValues($_POST);
    var_dump($CourseModel);