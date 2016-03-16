<?php
/**
 * Created by PhpStorm.
 * User: ityike
 * Date: 16/3/13
 * Time: 16:06
 */
//先创建一个session的数据表
//CREATE TABEL `session`(
//    `sid` CHAR(40) NOT NULL COMMENT 'session名',
//    `data` VARCHAR(200) NOT NULL COMMENT `session值`,
//    `update` INT(10) UNSIGNED NOT NULL DEFAULT `0` COMMENT `更新时间`,
//    UNIQUE INDEX `sid` (`sid`))
//    COLLATE = `utf8_general_ci`
//    ENGINE=MEMORY
//    ROW_FORMAT=DEFAULT

class SessionSaveHandle {
    public $lifeTime;
    public $db;
    private $tosql;
    private $sessiondata;
    private $lastflush;

    private $sessName = 'PHPSESSID';

    public function __construct()
    {
        $this->db = Datebase::getInstance();
        $this->lifeTime = get_cfg_var("session.gc_maxlifetime");
    }

    function open($savePath,$sessName) {
        return true;
    }

    function close(){
        //$this->gc(ini_get('session.gc_maxlifetime'));
        return true;
    }

    function read($sid) {
        $format = "SELECT data FROM sessions WHERE sid = '%s' LIMIT1";
        $this->tosql = sprintf($format,$sid);
        $result = $this->db->getOne($this->tosql);
        if(!empty($result)){
            return $this->sessiondata = $result;//若需要更多数据,$result[XXXX]
        }
        /*
         *

        if(!empty($result)){
            $this->lastflush = $result['updata'];
            $this->sessiondata = $result['data'];
            return true;
        }

        */

    }

    function write($sessID,$sessData) {
        $now = time();
        $newExp = $now + $this->lifeTime;
        $this->tosql = "SELECT * FROM sessions WHERE sid = '$sessID'";
        $result = $this->db->getOne($this->tosql);
        if($sessData == ""||!isset($sessData)) {
            $sessData = $this->sessiondata;
        }
        if($result) {
            $this->db->excute("UPDATE sessions SET 'update' = '$newExp',data = '$sessData' WHERE sid = '$sessID'");
            if(mysql_affected_rows()) {
                return true;
            }
        } else {
            $this->db->insert("INSERT INTO sessions (sid,'update',data) VALUES('$sessID','$now','$sessData')");
            if(mysql_affected_rows()){
                return true;
            }
        }

        return false;
    }

    function destroy($sessID) {
        $this->tosql = "DELETE FROM sessions WHERE sid = '$sessID'";
        if($this->db->excute($this->tosql)){
            return true;
        } else {
            return false;
        }
    }

    function gc($sessMaxLifeTime){
        $t = time();
        $this->tosql = "DELETE FROM sessions WHERE $t - 'update'>${sessMaxLifeTime}";
        var_dump($this->tosql);
        $this->db->excute($this->tosql);
        if(mysql_affected_rows()>0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


