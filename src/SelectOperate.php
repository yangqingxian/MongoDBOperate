<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-9-8
 * Time: 下午4:48
 */
namespace yangqingxian\mongodboperate;

use MongoDB\Driver\Query;

class SelectOperate extends MongoDBOperate {
    /**
     * 简单的搜索功能
     * @param $collection string
     * @param $filter array
     * @param $option array
     * @return array
     */
    public function select($collection,$filter,$option=[]){
        $query=new Query($filter,$option);
        $manage=$this->getManageInstance();
        $data=$manage->executeQuery($this->config['db'].".".$collection,$query);
        $array_data=$data->toArray();
        // 对数据做一个简单的处理
        $returnData=$this->fixData($array_data);
        return $returnData;
    }

    /**
     * 对数据做一个统一的处理，这里暂时只是将各个array_object的格式数据转换成数组形式
     * @param $data array
     * @return array
     */
    public function fixData($data){
        $returnData=array();
        foreach ($data as $key=>$value){
            $temp=(array)$value;
            $returnData[$key]=$temp;
        }
        return $returnData;
    }
}