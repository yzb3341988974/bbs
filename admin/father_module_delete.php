<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/20 0020
 * Time: 下午 4:13
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$link=connect();
if (!isset($_GET['id'])|| !is_numeric($_GET['id'])){//不是数字字符串
    skip('father_module.php','error',"参数id错误");

}
//var_dump(mysqli_fetch_all($result,MYSQLI_ASSOC));
//var_dump($_GET);
$query=" delete from yzb_father_module where id={$_GET['id']}";
//var_dump($query);
//skip('father_module.php','ok',"恭喜你跳转成功");
$result=execute($link,$query);

if (mysqli_affected_rows($link)==1){
    skip('father_module.php','ok',"恭喜你跳转成功");

}
else{
    skip('father_module.php','error',"删除失败请重试");

}




