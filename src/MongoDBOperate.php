<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-29
 * Time: 下午2:20
 */
namespace yangqingxian\mongodboperate;

use MongoDB\Driver\Manager;

class MongoDBOperate{
    static $manage=null;
    protected function getInstance(){
        if(self::$manage==null){
            $url="";
            return new Manager($url);
        }else{
            return self::$manage;
        }
    }
}

