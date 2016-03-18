<?php
class Db_Adapter_Mysql implements Db_Adapter
{
    private $_dbLink;//数据库连接字符串标示
    /*
     * 数据库的连接函数
     */
    public function connect($config)
    {
        // TODO: Implement connect() method.
        if($this->_dbLink = @mysql_connect($config->host .(empty($config->port)?'':':'.$config->port),$config->user,$config->password,true)){
            if(@mysql_select_db($config->database,$this->_dbLink)){
                if($config->charset){
                    mysql_query("SET NAMES'{$config->charset}'",$this->_dbLink);
                }
                return $this->_dbLink;
            }
        }
        /*
         * 数据库异常
         */
        throw new Db_Exception(@mysql_erro($this->_dbLink));
    }

    /*
     * 执行数据库查询
     */
    public function query($query, $handle)
    {
        // TODO: Implement query() method.
        if($resource = @mysql_query($query,$handle)){
            return $resource;
        }
    }
}