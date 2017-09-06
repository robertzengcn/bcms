<meta charset="utf-8">
<?php
    $text=$_REQUEST['text1'];
    $src = $_POST['src1'];
    if(!file_exists($src)){
        echo '<script>alert("模板保存失败");window.history.back()</script>';
    }else{
        if(file_put_contents($src,$text)){
            echo '<script>alert("模板修改成功");window.close()</script>';
        }else{
            echo '<script>alert("模板保存失败");window.history.back()</script>';
        }
    }

?>