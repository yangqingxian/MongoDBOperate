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
    // manage操作实例
    static $manage=null;
    // option操作项
    protected $option=[];
    protected $config=array(
        'host'=>"",
        "port"=>"",
        "user"=>"",
        "password"=>"",
        "db"=>""
    );
    public function __construct()
    {

    }

    /**
     * 单例模式，获取基础操作类
     * @return Manager
     */
    protected function getManageInstance(){
        if(self::$manage==null){
            $url=$this->getUrl();
            self::$manage=new Manager($url);
        }
        $manage=self::$manage;
        return $manage;
    }
    /**
     * 提取new ObjectID生成的对象中的_id字符串
     * @param $_id_object object
     * @return mixed
     */
    protected function get_id_string($_id_object){
        $temp=(array)$_id_object;
        return $temp['oid'];
    }

    /**
     * 获取连接实例
     * @return string
     */
    protected function getUrl(){
        return "";
    }

    /**
     * 设置新增参数
     * @param $option array
     */
    public function setOption($option){
        $this->option=$option;
    }
}

