<?php
session_start();
if (isset($_SESSION['adminId'])) {
    if (isset($_POST['studentId'])) {
        include_once "../../Core/Data/Repository/collegePortalRepository.php";
        $id = $_POST['studentId'];
        $type = $_POST['type'];
        if ($type != "all")
            echo CollegePortalRepository::getInstance()->getDocumentByApplicationNumberAndType($id, $type);
        else
            echo json_encode(
                CollegePortalRepository::getInstance()->getAllDocuments($id)
            );
    }
} else {
    header("location: http://allotment/index.php");
}
