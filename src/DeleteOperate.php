<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-9-8
 * Time: 下午4:17
 */
namespace yangqingxian\mongodboperate;

use MongoDB\Driver\BulkWrite;

class DeleteOperate extends MongoDBOperate{
    /**
     * 删除一条记录
     * @param $collection string
     * @param $_id string
     */
    public function deleteOne($collection,$_id){
        $filter=array(
            '_id'=>$_id
        );
        $bulkWrite=new BulkWrite($this->option);
        $manage=$this->getManageInstance();
        $bulkWrite->delete($filter);
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWrite);
    }

    /**
     * 删除多条记录
     * @param $collection string
     * @param $filter array
     */
    public function deleteArray($collection,$filter){
        $bulkWrite=new BulkWrite($this->option);
        $manage=$this->getManageInstance();
        $bulkWrite->delete($filter);
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWrite);
    }
}