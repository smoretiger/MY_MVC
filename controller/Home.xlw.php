<?php

class Home
{

    public function Index()
    {
        $result = $GLOBALS['db']->select('show databases')->fetchAll();
        include 'view/home.html';
    }

    public function table()
    {
        $database = $_GET['database'];
        $GLOBALS['db']->select("use $database;");
        $result = $GLOBALS['db']->select('show tables;')->fetchAll();
        $jsonString = json_encode($result);
        $jsonString = str_replace($database, 'name', $jsonString);
        //var_dump($jsonString);die;
        $array = json_decode($jsonString, true);
        //var_dump($array);die;
        include "view/table.html";
    }

    public function getTableIndex()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        include 'view/tableindex.html';
    }

    public function Filed()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        $array = $GLOBALS['db']->select("desc $database.$table")->fetchAll();
        include "view/filed.html";
    }

    public function getIndex()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        $array = $GLOBALS['db']->select("show index from $database.$table")->fetchAll();
        //var_dump($array);exit;
        include "view/getindex.html";
    }

    public static function new_table()
    {
        $database = $_GET['database'];
        include "view/new_table.html";
    }

    public function tableContent()//右边显示数据表
    {
        $database = $_GET['database'];//获取数据库
        //var_dump($database);die;
        $GLOBALS['db']->select("use $database");
        $res = $GLOBALS['db']->select("show tables")->fetchAll();//获取所有表

        $string = json_encode($res);
        $string = str_replace($database, 'name', $string);
        $array = json_decode($string, true);
        //var_dump($result);die;
        include 'view/tablecontent.html';
    }
}