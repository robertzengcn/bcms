<?php
	if( isset( $_REQUEST['name'] ) && $_REQUEST['name'] != '' ){
		$productName = trim( $_REQUEST['name'] );
	}else{
		$productName = '';
	}
	$dir      = $_REQUEST['dir'];//upload下面的上传dir文件夹
	$from     = $_REQUEST['from']; //区别手机端
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../css/H-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/H-ui.admin.css" rel="stylesheet" type="text/css" />
		<link href="../css/boyicms/common.css" rel="stylesheet" type="text/css" />
		<link href="../lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
        <script src="../lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function setDownloaded(fileSize, downlen, newFile) {
                var c = Math.round((downlen / fileSize) * 100);
                $('span.sr-only').css('width', c + '%');
                $("span#load_span").html((Math.round(downlen / 1024)) + "kb / " + (Math.round(fileSize / 1024)) + "kb");
                //下载完成
                if (fileSize == downlen) {
                    $('div#down_ok').show();
                    $("span#load_span").html('下载完成');
                    $('#newFile').val(newFile);
                }
            }
            function install() {
                var newFile = $('#newFile').val();
                var type = '<?php echo $dir; ?>';
                var from = '<?php echo $from; ?>';
                if (type == 'template') {
                    if (from == 'mobile') {
                    	window.parent.gMobile.productInstall(newFile,'<?php echo $dir; ?>','<?php echo $from; ?>');
                    } else {
                    	window.parent.gTemplate.productInstall(newFile,'<?php echo $dir; ?>');
                    }
                	
                } else if (type == 'topic') {
                	window.parent.gTopic.productInstall(newFile,'<?php echo $dir; ?>');
                } else if (type == 'plugin') {
                	window.parent.gPlugin.productInstall(newFile,'<?php echo $dir; ?>');
                }
            }
            function install_ok() {
                $("#down_ok").html('已完成产品安装!');
            }
            function zipFile(flag){
				switch( flag ){
					case 'nozipFile':
						$("span#load_span").html('产品路径缺失');
					break;
					case 'urlError':
						$("span#load_span").html('产品路径错误');
					break;
				}
            }
        </script>
    </head>
    <body>
		<div class="pd-10">
			<div class="row cl pd-5">“<?php echo $productName; ?>“，<span id="load_span"></span></div>
			<div class="row cl pd-5"><div class="progress" style="margin:0 auto;"><div class="progress-bar"><span class="sr-only" style="width:0%;"></span></div></div></div>
			<div class="row cl pd-5"><div style="margin:10px 0 0 0;display:none;font-size:12px;" id="down_ok">
				<input type="hidden" id="newFile" />
				下载已完成,是否立即安装?&nbsp;&nbsp;<button onClick="install();" class="btn btn-success radius bt-normal" type="button"><i class="Hui-iconfont">&#xe63c;</i> 立即安装</button>
			</div></div>
		</div>
    </body>
</html>
<?php
require '../../web-setting.php';
if( !isset( $_REQUEST['zipFile'] ) || $_REQUEST['zipFile'] == '' ){
	echo "<script>zipFile('nozipFile');</script>";exit;
}
$url      = $_REQUEST['zipFile'];
if( ! is_dir( GENERATEPATH . 'upload/'.$dir.'/' ) ){
	@mkdir( GENERATEPATH . 'upload/'.$dir.'/' );
}
$newfname = GENERATEPATH . 'upload/'.$dir.'/' . md5(time()) . '.zip';
$newfname = str_replace('\\','/',$newfname);
$file = @fopen($url, "rb");
if ($file) {
    $filesize = -1;
    $headers = get_headers($url, 1);
    if ((!array_key_exists("Content-Length", $headers))) {
        $filesize = 0;
    }
    $filesize = $headers["Content-Length"];
    if ($filesize != -1)
        $newf = fopen($newfname, "wb");
    $downlen = 0;
    if ($newf)
        while (!feof($file)) {
            $data = fread($file, 1024 * 8);
            $downlen+=strlen($data);
            fwrite($newf, $data, 1024 * 8);
            echo "<script>setDownloaded($filesize,$downlen,'" . $newfname . "');</script>";
            ob_flush();
            flush();
        }
}else{
	echo "<script>zipFile('urlError');</script>";exit;
}
if ($file) {
    fclose($file);
}
if ($newf) {
    fclose($newf);
}
?>