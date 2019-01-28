<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/28 0028
 * Time: 上午 11:38
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$arr['title']="添加子板块";
$link=connect();
if (isset($_POST['submit'])){
    $check='add';
    include "inc/check_son_module.php";//验证
    $query="insert into yzb_son_module(father_module_id,module_name,info,member_id,sort) values ('{$_POST['father_module_id']}','{$_POST['module_name']}','{$_POST['info']}','{$_POST['member_id']}','{$_POST['sort']}')";
    $result=execute($link,$query);
    //var_dump($result);
    //exit();
    if (mysqli_affected_rows($link)){
        skip('son_module_add.php','ok','恭喜你添加成功');

    }
    else{
        skip('son_module_add.php','error','添加失败,请重新添加');

    }

}
?>
<?php include "inc/header.inc.php";?>
<div id="main" style="height:1000px;">
    <div class="title">添加子板块</div>
    <form method="post">
        <table class="au" style="margin-top: 20px">
            <tr>
                <td>所属父板块</td>
                <td>
                    <select name="father_module_id">
                        <option value="0">请选择一个父板块</option>
                        <?php
                        $query="select *from yzb_father_module";
                        $result_father=execute($link,$query);
                        while ($data=mysqli_fetch_assoc($result_father)){
                            echo
                            <<<a
                            <option value="{$data['id']}">{$data['module_name']}</option>;
a;
                        }


                        ?>
                    </select>
                </td>
                <td>
                    请先选择一个父板块
                </td>
            </tr>



            <tr>
                <td>版块名称</td>
                <td><input type="text" name="module_name"/></td>
                <td>
                    板块名称不得为空,最大不超过66字符
                </td>
            </tr>



            <tr>
                <td>版块简介</td>
                <td>
                    <textarea name="info"></textarea>
                </td>
                <td>
                    板块简介不得多于255字符
                </td>
            </tr>





            <tr>
                <td>版主</td>
                <td>
                    <select name="member_id">
                        <option value="0">请选择一个会员作为版主</option>
                    </select>
                </td>
                <td>
                    可以选择一个会员作为版主
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
