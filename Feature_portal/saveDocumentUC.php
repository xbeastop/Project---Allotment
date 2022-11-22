<?php
include_once("../Core/Data/Repository/collegePortalRepository.php");
class SaveDocumentUc
{
    static function getExtension($file)
    {
        $exploedTemp = explode(".", $file);
        return end($exploedTemp);
    }

    public static function getCurrentApplicationNumber()
    {
        return CollegePortalRepository::getInstance()->getCurrentApplicationNumber();
    }

    static function SaveStudent($student)
    {
        return CollegePortalRepository::getInstance()->insertStudent($student);
    }

    static function getNewFileName($type, $fileName)
    {
        $ext = self::getExtension($fileName);
        $fileName = $type . self::getCurrentApplicationNumber() . "." . $ext;
        return $fileName;
    }


    static function getFilterdFiles($files)
    {
        $filterd_ = array_filter($files, function ($v) {
            return !empty($v["name"]);
        });

        return array_map(function ($v) {
            return ["path" => $v["tmp_name"], "fileName" => $v["name"]];
        }, $filterd_);
    }

    static function getFileNamesFromFilterdFiles($files)
    {
        $dst = "";
        $returnList = [];
        foreach ($files as $key => $file) {
            $returnList[$key] = $dst . self::getNewFileName($key, $file["fileName"]);
        }
        return $returnList;
    }

    static function saveDocuments($arr)
    {
        $repo = CollegePortalRepository::getInstance();
        $applicationNumber = self::getCurrentApplicationNumber();
        foreach ($arr as $key => $value) {
            $repo->insertDocument($applicationNumber,$key, $value);
        }
    }
}

















function test()
{
    $files = array("amal.pdf", "amal.php", "amal.manoj.am.png");
    foreach ($files as $fl) {
        SaveDocumentUc::getNewFileName("nccOrNss", $fl);
    }
}
