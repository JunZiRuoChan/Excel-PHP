<?php
include_once 'core.php';
date_default_timezone_set("PRC");
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
    <title>PHP读取Excel</title>
    <style>
        .content{
            width:600px;
            max-height:500px;
            margin:100px auto;
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
        #res{
            width:300px;
            margin-left:150px;
            margin-top:15px;
            margin-bottom:15px;
        }
        #verifyId{
            width:300px;
            margin-left:150px;
        }
        #sub{
            margin-left:267px;
        }
        #object{
            width:300px;
            height:36px;
            margin-left:150px;
            display:inline-block;
            color:#757575;
            position:relative;
            cursor:pointer;
        }
        .layui-edge{
            right: 35px;
            top: 50%;
            margin-top: 2px;
            cursor: pointer;
            border-width: 6px;
            border-top-color: #c2c2c2;
            border-top-style: solid;
            transition: all .3s;
            -webkit-transition: all .3s;
            -moz-transition: all .3s;
            -ms-transition: all .3s;
        }
        #verifyId{
            display:inline-block;
        }
        #codes{
            display:inline-block;
            width:50px;
            height:20px;
        }
    </style>
</head>
<body>
<div class="content">
    <p class="title"><?php echo $title;?></p>
    <form action="result.php" method="post" class="layui-form">
        <div class="layui-form-item">
            <select name="object" id="object" class="layui-select layui-input" autocomplete="off">
                <?php traverse($object_dir.'/')?>
            </select>
            <i class="layui-edge"></i>
        </div>
        <?php if($is_verify == 1){?>
        <div class="layui-form-item">
            <input type="text" name="obj_title" id="res" required  lay-verify="required" placeholder="请输入<?php echo $res?>" autocomplete="off" class="layui-input">
        </div>
        <?php }?>
        <div class="layui-form-item">
            <input type="text" name="verify" lay-verify="required" required placeholder="请输入验证码" id="verifyId" autocomplete="off" class="layui-input" onblur="checkVerify();"/>
            <img src="verify.php?t=<?php echo date('Y-m-d-H-i-s',time());?>" alt="" id="codes" onclick = "this.src='verify.php?t='+new Date();">
        </div>
        <div class="layui-form-item">
            <input type="submit" value="查询" id="sub" class="layui-btn layui-btn-normal"/>
        </div>
    </form>

</div>
</body>
<script>
    if(window.name != "bencalie"){
        location.reload();
        window.name = "bencalie";
    }
    else{
        window.name = "";
    }
    function checkVerify(){
        var verifyId = $('#verifyId').val();
        if(!verifyId){
            layer.msg('请填写验证码！');
            $('#sub').attr('disabled',true);
        }else{
            $.ajax({
                url:'check.php',
                type:'post',
                data:{'verifyId':verifyId},
                success:function(msg){
                    if(msg=='0'){
                        layer.msg('验证码错误！');
                        $('#sub').attr('disabled',true);
                        $('#sub').css('background','#ccc');
                    }else{
                        $('#sub').attr('disabled',false);
                        $('#sub').css('background','#4ab2ff');
                    }
                }
            })
        }
    }
</script>
</html>