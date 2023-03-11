<?php


class FormData
{
    public $inputName;
    public $inputDescription;
    public $inputDate;
    public $selectProject;

    public function __construct($inputName, $inputDescription, $inputDate, $selectProject)
    {
        $this->inputName = $inputName;
        $this->inputDescription = $inputDescription;
        $this->inputDate = $inputDate;
        $this->selectProject = $selectProject;
    }
}


//$formData = new FormData(
//   $_POST['inputName'],
//  $_POST['inputDescription'],
//    $_POST['inputDate'],
//    $_POST['selectProject']
//);