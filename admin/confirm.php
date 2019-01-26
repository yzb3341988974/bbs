<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/26 0026
 * Time: 下午 2:44
 */
include_once '../inc/config.inc.php';
if (!isset($_GET['message']) ||!isset($_GET['url']) ||!isset($_GET['return_url'])){
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>确认界面</title>
    <meta name="keywords" content="确认界面" />
    <meta name="description" content="确认界面" />
    <link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic ask"></span> 要删除<?php echo  $_GET['message'] ?>吗？ <a href="<?php echo  $_GET['url'] ?>" style="color: red">确认</a> <a href="<?php echo  $_GET['return_url'] ?>" style="color: green">取消</a></div>
</body>
</html>
