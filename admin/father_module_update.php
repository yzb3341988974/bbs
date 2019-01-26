<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/26 0026
 * Time: 下午 6:09
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if (!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('father_module.php','error','id参数错误');

}
$link=connect();
$query="select *from yzb_father_module where id={$_GET['id']}";
$result=execute($link,$query);
if (!mysqli_num_rows($result)){//判断是否存在
    skip('father_module.php','error','板块不存在');

}
if (isset($_POST['submit'])){
    $check='update';
    include "inc/check_father_module.php";//验证
    $query="update yzb_father_module set module_name='{$_POST['module_name']}',sort='{$_POST['sort']}' where id={$_GET['id']}";
    execute($link,$query);
    if (mysqli_affected_rows($link)==1){
        skip('father_module.php','ok','恭喜你修改成功');
    }
    else{
        skip('father_module.php','error','修改失败');

    }
}


$data=mysqli_fetch_assoc($result);


?>
<?php $arr['title']='父板块修改页';?>
<?php include 'inc/header.inc.php';?>
    <div id="main" style="height:1000px;">
        <div class="title">修改父板块- <?php echo $data['module_name'];?></div>
        <form method="post">
            <table class="au" style="margin-top: 20px">
                <tr>
                    <td>版块名称</td>
                    <td><input type="text" name="module_name" value="<?php echo $data['module_name'];?>"/></td>
                    <td>
                        板块名称不得为空,最大不超过66字符
                    </td>
                </tr>
                <tr>
                    <td>排序</td>
                    <td><input type="text" name="sort" value="<?php echo $data['sort'];?>"/></td>
                    <td>
                        填写一个数字
                    </td>
                </tr>

            </table>
            <input style="margin-top: 10px;cursor: pointer" class="btn" type="submit" name="submit" value="修改" />
        </form>
    </div>




<?php include "inc/footer.inc.php";?>