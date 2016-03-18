<?php
class authorControl{
    public function message(leaveModel $l,gbookModel $g,message $data){
    //留言本上留言
    $l -> write($g,$data);
    }

    public function view(gbookModel $g){
    //查看留言本内容
    return $g->read();
}
    public function delete(gbookModel $g){
    $g->delete();
    echo self::view($g);
}
}