<?php
require_once("../Core/Models/studentModel.php");
require_once("../Core/Models/plusTwoModel.php");
require_once("../Core/Models/selectedCourseModel.php");
require_once("saveDocumentUC.php");
require_once("registrationPortalUC.php");

$studentModel = new StudentModel();
$studentModel->readValues($_POST);
$plusTwoModel = new PlusTwoModel();
$plusTwoModel->readValues($_POST);
$selectedCourseModel = new SelectedCourseModel();
$selectedCourseModel->readValues($_POST);

// var_dump($studentModel,$plusTwoModel,$plusTwoModel->asArray(),$selectedCourseModel->asArray(4000));

if (!CollegePortalRepository::getInstance()->isRegisterNumberAlreadyExists($_POST['registerNumber'])) {
    if (SaveDocumentUc::SaveStudent($studentModel)) {
        try {
            RegistrationUc::insertPlustwoDetails($plusTwoModel->asArray());
        } catch (Exception $e) {

            CollegePortalRepository::getInstance()->deleteStudentDetailsByApplicationNumber(SaveDocumentUc::getCurrentApplicationNumber());
            CollegePortalRepository::getInstance()->deleteMarkListByApplicationNumber($_POST['registerNumber']);
            header("location: index.php?error=couldn't complete your request, this happens when you enter mark of the same subject twice or didn't enter all 6 subjects");
            exit();
        }
        $filterdFiles = SaveDocumentUc::getFilterdFiles($_FILES);

        $file_names = SaveDocumentUc::getFileNamesFromFilterdFiles($filterdFiles);
        $dst = BASE_PATH . "\Core\Data\Data_source\Documents\\";

        foreach ($filterdFiles as $key => $value) {
            move_uploaded_file($value["path"], $dst . $file_names[$key]);
        }


        RegistrationUc::insertSelectedCourse($selectedCourseModel->asArray(
            RegistrationUc::getCurrentApplicationNumber()
        ));

        SaveDocumentUc::saveDocuments($file_names);
        $applicationNumber = SaveDocumentUc::getCurrentApplicationNumber();
        header("location: index.php?success=application submited successfuly, your application number is $applicationNumber. you can check your allotment results <a href =http://allotment/feature_portal/viewResults>here</a>");
    } else {
        header("location: index.php?error=couldn't complete your request, this happens when you already applied");
    }
} else {
    header("location: index.php?error=couldn't complete your request, this happens when you already applied");
}
















// $fullName = $_POST["fullName"];
// $sex = $_POST["sex"];
// $nationality = $_POST["nationality"];
// $state = $_POST["state"];
// $age = $_POST["age"];
// $dob = $_POST["dob"];
// $placeOfBirth = $_POST["placeOfBirth"];
// $parentDetails = $_POST["parentDetails"];
// $address = $_POST["address"];
// $mobileNumber = $_POST["mobileNumber"];
// $bankAccountNumber = $_POST["bankAccountNumber"];
// $adhaar = $_POST["adhaar"];
// $email = $_POST["email"];
// $religion = $_POST["religion"];
// $caste = $_POST["caste"];
// $discontinueReason = $_POST["discontinueReason"];
// $nameOfSchool = $_POST["nameOfSchool"];
// $yearOfPassing = $_POST["yearOfPassing"];
// $registerNumber = $_POST["registerNumber"];
// $chancesTaken = $_POST["chancesTaken"];
// $board = $_POST["board"];
// $firstOption = $_POST["firstOption"];
// $secondOption = $_POST["secondOption"];
// $thirdOption = $_POST["thirdOption"];

// $studentModel = StudentModel::fromParameters(
//     $fullName,
//     $sex,
//     $nationality,
//     $state,
//     $age,
//     $dob,
//     $placeOfBirth,
//     $parentDetails,
//     $address,
//     $mobileNumber,
//     $bankAccountNumber,
//     $adhaar,
//     $email,
//     $religion,
//     $caste,
//     $discontinueReason,
//     $nccOrNss,
//     $dependentOfExServiceMan,
//     $handicaped,
//     $archivements,
//     $nameOfSchool,
//     $yearOfPassing,
//     $registerNumber,
//     $chancesTaken,
//     $board,
//     $firstOption,
//     $secondOption,
//     $thirdOption
// );