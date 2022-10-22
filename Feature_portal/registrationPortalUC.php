<?php
include_once("../Core/Data/Repository/collegePortalRepository.php");
class RegistrationUc
{
    static function getStreams(): array
    {
        return CollegePortalRepository::getInstance()->getPlustTwoStreams();
    }
    static function getCoursesByStreamId($streamId): array
    {
        return CollegePortalRepository::getInstance()->getCoursesByStreamId($streamId);
    }
    static function getSubjectesByStreamId($id)
    {
        return CollegePortalRepository::getInstance()->getSubjectesByStreamId($id);
    }

    static function insertPlustwoDetails($arr)
    {
        CollegePortalRepository::getInstance()->insertMarklist($arr);
    }

    static function getCurrentApplicationNumber()
    {
        return CollegePortalRepository::getInstance()->getCurrentApplicationNumber();
    }

    static function insertSelectedCourse($arr)
    {
        CollegePortalRepository::getInstance()->insertSelectedCourse($arr);
    }
}
