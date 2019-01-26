
<?php

include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

if (isset($_POST['submit'])){
    //var_dump($_POST['module_name']);
    //var_dump($_POST['sort']);
   // var_dump(mb_strlen("{$_POST['module_name']}"));exit();
    $link=connect();
    $check='add';
    include 'inc/check_father_module.php';//验证填写信息
    $query="insert into yzb_father_module(module_name,sort) values ('{$_POST['module_name']}','{$_POST['sort']}')";
    execute($link,$query);
    if (mysqli_affected_rows($link)==1){
        skip('father_module.php','ok','恭喜你添加成功');
    }else{
        skip('father_module.php','error','添加失败，请重新添加');
    }

}


$arr['title']='添加父板块页';
?>
<?php include 'inc/header.inc.php';?>
<div id="main" style="height:1000px;">
    <div class="title">添加父板块</div>
<form method="post">
<table class="au" style="margin-top: 20px">
    <tr>
        <td>版块名称</td>
        <td><input type="text" name="module_name"/></td>
        <td>
            板块名称不得为空,最大不超过66字符
        </td>
    </tr>
    <tr>
        <td>排序</td>
        <td><input type="text" name="sort"/></td>
        <td>
            填写一个数字
        </td>
    </tr>

</table>
    <input style="margin-top: 10px;cursor: pointer" class="btn" type="submit" name="submit" value="添加" />
</form>
</div>


<?php include "inc/footer.inc.php";?>