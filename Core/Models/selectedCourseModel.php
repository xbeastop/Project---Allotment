<?php
    include_once "model.php";
    class SelectedCourseModel extends Model{
        public $firstOption;
        public $secondOption;
        public $thirdOption;


        function asArray($applicationNumber){
            $array = [];
            for($i = 1;$i<=3;$i++){
                array_push(
                    $array,
                    array(
                        "applicationNumber" => $applicationNumber,
                        "optionNumber" => $i,
                        "courseId" => $this->getOption($i)
                    )
                    );
            }
            return $array;
        }
        
        private function getOption($number){
            switch($number){
                case 1: return $this->firstOption;
                case 2: return $this->secondOption;
                case 3: return $this->thirdOption;
            }
        }
    }