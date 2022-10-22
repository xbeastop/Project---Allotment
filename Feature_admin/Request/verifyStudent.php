<?php
    if(isset($_POST['applicationNumber'])){
        include_once "../../Core/Data/Repository/collegePortalRepository.php";
        include_once "../IndexMarker/indexMarker.php";
        $appNo = $_POST['applicationNumber'];
        $graceMark = $_POST['graceMark'];
        $indexMarks = IndexMarkService::calculateIndexMark($appNo,$graceMark);
        foreach($indexMarks as $indexMark){
            CollegePortalRepository::getInstance()->updateIndexMark($appNo,$indexMark);
        }
    }