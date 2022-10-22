<?php
require_once("model.php");
class StudentModel extends Model
{
    public $fullName;
    public $sex;
    public $nationality;
    public $state;
    public $age;
    public $dob;
    public $placeOfBirth;
    public $parentDetails;
    public $address;
    public $mobileNumber;
    public $bankAccountNumber;
    public $adhaar;
    public $email;
    public $religion;
    public $caste;
    public $discontinueReason;
    public $stream;
    public $nameOfSchool;
    public $yearOfPass;
    public $registerNumber;
    public $chanceTaken;
    public $board;

    static function fromParameters(
        $fullName,
        $sex,
        $nationality,
        $state,
        $age,
        $dob,
        $placeOfBirth,
        $parentDetails,
        $address,
        $mobileNumber,
        $bankAccountNumber,
        $adhaar,
        $email,
        $religion,
        $caste,
        $nameOfSchool,
        $yearOfPassing,
        $registerNumber,
        $chancesTaken,
        $board
    ) {
        $model = new StudentModel();
        $model->fullName = $fullName;
        $model->sex = $sex;
        $model->nationality = $nationality;
        $model->state = $state;
        $model->age = $age;
        $model->dob = $dob;
        $model->placeOfBirth = $placeOfBirth;
        $model->parentDetails = $parentDetails;
        $model->address = $address;
        $model->mobileNumber = $mobileNumber;
        $model->bankAccountNumber = $bankAccountNumber;
        $model->adhaar = $adhaar;
        $model->email = $email;
        $model->religion = $religion;
        $model->caste = $caste;
        $model->nameOfSchool = $nameOfSchool;
        $model->yearOfPassing = $yearOfPassing;
        $model->registerNumber = $registerNumber;
        $model->chancesTaken = $chancesTaken;
        $model->board = $board;
        return $model;
    }

}
