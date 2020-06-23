<?php

require_once('cls_statusHandler.php');
require_once('statusCode.php');

class database
{
    public $session;
    private $_lastError;

    function connect()
	{
		//this is for debuging, it will show db error message.
		//disenable this in real world
        $this->session = new mysqli('localhost', 'root', '', 'test');
        if ($this->session->connect_errno) {
            $this->_lastError = $this->session->connect_error;
            return false;
        }
        return true;
    }

    function disconnect()
    {
        $this->session->close();
    }

    function error_get_last()
    {
        return $this->_lastError;
    }
}

interface CommandFace{
    public function doCommand();

    public function getResult();
}

class MysqliFactory{
    protected $dbsession;
    protected $statusHandler;

    protected $_Result = null;

    public function __construct($dbsession, &$statusHandler){
        $this->dbsession = $dbsession;
        $this->statusHandler = $statusHandler;
    }

    public function doCommand($Query, $param){
        if($this->statusHandler->isError())return false;
        $this->clearResult();
        $Param = $this->getParam($param);
        if(($stmt = $this->dbsession->prepare($Query)) == false){
            $this->pushStatus(STATUS::SQL_PREPARE_FAIL, 'SQL_prepare failed');
            return false;
        }
        if(count($Param)>1){
            if((call_user_func_array(array($stmt, 'bind_param'), $Param)) == false){
                $this->pushStatus(STATUS::SQL_PARAM_BIND_FAIL, 'SQL_Param bind failed');
                return false;
            }
        }
        if($stmt->execute() == false){
            $this->pushStatus(STATUS::SQL_QUERY_FAIL, 'SQL_Query failed');
            return false;
        }
        return $stmt;
    }

    public function SETCommand($Query, $param){
        $stmt = $this->doCommand($Query, $param);
        $stmt->close();
        $this->pushSUCCESS();
        return true;
    }

    public function SELECTCommand($Query, $param){
        $stmt = $this->doCommand($Query, $param);
        $SQLresult = $stmt->get_result();
        $this->_Result = $SQLresult->fetch_assoc();
        $stmt->close();
        $this->pushSUCCESS();
        return true;
    }

    public function SELECTLISTCommand($Query, $param){
        $stmt = $this->doCommand($Query, $param);
        $SQLresult = $stmt->get_result();
        $List = array();
        while($row = $SQLresult->fetch_array()){
            array_push($List, $row);
        }
        $this->_Result = $List;
        $stmt->close();
        $this->pushSUCCESS();
        return true;
    }

    public function INSERTCommand($Query, $param){
        $stmt = $this->doCommand($Query, $param);
        $this->_Result = $stmt->insert_id;
        $stmt->close();
        $this->pushSUCCESS();
        return true;
    }

    public function pushStatus($code, $msg){
        $this->statusHandler->setStatus($code, $msg);
    }

    public function pushSUCCESS($msg = 'nothing'){
        $this->statusHandler->setStatus(STATUS::SUCCESS, $msg);
    }

    public function clearResult(){

        $this->_Result = null;
    }

    public function getResult(){
        return $this->_Result;
    }

    protected function getParam($Param){
        $toBind_Param = array($this->getParamType($Param));
        if( is_iterable($Param) )
        {
            foreach ($Param as &$data) {
                $toBind_Param[] = &$data;
                //push data(as reference and database won't go error) into array 
            }
            unset($data);
            //clear the reference $data(which pointer to the last element in $this->QueryData)
            //NOTE: the reference to $this->QueryData won't be clear after foreach,you should clear it by yourself.
        }
        return $toBind_Param;
    }

    protected function getParamType($Param){
        $retn = '';
        foreach($Param as $param){
            switch(gettype($param)){
                case "string":
                    $retn .= 's';
                    break;
                case "integer":
                    $retn .= 'i';
                    break;
                case "double":
                    $retn .= 'd';
                    break;
                default:
                    $retn .= 's';
                    break;
            }
        }
        return $retn == '' ? null : $retn;
    }
}
/*
class SELECTCommand extends SQLCommand implements CommandFace{
    public function doCommand($Query, $param){
        parent::doCommand();
        $Param = $this->getParam($param);
        if(($stmt = $this->dbsession->prepare($Query)) == false){
            $this->pushStatus(STATUS::SQL_PREPARE_FAIL, 'SQL_prepare failed');
            return false;
        }
        if(count($Param)>1){
            if((call_user_func_array(array($stmt, 'bind_param'), $Param)) == false){
                $this->pushStatus(STATUS::SQL_PARAM_BIND_FAIL, 'SQL_Param bind failed');
                return false;
            }
        }
        if($stmt->execute() == false){
            $this->pushStatus(STATUS::SQL_QUERY_FAIL, 'SQL_Query failed');
            return false;
        }
        $SQLresult = $stmt->get_result();
        $this->_Result = $SQLresult->fetch_assoc();
        $stmt->close();
        $this->pushSUCCESS();
        return true;
    }
}
*/