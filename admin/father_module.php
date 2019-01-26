
<?php $arr['title']='父板块列表页';?>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/20 0020
 * Time: 下午 4:13
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';

$link=connect();

//var_dump(mysqli_fetch_all($result,MYSQLI_ASSOC));

?>
<?php include 'inc/header.inc.php';?>
<div id="main" style="height:1000px;">
    <div class="title">父板块列表</div>

    <table class="list">
        <tr>
            <th>排序</th>
            <th>版块名称</th>

            <th>操作</th>
        </tr>
        <?php
        $query="select *from yzb_father_module";
        $result=execute($link,$query);
        while ($data=mysqli_fetch_assoc($result)){
            //var_dump($data);
           // father_module_delete.php?id={$data['id']}
            $url=urlencode("father_module_delete.php?id={$data['id']}");//对url进行字符编码  _GET会对url进行自动解码
            $return_url=urlencode($_SERVER['REQUEST_URI']);//当前页面地址
            $message="{$data['module_name']}";
            $delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
            $html=<<<a
            <tr>
            <td><input class="sort" type="text" name="sort" /></td>
            <td>{$data['module_name']}[id:{$data['id']}]</td>

            <td><a href="#">[访问]</a>&nbsp;&nbsp;<a href="father_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="$delete_url">[删除]</a></td>
            </tr>
a;
        echo $html;
        }
        ?>


    </table>


<?php include "inc/footer.inc.php";?>