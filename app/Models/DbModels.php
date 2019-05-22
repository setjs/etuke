<?php
/**
 * User: 郭利俊
 * Date: 2018/6/13
 * Time: 09:49
 * 搜索公共方法
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DbModels extends Model
{
    protected $table;
    public $timestamps= false ;

    protected function insertData($table , $data){

        $this->table=$table;
        return self::insert($data);
    }
    protected function insertGetIdData($table , $data){

        $this->table=$table;
        return self::insertGetId($data);
    }
    protected function selectData($table , $limit = 30){

        $this->table=$table;
        return self::orderBy('id' , 'desc')->paginate($limit);
    }
    protected function selectDataLimit($table , $where ,  $limit = 30){

        $this->table=$table;
        return self::where($where)->orderBy('id' , 'desc')->paginate($limit);
    }
    protected function selectOne($table , $id){

        $this->table=$table;
        return self::where('id' , $id)->first();
    }

    protected function updateData($table , $id , $data){

        $this->table=$table;
        return self::where('id' , $id)->update($data);
    }
    protected function updateWhereData($table , $where , $data){

        $this->table=$table;
        return self::where($where)->update($data);
    }
    protected function deleteData($table , $id){

        $this->table=$table;
        return self::where('id' , $id)->delete();
    }

    protected function deleteWhere($table , $where){

        $this->table=$table;
        return self::where($where)->delete();
    }

    protected function selectName($table , $name){

        $this->table=$table;
        $result =  self::where('name' , $name)->select('id')->first();

        if($result){
            return $result->id;
        }else{
            return false ;
        }
    }

    protected function getAll($table){

        $this->table=$table;
        return self::orderBy('id' , 'desc')->get();
    }


    protected function selectField($table ,$where, $select="*"){

        $this->table=$table;
        return self::where($where)->select($select)->orderBy('id' , 'desc')->first();
    }

    protected function selectAllPidIsOne($table , $where , $select='*' ){

        $this->table=$table;
        return self::where($where)->select($select)->orderBy('sort' , 'desc')->get();
    }


    protected function whereInData($table ,  $str ,  $key='id'  , $select="*"){
        $this->table=$table;

        $arr = explode(',' , $str);
     //   dd($arr);
        return self::whereIn($key, $arr)
            ->select($select)
            ->get();
    }

    protected function selectWhereGetAll($table , $where  , $key='id' , $val = 'desc' ,  $select='*'){

        $this->table=$table;
        return self::where($where)->select($select)->orderBy($key , $val)->get();
    }


    protected function selectArray($table , $where , $select='*'){

        $this->table=$table;
        return self::where($where)->select($select)->get();
    }


    protected function selectWhereNot($table , $where  ,$id ,  $key='id' , $val = 'desc' ,  $select='*'){

        $this->table=$table;
        return self::where($where)
            ->where('id' , '!=' , $id)
            ->select($select)->orderBy($key , $val)->get();
    }



    protected function incData($table ,$where ,  $key , $val){
        $this->table=$table;
        return self::where($where)->increment($key, $val);
    }

    protected function selectWhereTime($table ,$where, $key='id', $val='desc', $select="*"){
        $this->table=$table;
        return self::where($where)->select($select)->orderBy($key , $val)->first();
    }

    protected function getTake($table , $limit=10){
        $this->table=$table;
        return self::take($limit)->orderBy('id' , 'desc')->get();
    }

    protected function getTakeWhere($table , $where , $limit=10){
        $this->table=$table;
        return self::take($limit)->where($where)->orderBy('id' , 'desc')->get();


    }
    protected function whereInSelect($table , $where ,$key , $arr,$select="*"){
        $this->table=$table;

        return self::where($where)->whereIn($key, $arr)->select($select)->get();
    }

    protected function getAllData($table , $select){
        $this->table=$table;

        return self::orderBy('id','desc')->select($select)->get();
    }

}