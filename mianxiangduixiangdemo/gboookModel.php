<?php
    /*
     * 留言本模型,负责管理留言本
     */
class gbookModel{
    private $bookPath;    //留言本文件
    private $data;    //留言数据
    public function setBookPath($bookPath){
        $this->bookPath = $bookPath;
    }

    public function getBookPath(){
        return $this->bookPath;
    }

    public function open(){

    }
    public function close(){

    }
    public function read(){
        return file_get_contents($this->bookPath);
    }
    //写入留言
    public function write($data){
        $this->data = self::safe($data)->name."&".self($data)->email."\r\nsaid:\r\n".self::safe($data)->content;
        return file_get_contents($this->bookPath,$this->data,FILE_APPEND);
    }
    //模拟数据的安全处理,先拆包在打包
    public static function safe(){
        $reflect = new ReflectionObject($data);
            $props = $reflect->getProjects();
            foreach ($props as $prop){
                $ivar = $prop->getName();
                $messageBox->$ivar = trim($prop->getValue($data));
            }
            return $messageBox;
        }
    public function delete(){
            file_get_contents($this->bookPath,"it's empty now" );
        }
}