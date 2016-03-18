<?php
    //定义适配器的接口
    interface Db_Adapter{
        /*
         * 数据库的连接
         */
        public function connect($config){
            /*
             * 执行数据库的查询
             */
        }
        public function query($query,$handle);
    }