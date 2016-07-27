<?php

require_once("./json.php");
$arr = array(
    'id' => 1,
    'name' => 'ityike'
);

Response::json(200,'success',$arr);



