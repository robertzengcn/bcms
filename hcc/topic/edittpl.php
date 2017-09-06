<?php
require_once '../../web-setting.php';
?>
<meta charset="utf-8" xmlns="http://www.w3.org/1999/html">
<html>
<head>
    <title>修改专题模板</title>
    <script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script>
    <style type="text/css">
        #submit{
             margin:20px 0 0 0;border: 0;width: 70px;height: 35px;background-color: #0099FF;
        }
        #back{
            margin:20px 0 0 50px;border: 0;width: 70px;height: 35px;background-color: #838383;
        }
        .button1{
            width:100%;height:100px;float: left;margin: 0;padding: 0;text-align: center;
        }
    </style>
</head>
<body style="text-align: center">
<div style="margin:0">
    <form  action="savetpl.php" method="post">
    <textarea check="must" id="editor" class="ckeditor" name="text1" style="width: 100%;min-height: 500px;margin:0">
        <?php
        $src = $_REQUEST['src'];
        $src = stripcslashes($src);
        if(file_exists($src)){
            $contents = file_get_contents($src);
            echo $contents;
        }else{
            echo '获取模板文件内容出现问题，请确认文件是否存在或返回重试!';
        }
        ?>
    </textarea>
    <input type="hidden" id="src1" name="src1" value="<?php echo $src ?>"></br>
        <div class="button1">
    <input type="submit" id="submit" value="保存模板">
    <input type="button" id="back" value="返回">
        </div>
    </form>
</div>

<script type="text/javascript">
    $(function(){
        $('#back').click(function(){
           window.close();
        });
    })
</script>
</body>
</html>
