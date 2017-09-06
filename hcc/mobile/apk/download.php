<?php
	if( isset( $_REQUEST['name'] ) && $_REQUEST['name'] != '' ){
		$productName = trim( $_REQUEST['name'] );
	}else{
		$productName = '';
	}
	$apkname  = basename($_REQUEST['apkFile']);
	$dir      = $_REQUEST['dir'];//upload下面的上传dir文件夹
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../../css/H-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="../../css/H-ui.admin.css" rel="stylesheet" type="text/css" />
		<link href="../../css/boyicms/common.css" rel="stylesheet" type="text/css" />
		<link href="../../lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../lib/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../lib/layer/1.9.3/layer.js"></script> 
        <script type="text/javascript" src="../../js/H-ui.js"></script> 
        <script type="text/javascript" src="../../js/H-ui.admin.js"></script> 
        <script type="text/javascript" src="../../js/boyicms/common.js"></script>
        <script type="text/javascript" src="../../js/boyicms/apk.js"></script>
        <script type="text/javascript">
            function setDownloaded(fileSize,downlen,newFile) {
                var c = Math.round((downlen / fileSize) * 100);
                $('span.sr-only').css('width', c + '%');
                $("span#load_span").html((Math.round(downlen / 1024)) + "kb / " + (Math.round(fileSize / 1024)) + "kb");
                //下载完成
                if (fileSize == downlen) {					 	
                	 $('div#down_ok').show();
                     $("span#load_span").html('下载完成');
                     $('#newFile').val(newFile);
                     layer.confirm('APK己下载到您的服务器，是否要生成二维码？', {zIndex:1}, function(index){
                  		 window.parent.gApk.uploadQr('app','download',newFile);
                  		 layer_close();
                     });
                }
                
            }
            function install() {
                layer.confirm('现在就去生成二维码？', function(index){
                	window.parent.gApk.uploadQr('app','download','');
                	layer_close();
                });
            }
            function apkFile(flag){
				switch( flag ){
					case 'noapkFile':
						$("span#load_span").html('apk路径缺失');
					break;
					case 'urlError':
						$("span#load_span").html('apk路径错误');
					break;
				}
            }
        </script>
    </head>
    <body>
		<div class="pd-10"  id="download">
			<div class="row cl pd-5">“<?php echo $productName; ?>“，<span id="load_span"></span></div>
			<div class="row cl pd-5"><div class="progress" style="margin:0 auto;"><div class="progress-bar"><span class="sr-only" style="width:0%;"></span></div></div></div>
			<div class="row cl pd-5"><div style="margin:10px 0 0 0;display:none;font-size:12px;" id="down_ok">
				<input type="hidden" id="newFile" />
				下载已完成!
			</div></div>
		</div>
    </body>
</html>
<?php
require '../../../web-setting.php';
if( !isset( $_REQUEST['apkFile'] ) || $_REQUEST['apkFile'] == '' ){
	echo "<script>apkFile('noapkFile');</script>";exit;
}
$url      = $_REQUEST['apkFile'];
if( ! is_dir( GENERATEPATH . $dir.'/' ) ){
	@mkdir( GENERATEPATH . $dir.'/' );
}
$newfname = GENERATEPATH . $dir.'/' . $apkname;
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
            echo "<script>setDownloaded(".$filesize.",".$downlen.",'".$newfname."');</script>";
            ob_flush();
            flush();
        }
}else{
	echo "<script>apkFile('urlError');</script>";exit;
}
if ($file) {
    fclose($file);
}
if ($newf) {
    fclose($newf);
}
?>