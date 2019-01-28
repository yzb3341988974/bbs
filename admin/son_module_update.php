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

$arr['title']="子版块修改页";
$link=connect();
if (!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('son_module.php','error','id参数错误');
}


$query="select *from yzb_son_module where id={$_GET['id']}";
$result=execute($link,$query);
if (!mysqli_num_rows($result)){//判断是否存在
    skip('son_module.php','error','子板块不存在');
}

if (isset($_POST['submit'])){
    $check='update';
    include "inc/check_son_module.php";//验证
    $query="update yzb_son_module set father_module_id={$_POST['father_module_id']},module_name='{$_POST['module_name']}',info='{$_POST['info']}',member_id={$_POST['member_id']},sort={$_POST['sort']} where id={$_GET['id']}";
    // var_dump($query);
    //exit();
    execute($link,$query);
    if (mysqli_affected_rows($link)==1){
        skip('son_module.php','ok','恭喜你修改成功');
    }
    else{
        skip('son_module.php','error','修改失败');

    }

}

$data=mysqli_fetch_assoc($result);
//var_dump($data);
//exit();
?>
<?php include "inc/header.inc.php";?>
<div id="main" style="height:1000px;">
    <div class="title">修改子版块 - <?php echo " {$data['module_name']}";?></div>
    <form method="post">
        <table class="au" style="margin-top: 20px">
            <tr>
                <td>所属父板块</td>
                <td>
                    <select name="father_module_id">
                        <option value="0">请选择一个父板块</option>
                        <?php
                        $query1="select *from yzb_father_module";
                        $result_father=execute($link,$query1);
                        while ($data1=mysqli_fetch_assoc($result_father)){
                            if ($data['father_module_id']==$data1['id']) {
                                echo "<option  selected='selected' value='{$data1['id']}'>{$data1['module_name']}</option>";

                            }
                            else{
                                echo "<option   value='{$data1['id']}'>{$data1['module_name']}</option>";

                            }
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
                <td><input type="text" value="<?php echo "{$data['module_name']}";?>"  name="module_name" /></td>
                <td>
                    板块名称不得为空,最大不超过66字符
                </td>
            </tr>



            <tr>
                <td>版块简介</td>
                <td>
                    <textarea name="info" ><?php echo $data['info']; ?></textarea>
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
                <td><input type="text" value="<?php echo $data['sort']; ?>" name="sort"/></td>
                <td>
                    填写一个数字
                </td>
            </tr>


        </table>
        <input style="margin-top: 10px;cursor: pointer" class="btn" type="submit" name="submit" value="修改" />
    </form>

</div>


<?php include "inc/footer.inc.php";?>
