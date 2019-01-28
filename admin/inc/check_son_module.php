<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/28 0028
 * Time: 下午 12:23
 */
if ((int)($_POST['father_module_id'])<1){
    //var_dump($_POST['father_module_id']);
    //exit();
    skip('son_module_add.php','error','所属父板块不得为空');
}
$query="select *from yzb_father_module where id={$_POST['father_module_id']}";
$result=execute($link,$query);
if (mysqli_num_rows($result)==0){
    skip('son_module_add.php','error','此父板块不存在，请重新选择');
}
if (empty($_POST['module_name'])){//板块名字是不是为空
    skip('son_module_add.php','error','板块名称不得为空');
}
if (mb_strlen("{$_POST['module_name']}",'utf-8')>66){//字符长度 y要开拓展
    skip('son_module_add.php','error','板块名称不得超过66个字符');
}
if (mb_strlen("{$_POST['info']}",'utf-8')>255){//字符长度 要开拓展

    skip('son_module_add.php','error','板块简介不得超过255个字符');
}
$_POST=escape($link,$_POST);
switch ($check) {
    case 'add':
        $query = "select *from yzb_son_module where module_name='{$_POST['module_name']}' ";
        break;
    case 'update':
        $query = "select *from yzb_son_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
        break;
    default :
        skip('son_module_add.php', 'error', '参数出现错误');


}
$result=execute($link,$query);
if (mysqli_num_rows($result)){
    skip('son_module_add.php','error','子版块已存在，请重新选择');

}





