<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-9-8
 * Time: 下午4:25
 */
namespace yangqingxian\mongodboperate;

use MongoDB\Driver\BulkWrite;

class UpdateOperate extends MongoDBOperate{
    /**
     * 更新一条数据
     * @param $collection string
     * @param $filter array
     * @param $data array
     * @param bool $delete_and_insert
     */
    public function updateOne($collection,$filter,$data,$delete_and_insert=false){
        // 如果是先删除后新增的方式
        $bulkWrite=new BulkWrite($this->option);
        if($delete_and_insert){
            $bulkWrite->delete($filter);
            $bulkWrite->insert($data);
        }
        // 否则就是单纯更新一条记录
        else{
            $bulkWrite->update($filter,$data);
        }
        $manage=$this->getManageInstance();
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWrite);
    }

    /**
     * 使用一个filter更新多条数据
     * @param $collection string
     * @param $filter array
     * @param $data array
     * @param bool $delete_and_insert
     */
    public function updateArrayWithOneFilter($collection,$filter,$data,$delete_and_insert=false){
        $bulkWrite=new BulkWrite($this->option);
        if($delete_and_insert){
            $bulkWrite->delete($filter);
            foreach ($data as $k=>$v){
                $bulkWrite->insert($v);
            }
        }else{
            foreach ($data as $key=>$value){
                $bulkWrite->update($filter,$value);
            }
        }
        $manage=$this->getManageInstance();
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWrite);
    }

    /**
     * 使用多个filter更新对应的$data
     * @param $collection string
     * @param $filters array
     * @param $data array
     * @param bool $delete_and_insert
     */
    public function updateArray($collection,$filters,$data,$delete_and_insert=false){
        $bulkWrite=new BulkWrite($this->option);
        if($delete_and_insert){
            foreach ($filters as $key=>$filter){
                $bulkWrite->delete($filter);
            }
            foreach ($data as $k=>$v){
                $bulkWrite->insert($v);
            }
        }else{
            foreach ($data as $key=>$value){
                $bulkWrite->update($filters[$key],$value);
            }
        }
        $manage=$this->getManageInstance();
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWrite);
    }
}