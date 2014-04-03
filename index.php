<?php
(isset($_POST['title']) && isset($_POST['content'])) ? gen() : index();
function gen() {
include 'include/xn_markdown.class.php';
include 'include/xn_zip.class.php';
$title = $_POST['title'];
$ct = $_POST['content'];
$ct = xn_markdown::markdown2html($ct);
$ct = str_replace("<h2>","</div></div><div><div><h2>",$ct);
$ct = substr($ct,12) . '</div></div>';
$ct = preg_replace("/\[media:(.*)\.(.*)\]/",'<embed src="media/\\1.\\2" autostart="false" />',$ct);
$tpl = file_get_contents("tpl/qts-default.htm");
$tpl = str_replace('{slide_title}',$title,$tpl);
$tpl = str_replace('{content}',$ct, $tpl);
file_put_contents("build/index.hta",$tpl);
xn_zip::zip("tmp/build.zip","build");
echo '
已经生成完毕，请点击下面链接下载：
<a href="./tmp/build.zip">下载生成后的幻灯片</a>
';
}


function index() {
echo '
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>qt-slider</title>

<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slide.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-mb-12">
<h1>qt-slider</h1>
<div class="qts_form">
<form action="index.php" method="post">
<p><label for="title">标题</label><input type="text" id="title" name="title" /></p>
<p><label for="content">内容</label><textarea id="content" name="content"></textarea></p>
<p><input type="submit" value="开始生成幻灯片" /></p>
<p>QT-SLIDER采用markdown作为编写语法，同时增加了几个自定义标签。在编写幻灯片源文件的时候，遵循下面几条原则：</p>

<ul>
<li>每一张幻灯片的标题使用二级标题，也就是两个警号</li>
<li>[media:媒体文件名]，用来插入媒体文件（声音或者视频）</li>
<li>媒体文件存放到media目录下</li>
<li>图片文件建议存放在img目录下</li>
</ul>

<p>有关markdown语法可打开下面链接学习：<a href="http://markdown.tw/">markdown</a></p>
</form>
</div><!--/qts_form--></div><!--/col-mb-12-->
</div><!--/row-->
</div><!--/container-->
<div class="footer">
<p>由<a href="http://github.com/qt06/qt-slider" target="_blank">QT-SLIDER</a>提供支持。</p>
</div><!--/footer-->
</body>
</html>
';
}
