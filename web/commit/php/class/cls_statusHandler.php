<?php

class statusHandler{
    private $statusCode;
    private $messageDict;

    public function __construct()
    {
        $this->statusCode = 0;
        $this->messageDict = array();
    }

    public function setStatus($code, $message){
        array_push($this->messageDict, $message);
        $this->statusCode = $code;
    }

    public function isError(){
        return $this->statusCode !== 0;
    }

    public function checkCode($codeToCheck){
        return $this->statusCode === $codeToCheck;
    }

    public function getStatus(){
        return $this->statusCode;
    }

    public function getStatusMessage(){
        return end($this->messageDict);
    }
}