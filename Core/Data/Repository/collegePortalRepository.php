<?php

include_once("C:\wamp64\www\Project - Allotment\Core\Data\Data_source\databaseHelper.php");
include_once "C:\wamp64\www\Project - Allotment\Core\Models\allotmentInterface.php";
include_once "C:\wamp64\www\Project - Allotment\Core\Models\model.php";

class CollegePortalRepository implements AllotmentRepo
{
    private $db;
    private static $instance = null;
    public static $allotedList;
    private function __construct()
    {
        $this->db = new DatabaseHelper("localhost", "root", "", "college_portal");
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CollegePortalRepository();
        }
        return self::$instance;
    }

    static function valueOf($array)
    {
        if (empty($array[0])) return null;
        return array_values($array[0])[0];
    }
    //overriding
    function insertAllotedStudents($courseId, $students)
    {
        //TODO("not yet implemented")
        self::$allotedList[$courseId] = $students;
        if (!key_exists($courseId, self::$allotedList)) {
            self::$allotedList[$courseId] = $students;
        } else {
            self::$allotedList[$courseId] += $students;
        }
    }
    //overridig
    function getStudentsBySelectedCourse($courseId): array
    {
        $array = $this->db->fetchArray(
            "SELECT * FROM selected_courses WHERE courseId = '$courseId'"
        );
        $result = [];
        foreach ($array as $item) {
            $result[$item["applicationNumber"]] = [
                "optionNumber" => $item["optionNumber"],
                "indexMark" => $item["indexMark"]
            ];
        }
        return $result;
    }
    //overrideing
    function getAllCourses(): array
    {
        return $this->db->fetchArray(
            "SELECT * FROM course_details"
        );
    }
    function loginAdmin($array){
        $result = $this->db->fetchArray("SELECT * FROM login_table WHERE email = '".$array['email']."' AND password ='".md5($array['password'])."'");
        return empty($result) ? null : $result;
    }
    function getAllCourseNames(): array
    {
        return array_map(fn ($v) => $v['name'], $this->getAllCourses());
    }

    function getAllNonVerifiedStudents()
    {
        return $this->db->fetchArray(
            "SELECT * FROM student_details WHERE applicationNumber IN(
                SELECT DISTINCT applicationNumber FROM `selected_courses`  WHERE indexMark = 0
            )"
        );
    }
    function getAllVerifiedStudents()
    {
        return $this->db->fetchArray(
            "SELECT * FROM student_details WHERE applicationNumber IN(
                SELECT DISTINCT applicationNumber FROM `selected_courses`  WHERE indexMark != 0
            )"
        );
    }

    function insertStudent($student)
    {
        $query = "";
        foreach ($student as $key => $value) {
            if (!is_null($value)) {
                // if ($key === "dob") {
                //     $value = implode("-", array_reverse(explode("-", $value)));
                //     echo $value;
                // }
                $comma = $key !== "fullName" ? "," : "";
                $query .= $comma . $key . " = " . "'$value'";
            }
        }
        $query = "INSERT INTO student_details SET " . $query . ";";
        echo $query;
        $result = $this->db->execute($query);
        var_dump($result);
        return $result;
    }
    function updateStudent($id, $key, $value)
    {
        $query = "UPDATE student_details set $key = '$value' where applicationNumber = '$id';";
        echo "<br>UpdateStudent: $query";
        var_dump($this->db->execute($query));
    }
    function getStudentDetailsById()
    {
    }
    function getCurrentApplicationNumber()
    {
        return array_values($this->db->fetchArray("SELECT MAX(applicationNumber) FROM student_details")[0])[0];
    }

    function insertDocument($applicationNumber, $type, $path)
    {
        $query = "INSERT INTO documents_table set applicationNumber='$applicationNumber', documentType = '$type', path = '$path';";
        $this->db->execute($query);
    }
    function getDocumentByApplicationNumberAndType($applicationNumber, $type)
    {
        return self::valueOf(
            $this->db->fetchArray("SELECT path from documents_table WHERE documentType ='$type' AND applicationNumber='$applicationNumber'")
        );
    }

    function getAllDocuments($applicationNumber)
    {
        return $this->db->fetchArray(
            "SELECT * FROM documents_table WHERE applicationNumber = '$applicationNumber'"
        );
    }

    function insertCourse($arr)
    {
        $query = "";
        foreach ($arr as $key => $value) {
            $comma = $key !== "noOfSeat" ? "," : "";
            $query .= $comma . $key . " = " . "'$value'";
        }
        $query = "INSERT INTO course_details SET " . $query . ";";
        $this->db->execute($query);
        return self::valueOf(
            $this->db->fetchArray("SELECT MAX(id) FROM course_details")
        );
    }
    function updateCourse($arr)
    {
        $query = "";
        $courseId = $arr['courseId'];
        foreach ($arr as $key => $value) {
            if ($key != "courseId") {
                $comma = $key !== "noOfSeat" ? "," : "";
                $query .= $comma . $key . " = " . "'$value'";
            }
        }
        $query = "UPDATE course_details SET " . $query . " WHERE id = '$courseId' ;";
        $this->db->execute($query);
    }

    function getCourseById($id)
    {
        return
            $this->db->fetchArray(
                "SELECT * FROM course_details WHERE id = '$id'"
            );
    }
    function getCourseNameById($id)
    {
        return $this->getCourseById($id)[0]['name'];
    }
    function getCoursesByStreamId($streamId): array
    {
        return $this->db->fetchArray("SELECT * FROM `course_details` WHERE whoCanApply LIKE '%$streamId%'");
    }
    function deleteCourseById($id)
    {
        /*
        manually deleting all other tables referencing course Id
            course_details table
            weightage_table
            selected_courses
        */
        $this->db->execute("DELETE FROM course_details WHERE id = '$id'");
        $this->db->execute("DELETE FROM weightage_table WHERE courseId = '$id'");
        $this->db->execute("DELETE FROM selected_courses WHERE courseId = '$id'");
    }


    function getNumberOfRequestForCourse($id)
    {
        return self::valueOf(
            $this->db->fetchArray(

                "SELECT COUNT(applicationNumber) FROM selected_courses WHERE courseId = $id"
            )
        );
    }

    function insertSelectedCourse($arr)
    {
        foreach ($arr as $item) {
            echo "<br>";
            $query = "";
            foreach ($item as $key => $value) {
                $comma = $key !== "applicationNumber" ? "," : "";
                $query .= $comma . $key . " = " . "'$value'";
            }

            $query = "INSERT INTO selected_courses SET " . $query . ";";
            echo $query;
            var_dump($this->db->execute($query));
        }
    }

    function updateIndexMark($applicationNumber, $indexMark)
    {
        $mark = $indexMark['indexMark'];
        $optionNumber = $indexMark['optionNumber'];
        $this->db->execute(
            "UPDATE selected_courses SET
            indexMark = $mark WHERE applicationNumber = $applicationNumber AND optionNumber = $optionNumber"
        );
    }

    function getIndexMarkByApplicationNumberAndOptionNumber($applicationNumber, $optionNumber)
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT indexMark FROM selected_courses WHERE applicationNumber = '$applicationNumber' AND optionNumber = '$optionNumber'"
            )
        );
    }

    function getSelectedCoursesByApplicationNumber($applicationNumber)
    {
        return $this->db->fetchArray(
            "SELECT optionNumber,courseId from selected_courses WHERE applicationNumber = '$applicationNumber' ORDER BY optionNumber;"
        );
    }
    function getIndexingType($courseId)
    {
        return self::valueOf($this->db->fetchArray(
            "SELECT indexingType from course_details WHERE id = '$courseId';"
        ));
    }
    function getIndexingSubjectId($courseId)
    {
        $ids = self::valueOf($this->db->fetchArray(
            "SELECT indexingSubjects from course_details WHERE id = '$courseId';"
        ));
        return explode(',', $ids);
    }


    function insertWeightage($courseId, $streamId, $weight)
    {
        $this->db->execute("INSERT INTO weightage_table SET
        courseId = '$courseId',
        streamId = '$streamId',
        weight = '$weight';");
    }
    function deleteAllWeightageForCourse($courseId)
    {
        $this->db->execute("DELETE FROM weightage_table WHERE courseId = '$courseId'");
    }


    function getWeightByStreamIdandCoureseId($streamId, $courseId): int
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT weight FROM weightage_table WHERE courseId = '$courseId' AND streamId = '$streamId';"
            )
        ) ?? 0;
    }
    function getIndexingSubjectsByStreamId($ids)
    {
        $list = explode(',', $ids);
        $belongsTo = "";
        foreach ($list as $id) {
            $belongsTo .= "belongsTo LIKE '%$id%' OR ";
        }
        $query = "SELECT id,name FROM plustwo_subjects WHERE " . $belongsTo . "belongsTo IS null";
        return $this->db->fetchArray($query);
    }

    function getSubjectesByStreamId($id)
    {
        return $this->db->fetchArray("SELECT id,name FROM plustwo_subjects WHERE belongsTo IS null or belongsTo LIKE '%$id%'");
    }
    function getSubjectNameById($id)
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT name FROM plustwo_subjects WHERE id = '$id'"
            )
        );
    }
    function insertMarklist($arr)
    {
        foreach ($arr as $item) {
            echo "<br>";
            $query = "";
            foreach ($item as $key => $value) {
                $comma = $key !== "registerNumber" ? "," : "";
                $query .= $comma . $key . " = " . "'$value'";
            }

            $query = "INSERT INTO marklist_table SET " . $query . ";";
            echo $query;
            var_dump($this->db->execute($query));
        }
    }
    function getMarkListByApplicationNumber($applicationNumber)
    {
        return $this->db->fetchArray(
            "SELECT * FROM marklist_table WHERE registerNumber = (SELECT registerNumber FROM student_details WHERE applicationNumber = '$applicationNumber')"
        );
    }
    function getRegisterNumberByApplicationId($applicationNumber)
    {
        return self::valueOf($this->db->fetchArray("SELECT registerNumber FROM student_details WHERE applicationNumber ='$applicationNumber'"));
    }
    function getMarklistByRegisterNumber()
    {
    }
    function getGrandTotalByRegisterNumber($registerNumber): int
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT SUM(mark) FROM marklist_table WHERE registerNumber = '$registerNumber'"
            )
        );
    }
    function getCoreTotalByRegisterNumber($registerNumber): int
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT SUM(mark) FROM marklist_table WHERE subject IN (SELECT id FROM plustwo_subjects WHERE isLanguage IS false) AND marklist_table.registerNumber = '$registerNumber';"
            )
        );
    }
    function getMarkOfSubject($registerNumber, $subjectId): int
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT mark FROM marklist_table WHERE subject ='$subjectId' AND registerNumber = '$registerNumber';"
            )
        ) ?? 0;
    }

    function insertPlustwoStream($array)
    {
        $this->db->execute("INSERT INTO plustwo_streams SET name='".$array['name']."'");
    }
    function getStreamByApplicationNumber($applicationNumber)
    {
        return self::valueOf(
            $this->db->fetchArray(
                "SELECT stream FROM student_details WHERE applicationNumber = '$applicationNumber';"
            )
        );
    }
    function getPlustTwoStreams(): array
    {
        return $this->db->fetchArray("SELECT * FROM plustwo_streams");
    }
    function getStreamNameById($id)
    {
        return self::valueOf(
            $this->db->fetchArray("SELECT name FROM plustwo_streams WHERE id = '$id'")
        );
    }
}
