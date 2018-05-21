<?php
error_reporting(E_ALL);
header("content-Type: text/html; charset=gb2312");//输出编码GBK
$res = '姓名';
$title = 'XX学校综合查询';
$object_dir = "data";
$is_verify = 1;
function traverse($dir_name = '.'){
    $dir = opendir($dir_name);
    $basename = basename($dir);
    $fileArr = array();
    while($filename = readdir($dir)){
        if(($filename==".")||($filename=="..")){

        }else if(is_dir($filename)){

        }else{
            $filetp = substr($filename,-4);
            $filetp = strtolower($filetp);
            $filesw = substr($filename,0,-4);
            if($filetp=='.xls'){
                $file = charaget($filesw);
                echo '<option value="'.trim($file).'">'.trim($file).'</option>';
            }
        }
    }
    closedir($dir);
}
function webalert($msg){
    $html="<script>\r\n";
    $html.="layer.msg('".$msg."');\r\n";
    $html.="</script>";
    exit($html);
}
function charaset($data){
    if(!empty($data) ){
        $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
        if( $fileType != 'UTF-8'){
            $data = mb_convert_encoding($data ,'utf-8' , $fileType);
        }
    }
    return $data;
}
function charaget($data){
    if(!empty($data) ){
        $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
        if( $fileType != 'GBK'){
            $data = mb_convert_encoding($data ,'GBK' , $fileType);
        }
    }
    return $data;
}