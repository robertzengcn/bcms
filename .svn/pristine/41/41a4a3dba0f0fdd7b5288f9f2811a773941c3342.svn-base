<?php $img = explode(',', $_REQUEST['img']);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>图片导航</title>
    <link href="../public/css/readme.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.easing.1.3.js"></script>
</head>
<body>
<style type="text/css">
    /* ie6 png */
    .mypng img {
        azimuth: expression( this.pngSet?this.pngSet=true:(this.nodeName == "IMG" && this.src.toLowerCase().indexOf('.png')>-1?(this.runtimeStyle.backgroundImage = "none", this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')", this.src = "transparent.gif"):(this.origBg = this.origBg? this.origBg :this.currentStyle.backgroundImage.toString().replace('url("', '').replace('")', ''), this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='crop')", this.runtimeStyle.backgroundImage = "none")), this.pngSet=true);
    }
</style>
<div id="focusBar" style="z-index: 20">
    <a href="javascript:void(0)" class="arrL" onclick="prePage()">&nbsp;</a>
    <a href="javascript:void(0)" class="arrR" onclick="nextPage()">&nbsp;</a>
    <ul class="mypng">
    	<?php 
    		$html = '';
	    	foreach($img as $key => $value){
	    		if($value != ''){
	    			$html .= '<li id="focusIndex'.($key+1).'"  repeat-x;">
        				<div class="focus"><img src="'.$value.'" width="800px" height="500px" /></a></div>
        				</li>';
	    			}	
	    	}
	    	if($html!=''){echo $html;};
    	?>
    </ul>
</div>
<script type="text/javascript" src="../public/js/readme.js"></script>
</body>
</html>