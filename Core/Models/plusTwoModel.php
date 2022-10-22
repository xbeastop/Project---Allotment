<?php
require_once("model.php");
class PlusTwoModel extends Model
{
    public $registerNumber;

    public $subject1;
    public $subject2;
    public $subject3;
    public $subject4;
    public $subject5;
    public $subject6;

    public $markObteined_1;
    public $markObteined_2;
    public $markObteined_3;
    public $markObteined_4;
    public $markObteined_5;
    public $markObteined_6;

    public $markRequired_1;
    public $markRequired_2;
    public $markRequired_3;
    public $markRequired_4;
    public $markRequired_5;
    public $markRequired_6;

    public $maxMark_1;
    public $maxMark_2;
    public $maxMark_3;
    public $maxMark_4;
    public $maxMark_5;
    public $maxMark_6;

    public $grade_1;
    public $grade_2;
    public $grade_3;
    public $grade_4;
    public $grade_5;
    public $grade_6;

    function asArray()
    {
        $array = [];
        for ($i = 1; $i <= 6; $i++) {
            $subject = "subject$i";
            $mark = "markObteined_$i";
            $grade = "grade_$i";
            $requiredMark = "markRequired_$i";
            $maxMark = "maxMark_$i";
            array_push(
                $array,
                array(
                    "registerNumber" => $this->registerNumber,
                    "subject" => $this->$subject,
                    "mark" => $this->$mark,
                    "grade" => $this->$grade,
                    "requiredMark" => $this->$requiredMark,
                    "maxMark" => $this->$maxMark
                )
            );
        }
        return $array;
    }
}
