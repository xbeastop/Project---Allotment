<?php

class AllotmentModel
{

    private int $courseId;
    private int $remainingSeat;
    private int $finishedOption;
    private int $currentOption;
    private array $studentList;


    function __construct(
        $courseId,
        $remainingSeat,
        $studentList
    ) {
        $this->courseId = $courseId;
        $this->remainingSeat = $remainingSeat;
        $this->studentList = $studentList;
        // used to check if every course has finished same iteration 
        $this->finishedOption = 0;
        // starts with first option and then go on
        $this->currentOption = 1;
    }

    function removeStudents($list){
        foreach($list as $applicationNumber => $details){
            unset($this->studentList[$applicationNumber]);
        }
    }
    function getStudentList(){
        return $this->studentList;
    }
    function setFinishedOption(int $optionNumber){
        $this->finishedOption = $optionNumber;
    }

    function isTheOptionFinished(int $optionNumber): bool{
        return $this->finishedOption >= $optionNumber;
    }

    function currentOption()
    {
        return $this->currentOption;
    }
    function resetOption()
    {
        if ($this->currentOption != 1) $this->currentOption = 1;
    }
    function incrementCurrentOption()
    {
        $this->currentOption++;
    }
    function decrementSeatBy(int $num)
    {
        $this->remainingSeat = $this->remainingSeat - $num;
    }
    function remainingSeat()
    {
        return $this->remainingSeat;
    }

    function isFullyAlloted()
    {
        return empty($this->studentList) || $this->remainingSeat == 0;
    }

    function getCourseId(){
        return $this->courseId;
    }
}


