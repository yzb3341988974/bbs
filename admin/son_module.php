
<?php $arr['title']='子板块列表页';?>
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

//var_dump(mysqli_fetch_all($result,MYSQLI_ASSOC));
if (isset($_POST['submit'])) {
    foreach ($_POST['sort'] as $key => $val) {
        //var_dump($key);
        //var_dump($val);
        //exit();
        if (!is_numeric($key) || !is_numeric($val)) {
            skip('son_module.php', 'error', '请输入数字');
        }
        $query[] = "update yzb_son_module set sort={$val} where id={$key}";
    }
    if (execute_multi($link, $query, $error)) {
        skip('son_module.php', 'ok', '排序修改成功');
    } else {
        skip('son_module.php', 'error', $error);

    }
}
//var_dump(mysqli_fetch_all($result,MYSQLI_ASSOC));

?>
<?php include 'inc/header.inc.php';?>
<div id="main" style="height:1000px;">
    <div class="title">子板块列表</div>
    <form method="post">
    <table class="list">
        <tr>
            <th>排序</th>
            <th>版块名称</th>
            <th>所属父板块</th>
            <th>版主</th>
            <th>操作</th>
        </tr>
        <?php
        $query="select id1.sort sort,id1.id id,id1.module_name module_name,id1.member_id member_id,id2.module_name father_module_name from yzb_son_module id1,yzb_father_module id2 where id1.father_module_id=id2.id order by id2.id";
        $result=execute($link,$query);
        while ($data=mysqli_fetch_assoc($result)){
            //var_dump($data);
            // father_module_delete.php?id={$data['id']}
            $url=urlencode("son_module_delete.php?id={$data['id']}");//对url进行字符编码  _GET会对url进行自动解码
            $return_url=urlencode($_SERVER['REQUEST_URI']);//当前页面地址
            $message="{$data['module_name']}";
            $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
            $html=<<<a
            <tr>
            <td><input class="sort" type="text" name="sort[{$data['id']}]" value="{$data['sort']}"/></td>
            <td>{$data['module_name']}[id:{$data['id']}]</td>
            <td>{$data['father_module_name']}</td>
            <td>{$data['member_id']}</td>
            <td><a href="#">[访问]</a>&nbsp;&nbsp;<a href="son_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="$delete_url">[删除]</a></td>
            </tr>
a;
            echo $html;
        }
        ?>


    </table>
    <input style="margin-top: 10px;cursor: pointer" class="btn" type="submit" name="submit" value="排序" />
    </form>
</div>
<?php include "inc/footer.inc.php";?>