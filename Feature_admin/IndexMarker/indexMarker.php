<?php
include_once "../../Core/Models/studentModel.php";
include_once "../../Core/Data/Repository/collegePortalRepository.php";

class IndexMarkService
{
    static function calculateIndexMark($applicationNumber, int $graceMark = 0)
    {
        /*
            read grandTotal and coreTotal
            read all options in an array
            loop through it and ->
                check its indexingType and select the mark
                read the indexingSubects mark and select the greatest one
                read weightage Mark
                add the selectedMark + indexingSubjectMark + additionalMark 
                add it in a result array as courseId => indexMark
            return the array
            */
        $result = [];
        $repo = CollegePortalRepository::getInstance();
        $registerNumber = $repo->getRegisterNumberByApplicationId($applicationNumber);
        $streamId = $repo->getStreamByApplicationNumber($applicationNumber);
        $grandTotal = $repo->getGrandTotalByRegisterNumber($registerNumber);
        $coreTotal = $repo->getCoreTotalByRegisterNumber($registerNumber);
        $selectedCourses = $repo->getSelectedCoursesByApplicationNumber($applicationNumber);
        foreach ($selectedCourses as $course) {
            $total = 0;
            $courseId = $course['courseId'];
            switch ($repo->getIndexingType($courseId)) {
                case 'GRAND_TOTAL':
                    $total = $grandTotal;
                    break;
                case 'CORE_TOTAL':
                    $total = $coreTotal;
                    break;
            }
            $weightage = $repo->getWeightByStreamIdandCoureseId($streamId,$courseId);
            $indexingSubjectIds = $repo->getIndexingSubjectId($courseId);
            $indexingSubjectMark = 0;
            foreach ($indexingSubjectIds as $subId) {
                if (empty($subId)) continue;
                $mark = $repo->getMarkOfSubject($registerNumber, $subId);
                if ($mark > $indexingSubjectMark) $indexingSubjectMark = $mark;
            }
            array_push($result,array(
                'optionNumber' => $course['optionNumber'],
                'indexMark' => $total + $indexingSubjectMark + $graceMark + $weightage
            ));
        }
    return $result;
    }
}
// $applicationNumber = "81";

// var_dump(IndexMarkService::calculateIndexMark($applicationNumber));
//     var_dump(CollegePortalRepository::getInstance()->getGrandTotalByRegisterNumber($registerNumber),
//     CollegePortalRepository::getInstance()->getCoreTotalByRegisterNumber($registerNumber)
// );