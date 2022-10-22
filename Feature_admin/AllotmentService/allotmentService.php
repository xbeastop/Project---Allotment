<?php
include_once "C:\wamp64\www\Project - Allotment\Core\Models\allotmentModel.php";
include_once "C:\wamp64\www\Project - Allotment\Core\Models\allotmentInterface.php";

class AllotmentService
{

    private $coursesForAllotment;
    private AllotmentRepo $repo;

    private function getAllCourses(): array
    {
        return $this->repo->getAllCourses();
    }
    private function getAllStudentsForCourse($id): array
    {
        return $this->repo->getStudentsBySelectedCourse($id);
    }
    function __construct(AllotmentRepo $repo)
    {
        $this->repo = $repo;
        $this->coursesForAllotment = array_map(
            fn ($course) => new AllotmentModel(
                $course["id"],
                $course["noOfSeat"],
                self::getAllStudentsForCourse($course["id"])
            ),
            self::getAllCourses()
        );
    }
    private function isOthersCurrentOptionHasFinished(int $option): bool
    {
        foreach ($this->coursesForAllotment as $course) {
            if (!$course->isTheOptionFinished($option)) return false;
        }
        return true;
    }
    private function isAllCoursesFullyAlloted(): bool
    {
        foreach ($this->coursesForAllotment as $course) {
            if (!$course->isFullyAlloted()) return false;
        }
        return true;
    }
    function allotNow()
    {
        while (!$this->isAllCoursesFullyAlloted()) {
            for ($i = 0; $i < sizeof($this->coursesForAllotment); $i++) {
                $courseModel = &$this->coursesForAllotment[$i];
                $slice = array_slice($courseModel->getStudentList(), 0, $courseModel->remainingSeat(), true);
                $this->filterAndAllot($slice, $courseModel);
                $courseModel->resetOption();
            }
        }
    }
    private function filterAndAllot($slice, &$allotmentModel)
    {
        $filterd = array_filter($slice, function ($value) use ($allotmentModel) {
            return $value["optionNumber"] == $allotmentModel->currentOption();
        });
        $size = sizeof($filterd);
        if ($size > 0) {
            $this->repo->insertAllotedStudents($allotmentModel->getCourseId(), $filterd);
            $this->removeStudentsFromOtherList($filterd);
            $allotmentModel->decrementSeatBy($size);
        } else {
            $allotmentModel->setFinishedOption($allotmentModel->currentOption());
            if ($this->isOthersCurrentOptionHasFinished($allotmentModel->currentOption())) {
                $allotmentModel->incrementCurrentOption();
                $this->filterAndAllot($slice, $allotmentModel);
            }
        }
    }
    function removeStudentsFromOtherList($list)
    {
        for ($i = 0; $i < sizeof($this->coursesForAllotment); $i++) {
            $model = &$this->coursesForAllotment[$i];
            $model->removeStudents($list);
        }
    }
}



/*
    read the list of courses [id,noOfseat]
    create an AllotmentModel with ->
        courseId,
        remainingSeats (initialy = noOf seats),
        finishedOption (initialy -1),
        currentOption (initialy 0)
        all the students applied to that course with descending order of IndexMark
            applicationNumber => [
                optionNumber => 1,
                indexMark => 100
            ]

    somehow loop(
        not all courses are fully alloted 
            [ if the student list become empty or remainigSeats == 0 consider it as fully alloted ]
    ){
        forEach course in the CourseObjectList {
            take the first N students(remainingSeats) as slicedList
            filterAndAllot(slicedList,course)
        }
    }

     fun filterAndAllot(slicedList,course){
                filter slicedList by optionNumber == course.currentOption
                if it is not empty then->
                    add them to the alloted list
                    remove them from the this list and all the other list (remove by applicationNumber)
                    decrement remainingSeats by no of alloted students

                else ->
                    course.finishedOption = course.currentOption (mark that first option has finished)
                    check if all other subject's currentOption has finished (others.finishedOption >= currentOption)
                    if yes-> 
                        course.currentOption++
                        !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!RECURSIVE CALL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                        filterAndAllot(slicedList,course)

                    if no->
                    continue (skip and go for the next course) [reset currentOption to 0 ??]

                course.resetOption()
     }
*/