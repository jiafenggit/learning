<?php
class Response {
    /**
     * 按照json方式输出通信数据
     * $code 状态码
     * $message 提示信息
     * $data 数据
     */

    public static function json($code,$message = '',$data = array()) {

        if(!is_numeric($code)) {
            return '';
        }

        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        echo json_encode($result);
        exit;
    }


    public static function xml(){
        //header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='utf-8'?>\n";
        $xml .= "<root>\n";
        $xml .= "<code>200</code>\n";
        $xml .= "<message>success</message>\n";
        $xml .= "<data>\n";
        $xml .= "<id>1</id>\n";
        $xml .= "<name>ityike</name>\n";
        $xml .= "</data>\n";
        $xml .= "</root>";

        echo $xml;
    }

    public static function xmlEncode($code,$message,$data = array()) {
        if(!is_numeric($code)) {
            return '';
        }

        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='utf-8'?>\n";
        $xml .= "<root>\n";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>";
        echo $xml;
    }

    public static function xmlToEncode($data) {
        $xml = "";
        foreach($data as $k=>$v) {
            $xml .= "<{$k}>";
            $xml .= $v;
            $xml .= "<{$k}>";
        }
        return $xml;
    }
}

$data = array(
    'id' => 1,
    'name' => 'ityike'
);
Response::xmlEncode(200,'success',$data);


