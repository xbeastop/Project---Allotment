<?php
define("BASE_PATH","C:\wamp64\www\Project - Allotment");
define("SITE_URL","http://allotment/");
    abstract class Model{
        function readValues($arr){
            foreach($arr as $key => $value){
                if(property_exists($this,$key)){
                    if(is_string($value))
                      $value = strlen($value) == 0 ? null : $value;
                    $this->$key = $value;
                }
            }
        }
    }