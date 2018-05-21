<?php
header("content-Type: text/html; charset=gb2312");//输出编码GBK
include_once 'core.php';
include_once 'excel.php';
$stime=microtime(true);
$object = trim($_POST['object']);
$obj_title = trim($_POST['obj_title']);
//所需查询的项目文件
$file = $object_dir."/".$object.".xls";
//获取文件字符串编码,并将UTF-8转为GBK
$file = charaget($file);
//判断是否存在文件，若不存在，则将GBK转为UTF-8
if(!file_exists($file)){
    $file = charaset($file);
}
if(!file_exists($file)){
    webalert("请检查目录下是否存在该数据文件！");
}
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read($file);
echo "<div class='content'>";
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
    if($i=="1"){
        $iaa=0;
        $iab=0;
        $io=0;
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
            $taba = ''.$data->sheets[0]['cells'][$i][$j].'';
            $taba = iconv('UTF-8', 'GB2312', $taba);
            $io++;
            if($taba==$res){
                $iaa=$io;
            }
        }
        if(strlen($iaa)<1){   //if($iaa){
            webalert('请检查Excel数据第1行是否存在【'.$tiaojian1.'】字段!');
        }else{
            echo "<!--'.$res.'='.$iaa.'-->\r\n";
        }
        echo "\r\n";
    }else{
        $Excelx=$data->sheets[0]['cells'][$i][$iaa];
        $Excelx=iconv('UTF-8', 'GB2312', $Excelx);
        if("_".$obj_title=="_".$Excelx){
            echo "<!-- $obj_title == $Excelx -->\r\n";
            $iab++;
            echo '<table cellspacing="0" class="layui-table">';
            echo "<caption align='center'>查询结果 $iab</caption>";
            for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
                $tabe = ''.$data->sheets[0]['cells']['1'][$j].'';
                $tabe = iconv('UTF-8', 'GB2312', $tabe);
                $tabu = ''.$data->sheets[0]['cells'][$i][$j].'';
                $tabu = iconv('UTF-8', 'GBK', $tabu);
                echo '<tr>';
                echo '<td class="r">'.$tabe.'</td>';
                echo '<td class="span">'.$tabu.'</td>';
                echo "</tr>\r\n";
            }
            echo '</table>';

        }

    }
}

if($iab<1){
    echo '<table cellspacing="0" class="layui-table">';
    echo "<caption align='center'>查询结果 不存在</caption>";
    echo '<tr>';
    echo "<td colspan='2'>没有查询到 $res=$obj_title 的相关信息哦</td>";
    echo "<td><button class='layui-btn layui-btn-warm' onclick=\"javascript:window.history.go(-1);\">返回</button></td>";
    echo "</tr>\r\n";
    echo '</table>';
}else{
    echo '<button class="layui-btn layui-btn-normal" style="margin-left:200px;" onclick="javascript:window.print(); ">预览并打印</button>';
    echo '<button class="layui-btn layui-btn-warm" style="margin-left:50px;" onclick="javascript:window.history.go(-1);">返回</button>';
    echo "</div>";
}

echo '<!--endprint-->';
//fclose($file);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jQuery.js"></script>
    <script src="layui/layui.js"></script>
    <script src="layer/layer.js"></script>
    <link rel="stylesheet" href="layer/theme/default/layer.css" />
    <link rel="stylesheet" href="layui/css/layui.css" />
    <title>成绩查询结果</title>
    <style>
        .content{
            width:600px;
            max-height:2000px;
            margin:20px auto;
            border:1px solid #D8D8D8;
            box-shadow:1px 1px 15px #C3C3C3;
            background:#fff;
        }
        .title{
            width:600px;
            height:35px;
            background:#4ab2ff;
            line-height:35px;
            text-align:center;
            font-size:15px;
            color:#fff;
            margin-bottom:15px;
        }
    </style>
</head>
<body>
</body>
</html>
