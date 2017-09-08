<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-9-8
 * Time: 下午3:33
 */
namespace yangqingxian\mongodboperate;

use MongoDB\BSON\ObjectID;
use MongoDB\Driver\BulkWrite;

class InsertOperate extends MongoDBOperate{
    /**
     * 新增一条记录，第二个参数表示新增的数据中是否带有_id
     * @param  $collection string
     * @param $data array
     * @param false|true $with_id
     * @return string
     */
    public function insertOne($collection,$data,$with_id=false){
        // 如果数据中没有_id的话，则自动生成一个
        if(!$with_id){
            $_id_object=new ObjectID();
            $_id=$this->get_id_string($_id_object);
            $data['_id']=$_id;
        }
        $bulkWriter=new BulkWrite($this->option);
        $bulkWriter->insert($data);
        $manage=$this->getManageInstance();
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWriter);
        return $data['_id'];
    }

    /**
     * 一次性插入多条数据
     * @param $collection
     * @param $data
     * @param bool $with_id
     * @return array
     */
    public function insertArray($collection,$data,$with_id=false){
        $return_ids=array();
        $bulkWriter=new BulkWrite($this->option);
        if(!$with_id){
            foreach ($data as $key=>$value){
                $_id=$this->get_id_string(new ObjectID());
                $return_ids[]=$_id;
                $value['_id']=$_id;
                $bulkWriter->insert($value);
            }
        }else{
            foreach ($data as $key=>$value){
                $return_ids[]=$value['_id'];
                $bulkWriter->insert($value);
            }
        }
        $manage=$this->getManageInstance();
        $manage->executeBulkWrite($this->config['db'].".".$collection,$bulkWriter);
        return $return_ids;
    }
}