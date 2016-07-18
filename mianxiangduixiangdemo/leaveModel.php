<?php
class leaveModel{
    public function write(gbookModel $gb,$data){
        $book = $gb->getBookPath();
        $gb->write($data);
        //记录日志
    }
}
