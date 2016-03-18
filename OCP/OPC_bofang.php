<?php
//定义一个抽象的接口
interface process {
    public function process();
}
//实现播放器的编码功能,实现process的接口
class playerencode implements process{
    public function process()
    {
        echo 'encode\r\n';
    }
}
class playeroutput implements process{
    public function process()
    {
        echo "output\r\n";
    }
}
//播放器的调度管理器
class playProcess{
    private $message = null;
    public function __construct()
    {
    }
    public function callback(event $event){
        $this->message = $event->click;
        if($this->message instanceof process){
            $this->message->process();
        }
    }
}
//播放器的事件处理逻辑
class mp4 {
    public function work() {
        $playProcess = new playProcess();
        $playProcess->callback(new event('encode'));
        $playProcess->callback(new event('output'));
    }
}
//播放器的时间处理类
class event {
    private $m;
    public function __construct($me)
    {
        $this->m =$me;
    }

    public function click(){
        swith($this->m) {
        case 'encode': return new playerencode();
        break;
        case 'output': return new playeroutput();
        break;
        }
    }
}











