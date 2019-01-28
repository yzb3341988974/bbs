<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/26 0026
 * Time: 下午 6:41
 */
if (empty($_POST['module_name'])){//板块名字是不是为空
    skip('son_module_add.php','error','子板块名称不得为空');
}



//var_dump(mb_strlen("{$_POST['module_name']}",'utf-8')>66);
//exit();
if ((int)mb_strlen("{$_POST['module_name']}",'utf-8')>66){//字符长度 要开拓展
    skip('son_module_add.php','error','子板块名称不得超过66个字符');
}




$_POST=escape($link,$_POST);
switch ($check){
    case 'add':$query="select *from yzb_father_module where module_name='{$_POST['module_name']}'";break;
    case 'update':$query="select *from yzb_father_module where module_name='{$_POST['module_name']}' and id !={$_GET['id']}";break;
    default : skip('father_module.php','ok','参数出现错误');

}
$result=execute($link,$query);
if (mysqli_num_rows($result)){
    skip('father_module_add.php','error','板块名称已经存在');

}






if (!is_numeric($_POST['sort'])){
    skip('father_module_add.php','error','排序只能是数字');
}

