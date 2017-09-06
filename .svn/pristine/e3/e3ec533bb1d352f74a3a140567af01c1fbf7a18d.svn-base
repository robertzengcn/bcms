<?php
/**
 * 产生一个随机的字符串
 */
function getChar($type = 3 ,$leng = 4){
	if ($type == 1)$char = '0123456789';
	if ($type == 2)$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if ($type == 3)$char = '01234156789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$char = str_shuffle($char);
	return substr($char, 0,$leng);
}

function getVerify($type = 3,$leng = 4,$verify = 'verify'){
	//开启session
	session_start();
	//先产生随机的字符，将其放入session中
	$str = getChar($type,$leng);
	$_SESSION[$verify] = $str;
	//产生验证码图片，首先要改变headr类型
	header('content-Type:image/gif');
	//确定图片的宽度，高度
	$width = 100;
	$height = 40;
	//创建图片
	$image = imagecreatetruecolor($width, $height);
	//在图片的上绘制一个白色的填充实体的矩形
	$white = imagecolorallocate($image, 255, 255, 255);
	imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
	//创建一个字体文件名的数组
	$fontfile = array('./ttf/ANTQUAB.TTF','./ttf/ariblk.ttf','./ttf/BKANT.TTF','./ttf/cour.ttf','./ttf/courbd.ttf','./ttf/GARA.TTF','./ttf/GARABD.TTF','./ttf/GOTHIC.TTF','./ttf/GOTHICB.TTF');
	//将字符串填入到图片中
	$x = mt_rand(3, 8);
	for ($i=0;$i<$leng;$i++){
		$size = mt_rand(18, 22);
		$angle = mt_rand(-15, 35);
		$y = mt_rand(20, 30);
		$color = imagecolorallocate($image, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
		//imagestring($image, 5, $x, $y, substr($str, $i,1), $color);
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile[mt_rand(0, count($fontfile)-1)], substr($str, $i,1));
		$x += mt_rand(18, 24);
	}
	//在图片中加入黑点
	$black = imagecolorallocate($image, 0, 0, 0);
	for ($i=0;$i<=100;$i++){
		imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), $black);
	}
	//在图片中加入线条
	for ($i=0;$i<5;$i++){
		$color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(100, 200), mt_rand(0, 120));
		imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $color);
	}
	//输出图片
	imagegif($image);
	//销毁图片
	imagedestroy($image);
}

getVerify();