<?php
header("content-Type: text/html; charset=gb2312");//�������GBK
include_once 'core.php';
include_once 'excel.php';
$stime=microtime(true);
$object = trim($_POST['object']);
$obj_title = trim($_POST['obj_title']);
//�����ѯ����Ŀ�ļ�
$file = $object_dir."/".$object.".xls";
//��ȡ�ļ��ַ�������,����UTF-8תΪGBK
$file = charaget($file);
//�ж��Ƿ�����ļ����������ڣ���GBKתΪUTF-8
if(!file_exists($file)){
    $file = charaset($file);
}
if(!file_exists($file)){
    webalert("����Ŀ¼���Ƿ���ڸ������ļ���");
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
            webalert('����Excel���ݵ�1���Ƿ���ڡ�'.$tiaojian1.'���ֶ�!');
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
            echo "<caption align='center'>��ѯ��� $iab</caption>";
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
    echo "<caption align='center'>��ѯ��� ������</caption>";
    echo '<tr>';
    echo "<td colspan='2'>û�в�ѯ�� $res=$obj_title �������ϢŶ</td>";
    echo "<td><button class='layui-btn layui-btn-warm' onclick=\"javascript:window.history.go(-1);\">����</button></td>";
    echo "</tr>\r\n";
    echo '</table>';
}else{
    echo '<button class="layui-btn layui-btn-normal" style="margin-left:200px;" onclick="javascript:window.print(); ">Ԥ������ӡ</button>';
    echo '<button class="layui-btn layui-btn-warm" style="margin-left:50px;" onclick="javascript:window.history.go(-1);">����</button>';
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
    <title>�ɼ���ѯ���</title>
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
