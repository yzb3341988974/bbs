<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/26 0026
 * Time: 下午 3:28
 */
function skip($url,$pic,$message){
    $html=<<<a
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;url='{$url}'">
<title>正在跳转中</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span> {$message},<a href="father_module.php">3秒后跳转</a></div>
</body>
</html>
a;

echo $html;
exit();
}

?>


