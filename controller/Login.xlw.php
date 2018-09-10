<?php
header('Content-type:text/html;charset=utf-8');
class Login{

    public function land(){
        include 'view/login.html';
    }

    public function loginCheck(){

        $user = $_POST['pma_username'];
        $password = $_POST['pma_password'];
//        var_dump($_POST);exit;

        $result = $GLOBALS['db']->select("select * from mysql.`user` where `User`='".$user."'")->fetchOne();
        if(empty($result)){
            die('此用户不存在');
        }else{
            $aa = $GLOBALS['db']->select('select '."'".$result['Password']."'".'=password("'.$password.'") as res;')->fetchOne();
            if($aa['res'] != 1){
                die('密码有误');
            }else{
                $_SESSION['user'] = $result;
                header('location:http://www.xlw.com/index.php/home/index');

            }
        }

    }
}