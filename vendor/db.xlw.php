<?php

class db{
    protected static $link,$result;
    public function __construct($config)
    {
        self::$link = mysqli_connect(
            $config['dns'],
            $config['user'],
            $config['password'],
            $config['database']
        );
    }

    public function select($sql){
        self::$result = mysqli_query(self::$link,$sql);
        return $this;
    }

    public function fetchAll(){
        return mysqli_fetch_all(self::$result,MYSQLI_ASSOC);
    }

    public function fetchOne(){
        return mysqli_fetch_array(self::$result,MYSQLI_ASSOC);
    }

    public function insert($tableName,$array = array())
    {
        $value = '(';
        foreach($array as $k => $v)
        {
            is_string($v) ? $value .= "'".$v."'" : '';
            if(empty($v)){
                $v = 'null';
                $value .= $v.",";
            }
        }
        $value = rtrim($value);
        $value .= ")";
        $sql = 'insert into '.$tableName.' values '.$value;
        $this->select($sql);
    }

    public function update($tableName,$array = array(),$condition = '')
    {
        $value = '';
        foreach($array as $k => $v)
        {
            is_string($v) ? $value .= $k ."="."'".$v."'"."," : $value .= $k."=".$v.",";
            $value = rtrim($value,',');
            $sql = 'update '.$tableName.' set '.$value.' where '.$condition;
            $this->select($sql);
        }
    }

    public function delete($tableName,$id)
    {
        $sql = 'delete from '.$tableName.' where '.$id;
        $this->select($sql);
    }
}