<?php
session_start();
if (isset($_SESSION['adminId'])) {
  require_once __DIR__ . '/vendor/autoload.php';
  require_once "../../Core/Data/Repository/collegePortalRepository.php";

  $allotedStudents = CollegePortalRepository::getInstance()->getAllotedStudents();


  $start = '<!DOCTYPE html>
<html>
<head>
<style>
.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

.customers tr:nth-child(even){background-color: #f2f2f2;}

.customers tr:hover {background-color: #ddd;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.fade {
    font-size: 0.9rem;
    color: #525151;

}
</style>
</head>
<body>

<h1>Allotment Result</h1>

<table class="customers">
  <tr>
    <th>App<br>No</th>
    <th>Full Name</th>
    <th>Phone</th>
    <th>Course</th>
    <th>Option</th>
    <th>Mark</th>
  </tr>';

  $all = '';
  foreach ($allotedStudents as $student) {
    foreach ($student as $key => $val) {
      $$key = $val;
    }
    $studentDetails = CollegePortalRepository::getInstance()->getStudentDetailsById($applicationNumber)[0];
    $courseName = CollegePortalRepository::getInstance()->getCourseNameById($courseId);
    $name = $studentDetails['fullName'];
    $all .= '<tr>
    <td>' . $applicationNumber . '</td>
    <td>' . $name . '<div class="fade">' . $studentDetails['email'] . '</div></td>
    <td>' . $studentDetails['mobileNumber'] . '</td>
    <td>' . $courseName . '</td>
    <td>' . $optionNumber . '</td>
    <td>' . $indexMark . '</td>
    </tr>
    ';
  }
  $all .= '</table>';

  $byCourses = '';
  $courses = array_map(fn ($v) => $v['courseId'], $allotedStudents);
  $courses = array_unique($courses);
  foreach ($courses as $courseId) {
    $courseName = CollegePortalRepository::getInstance()->getCourseNameById($courseId);
    $byCourses .= '
    <br><br>
    <h3>' . $courseName . '</h3>
  <table class="customers">
  <tr>
    <th>App<br>No</th>
    <th>Full Name</th>
    <th>Phone</th>
    <th>Option</th>
    <th>Mark</th>
  </tr>';

    $temp = '';
    $allotedStudentsByCourse = array_filter($allotedStudents, fn ($v) => $v['courseId'] == $courseId);
    foreach ($allotedStudentsByCourse as $student) {
      foreach ($student as $key => $val) {
        $$key = $val;
      }
      $studentDetails = CollegePortalRepository::getInstance()->getStudentDetailsById($applicationNumber)[0];
      $name = $studentDetails['fullName'];
      $temp .= '<tr>
    <td>' . $applicationNumber . '</td>
    <td>' . $name . '<div class="fade">' . $studentDetails['email'] . '</div></td>
    <td>' . $studentDetails['mobileNumber'] . '</td>
    <td>' . $optionNumber . '</td>
    <td>' . $indexMark . '</td>
    </tr>
    ';
    }
    $temp .= '</table>';
    $byCourses .= $temp;
  }

  $end = '
</body>
</html>
';

  $mpdf = new \Mpdf\Mpdf();
  $mpdf->SetTitle("Allotment Result");
  $mpdf->WriteHTML($start . $all . $byCourses . $end);
  $mpdf->Output("allotmentResult.pdf", 'I');
} else {
  header("location: http://allotment/index.php");
  die();
}
