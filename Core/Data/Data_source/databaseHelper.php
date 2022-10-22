<?php
    class DatabaseHelper{
        private $conn;
        function __construct($host,$user,$pass,$db)
        {
            $this->conn = mysqli_connect($host,$user,$pass,$db);
        }
        function __destruct()
        {
            mysqli_close($this->conn);
        }
        function execute($sql){
           return mysqli_query($this->conn,$sql);
        }
        function fetchArray($sql){
            $result = $this->execute($sql);
            $returnList = [];
            while($row = mysqli_fetch_assoc($result)){
                array_push($returnList,$row);
            }
            return $returnList;
        }
    }
