<?php

/**
 * Created by PhpStorm.
 * User: ityike
 * Date: 16/3/13
 * Time: 14:39
 */
class smtp_mail
{
    private $host;    //连接的SMTP服务器
    private $port = 25;   //绑定端口
    private $user;
    private $pass;
    private $debug = false;
    private $sock;     //保存与SMTP服务器连接的句柄
    private $mail_format = 0;  //标志使用什么样的邮件格式,0为普通邮件,1为HTML邮件

    function smtp_mail($host,$port,$user,$pass,$debug = 0,$format = 1)
    {
        $this->host = $host;
        $this->port = $host;
        $this->user = base64_encode($user);
        $this->pass = base64_encode($pass);
        $this->debug = $debug;
        $this->mail_format = $format;
        //使用fsockopen函数连接SMTP服务器,如果失败就显示错误信息,然后并把程序挂起.
        $this->sock = fsockopen($this->host,$this->port,& $errno,& $errstr,10);
        if(!$this->sock){
            exit("Error number:$errno,Error message:$errstr\n");
        }
        //使用fgets函数取得服务器的信息.如果返回信息包含220就代表成功连接服务器
        $response = fgets($this->sock);
        if(strstr($response,"220") === false){
            exit("Server error:$response\n");
        }
    }
    //show_debug()
    private function show_debug()
    {
        if($this->debug){
            echo"<p>Debug:$message</p>\n";
        }
    }
    //把命令发送到服务器执行,然后取得服务器的反馈消息,并且从服务器的反馈消息判断是否成功执行.
    //$cmd参数就是发送服务器执行的命令,如果服务器反馈消息存在$return_code,说明成功执行.
    private function do_command($cmd,$return_code)
    {
        fwrite($this->sock,$cmd);

        $response = fgets($this->sock);
        if(strstr($reponse,"$return_code") === false) {
            $this->show_debug($response);
            return false;
        }

        return true;
    }

    private function is_email()
    {
        //检验邮箱地址是否合法
        $pattren = "/^[^_][\w]*@[\w.]+[\w]*[^_]$/";
        if(preg_match($pattren,$email,$matches)) {
            return true;
        } else {
            return false;
        }
    }

    public function send_mail($from,$to,$subject,$body)
    {
        //验证邮箱是否合法,然后在验证邮箱内容是否为空
        if(!$this->is_email($from) OR !$this->is_email($to)){
            $this->show_debug("Please enter vaild from/to email.");
            return false;
        }

        if(empty($subject) OR empty($body)){
            $this->show_debug("Please enter subject/content.");
            return false;
        }

        //$detail是发送邮件的主要内容,包括收件人,发送人,邮件主题,邮件内容,还有邮件的格式和编码
        $detail = "From:".$from."\r\n";
        $detail .= "To:".$to."\r\n";
        $detail .= "Subject:".$subject."\r\n";

        if($this->mail_format == 1){
            $detail .= "Content-Type:text/html;\r\n";
        } else {
            $detail .= "Content-Type:text/plain;\r\n";
        }

        $detail .= "charset = gb2312\r\n\r\n";
        $detail .= $body;

        //根据SMTP协议命令发送
        $this->do_command("HELO smtp.qq.com\r\n",250);
        $this->do_command("AUTH LOGIN\r\n",334);
        $this->do_command($this->user."\r\n",334);
        $this->do_command($this->pass."\r\n",235);
        $this->do_command("MAIL FROM:".$from."\r\n",250);
        $this->do_command("RCPT TO:".$to."\r\n",250);
        $this->do_command("DATA\r\n",250);
        $this->do_command($detail."\r\n.\r\n",250);
        $this->do_command("QUIT\r\n",221);

        return true;
    }
}