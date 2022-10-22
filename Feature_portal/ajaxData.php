<?php
require_once("registrationPortalUC.php");

if (isset($_POST['selectedStreamId'])) {
    $id = $_POST['selectedStreamId'];
    $subjects = RegistrationUc::getSubjectesByStreamId($id);
    echo "<option disabled selected>Select Subject</option>";
    foreach ($subjects as $subject) {
        echo "<option value =" . $subject['id'] . "> " . $subject['name'] . "</option>";
    }
}

if (isset($_POST['streamIdForCourse'])) {
    $streamId = $_POST['streamIdForCourse'];
    $courses = RegistrationUc::getCoursesByStreamId($streamId);
    echo "<option disabled selected>Select Option</option>";
    foreach ($courses as $course) {
        $id = $course['id'];
        $courseName = $course['name'];
        echo "<option value = $id>$courseName</option>";
    }
}
