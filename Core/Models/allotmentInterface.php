<?php
    interface AllotmentRepo{
        public function getAllCourses(): array;
        public function getStudentsBySelectedCourse($id): array;
        public function insertAllotedStudents($courseId,$students);
    }