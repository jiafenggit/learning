<?php
class sqlFactory
{
    public static function factory($type){
        if(include_once 'Drivers/'.$type.'.php'){
            $classname = 'Db_Adapter_'.$type;
            return new $classname;
        } else {
            throw new Exception('Driver not found');
        }
    }
}

//调用的时候就可以这样写
//$db = sqlFactory::('MySQL');