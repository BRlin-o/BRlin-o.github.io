<?php

class STATUS{
    const SUCCESS               = 0;

    const UNKNOWN_EXCEPTION     = -1;
    
    const SQL_ERROR             = -100;
    const SQL_PREPARE_FAIL      = -101;
    const SQL_PARAM_BIND_FAIL   = -102;
    const SQL_QUERY_FAIL        = -102;
}