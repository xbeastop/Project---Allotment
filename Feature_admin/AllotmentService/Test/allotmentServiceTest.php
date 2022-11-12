<?php
include_once "C:\wamp64\www\Project - Allotment\Core\Models\allotmentInterface.php";
include_once "C:\wamp64\www\Project - Allotment\Feature_admin\AllotmentService\allotmentService.php";
include_once "C:\wamp64\www\Project - Allotment\Core\Data\Repository\collegePortalRepository.php";

class TestRepo implements AllotmentRepo
{
    public $allotedList = [];
    public function getAllCourses(): array
    {
        return IndexTester::getCoursesForTest();
    }
    public function getStudentsBySelectedCourse($id): array
    {
        return IndexTester::getStudentsByCourse($id,31);
    }
    public function insertAllotedStudents($courseId, $students)
    {
        if (!key_exists($courseId, $this->allotedList)) {
            $this->allotedList[$courseId] = $students;
        } else {
            $this->allotedList[$courseId] += $students;
        }
    }
}
$testRepo = new TestRepo();
// $testRepo = CollegePortalRepository::getInstance();

$test = new AllotmentService($testRepo);

$test->allotNow();
var_dump($testRepo->allotedList);
// var_dump(CollegePortalRepository::$allotedList);




class IndexTester
{

    static function getCoursesForTest()
    {
        $result = [];
        array_push(
            $result,
            [
                "id" => 1,
                "noOfSeat" => 5
            ]
        );
        array_push(
            $result,
            [
                "id" => 2,
                "noOfSeat" => 5
            ]
        );
        array_push(
            $result,
            [
                "id" => 3,
                "noOfSeat" => 5
            ]
        );
        return $result;
    }

    static function getForTest()
    {
        $returnList = [
            "Student1" => [
                "1" => [
                    "optionNumber" => 1,
                    "indexMark" => 750
                ],
                "2" => [
                    "optionNumber" => 2,
                    "indexMark" => 850
                ]
            ],
            "Student2" => [
                "1" => [
                    "optionNumber" => 1,
                    "indexMark" => 900
                ],
                "2" => [
                    "optionNumber" => 2,
                    "indexMark" => 1050
                ]
            ],
            "Student3" => [
                "1" => [
                    "optionNumber" => 1,
                    "indexMark" => 650
                ],
                "2" => [
                    "optionNumber" => 2,
                    "indexMark" => 800
                ],
                "3" => [
                    "optionNumber" => 3,
                    "indexMark" => 900
                ]
            ],
            "Student4" => [
                "2" => [
                    "indexMark" => 1000,
                    "optionNumber" => 1
                ],
                "3" => [
                    "indexMark" => 1159,
                    "optionNumber" => 2
                ],
            ],
            "Student5" => [
                "3" => [
                    "indexMark" => 753,
                    "optionNumber" => 1
                ],
            ],
            "Student6" => [
                "1" => [
                    "indexMark" => 962,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1185,
                    "optionNumber" => 2
                ],
            ],
            "Student7" => [
                "3" => [
                    "indexMark" => 1214,
                    "optionNumber" => 1
                ],
            ],
            "Student8" => [
                "3" => [
                    "indexMark" => 1314,
                    "optionNumber" => 1
                ],
            ],
            "Student9" => [
                "1" => [
                    "indexMark" => 715,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 995,
                    "optionNumber" => 2
                ],
            ],
            "Student10" => [
                "3" => [
                    "indexMark" => 996,
                    "optionNumber" => 1
                ],
            ],
            "Student11" => [
                "1" => [
                    "indexMark" => 744,
                    "optionNumber" => 1
                ],
            ],
            "Student12" => [
                "1" => [
                    "indexMark" => 868,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 850,
                    "optionNumber" => 2
                ],
            ],
            "student13" => [
                "3" => [
                    "indexMark" => 598,
                    "optionNumber" => 1
                ]
            ],
            "student14" => [
                "2" => [
                    "indexMark" => 1017,
                    "optionNumber" => 1
                ]
            ],
            "student15" => [
                "2" => [
                    "indexMark" => 1010,
                    "optionNumber" => 1
                ]
            ],
            "student16" => [
                "1" => [
                    "indexMark" => 800,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1000,
                    "optionNumber" => 2
                ]
            ],
            "student17" => [
                "1" => [
                    "indexMark" => 680,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 717,
                    "optionNumber" => 2
                ]
            ],
            "student18" => [
                "2" => [
                    "indexMark" => 578,
                    "optionNumber" => 1
                ],
                "3" => [
                    "indexMark" => 628,
                    "optionNumber" => 2
                ]
            ],
            "student19" => [
                "3" => [
                    "indexMark" => 729,
                    "optionNumber" => 1
                ]
            ],
            "student20" => [
                "1" => [
                    "indexMark" => 1083,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1283,
                    "optionNumber" => 2
                ]
            ],
            "student21" => [
                "1" => [
                    "indexMark" => 1083,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1203,
                    "optionNumber" => 2
                ]
            ],
            "student22" => [
                "1" => [
                    "indexMark" => 753,
                    "optionNumber" => 1
                ],
            ],
            "student23" => [
                "3" => [
                    "indexMark" => 823,
                    "optionNumber" => 1
                ],
            ],
            "student24" => [
                "1" => [
                    "indexMark" => 776,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 926,
                    "optionNumber" => 2
                ]
            ],
            "student25" => [
                "1" => [
                    "indexMark" => 910,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 998,
                    "optionNumber" => 2
                ]
            ],
            "student26" => [
                "3" => [
                    "indexMark" => 677,
                    "optionNumber" => 1
                ]
            ],
            "student27" => [
                "2" => [
                    "indexMark" => 928,
                    "optionNumber" => 1
                ]
            ],
            "student28" => [
                "1" => [
                    "indexMark" => 798,
                    "optionNumber" => 1
                ]
            ],
            "student29" => [
                "1" => [
                    "indexMark" => 640,
                    "optionNumber" => 1
                ],
                "3" => [
                    "indexMark" => 826,
                    "optionNumber" => 2
                ]
            ],
            "student30" => [
                "1" => [
                    "indexMark" => 940,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1140,
                    "optionNumber" => 2
                ],
                "3" => [
                    "indexMark" => 1140,
                    "optionNumber" => 3
                ]
            ],
            "student31" => [
                "1" => [
                    "indexMark" => 905,
                    "optionNumber" => 1
                ],
                "2" => [
                    "indexMark" => 1005,
                    "optionNumber" => 2
                ],
                "3" => [
                    "indexMark" => 1300,
                    "optionNumber" => 3
                ]
            ]

        ];

        return $returnList;
    }

    static function getStudentsByCourse($courseId, $limit = 30)
    {
        $array = self::getForTest();

        $sub =  array_filter(
            array_slice($array, 0, $limit),
            fn ($value) => in_array($courseId, array_keys($value))
        );

        uasort($sub, function ($b, $a) use ($courseId) {
            return $a[$courseId]["indexMark"] <=> $b[$courseId]["indexMark"];
        });

        return array_map(function ($v) use ($courseId) {
            return [
                "optionNumber" => $v[$courseId]["optionNumber"],
                "indexMark" => $v[$courseId]["indexMark"]
            ];
        }, $sub);
        return $sub;
    }
}
