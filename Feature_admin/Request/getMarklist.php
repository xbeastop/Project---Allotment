<?php
session_start();
if (isset($_SESSION['adminId'])) {
    if (isset($_POST['applicationNumber'])) {
        include_once "../../Core/Data/Repository/collegePortalRepository.php";
        $repo = CollegePortalRepository::getInstance();

        $markLists = $repo->getMarkListByApplicationNumber($_POST['applicationNumber']);
        foreach ($markLists as $key => $markList) {
            $markLists[$key]['subject'] = $repo->getSubjectNameById($markList['subject']);
        }
        echo json_encode($markLists);
    }
} else {
    header("location: http://allotment/index.php");
}
