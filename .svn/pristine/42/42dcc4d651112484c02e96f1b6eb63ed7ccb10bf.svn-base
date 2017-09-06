<?php
class Io {
	
	static $getNoneAllowedSuffixFile = null;//保存不被允许的文件信息
	static $dirMakeError             = null;//保存文件夹创建或有关权限失败信息
	
	/**
	 * 
	 * 远程获取数据,curl不能使用的情况下则使用file_get_content
	 * @param string $url_str 提交路径
	 * @param int $timeout 超时时间
	 */
	static function urlPost( $url_str , $timeout = 10)
	{
		if( function_exists('curl_init') ) {
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		    curl_setopt($ch, CURLOPT_URL, $url_str );
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //强制协议为1.0
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect: ')); 	   //头部要送出'Expect: '
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); 	   //强制使用IPV4协议解析域名
		    $remote_result = curl_exec($ch);
		    if (curl_errno($ch)) {$remote_result = 0;}
		    curl_close($ch);
		    return $remote_result;
		}else{
			return file_get_contents( $url_str );
		}
	}
	
	/**
	 * xml标签解析
	 * @method configXmlAnalytical
	 * @info 解析config.xml配置文件
	 * @param string $File xml文件路径
	 * @return object $xmlConfig 对象配置
	 */
	static function configXmlAnalytical( $File ){
		$xmlConfig = simplexml_load_string( file_get_contents( $File ) );
		return $xmlConfig;
	}
	
	/**
	 * 
	 * informattion内容获取(用于插件)
	 * @param string $File information路径
	 */
	static function informationAnalytical( $File ) {
		$content = file_get_contents( $File );
		return $content;
	}
	
	/**
	 * 
	 * 文件夹生成操作
	 * @method ioMkDir
	 * @info 根据参数生成对应的文件夹地址,若无法生成,则进行权限赋值，若还是无法生成,则返回错误信息
	 * @param string $dirPath 文件夹路径
	 */
	static function ioMkDir( $dirPath ) {
		if( is_dir( $dirPath ) && self::ioDirPower( $dirPath ) === true ){
			return true;
		}
		if( ! is_dir( $dirPath ) ) {
			if( ! mkdir( $dirPath ) ) {
				self::$dirMakeError = '文件夹无法生成.';
				return false;
			}
		}
		return self::ioDirPower( $dirPath );
	}
	
	/**
	 * 
	 * 文件夹权限检测
	 * @method ioDirPower
	 * @info 检测该文件夹下必须有写入权限
	 * @param string $dirPath
	 */
	static function ioDirPower( $dirPath ) {
		//是否存在
		if( ! is_dir( $dirPath ) ) {
			self::$dirMakeError = '文件夹无法生成.';
			return false;
		}
		//测试文件夹以及文件
		$tempFile = $dirPath . '/temp.txt';
		$tempDir  = $dirPath . '/tempDir';
		//检测目录是否可读
		$dir = @opendir($dirPath);
		if($dir === false){return 2;}
		if(@readdir($dir) !== false){
			
		}else{
			self::$dirMakeError = '文件夹不可读.';
			return false;
		}
		//检测是否可写
		$fp = @fopen($tempFile, 'wb');
		if($fp === false){return 3;}
		if(@fwrite($fp,'directory access testing..') !== false){
			
		}else{
			self::$dirMakeError = '文件夹不可写.';
			return false;
		}
		//赋值最高权限
		@chmod($dirPath, 0777);
		@chmod($tempDir, 0777);
		//检测是否允许创建子目录
		if(@!mkdir($tempDir)){return 6;}
		//检测是否允许删除目录
		if(!rmdir($tempDir)){
			self::$dirMakeError = '文件夹无法删除.';
			return false;
		}
		return true;
	}
	
	/**
	 * 遍历目录操作
	 * @method getTempDirList
	 * @info 通过递归的方法获取某个文件夹下所有的文件列表
	 * @param string $path 文件夹路径
	 */
	static function getDirList( $path ){
		$tplHander = opendir( $path );
		$tplArrays = array();
		$key       = 0;
		while(( $file = readdir( $tplHander )) !== false) {
			switch($file){
				case '.' :continue;break;
				case '..':continue;break;
				default:
					$fileName = $path . $file;
					if( is_dir( $fileName ) ) {
						$xmlFile         = $fileName . '/config.xml';
						$informationFile = $fileName . '/information.json';
						if( file_exists( $xmlFile ) || file_exists( $informationFile ) ) {
							$tplArrays[ $key ]['dir'] = $fileName;
								if( file_exists( $xmlFile ) ){
									$tplArrays[ $key ]['xml'] = $xmlFile;
								}
								if( file_exists( $informationFile ) ){
									$tplArrays[ $key ]['information'] = $informationFile;
								}
							$key++;
						}
					}
				break;
			}
		}
		return $tplArrays;
	}
	
	/**
	 * 目录删除操作
	 * @method tempLateDirDelete
	 * @info 通过递归的方法删除某个文件夹下的所有的文件夹以及文件
	 * @param string $path 文件夹路径
	 */
	static function DirDelete( $dir ){
		$dh = opendir( $dir );
		while ($file=readdir($dh)) {
			if($file!="." && $file!=".." && $file!= ".svn") {
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)) {
					@chmod($fullpath, 0777);
					@unlink( $fullpath );
				}else{
					self::DirDelete( $fullpath );
				}
			}
		}
		closedir( $dh );
		@chmod( $dir , 0777);
		@rmdir( $dir );
		return true;
	}
	
	/**
	 * 目录复制操作
	 * @method tempLateDirCopy
	 * @info 文件夹复制操作,复制文件以及下面的文件夹
	 * @param string $src 源文件夹
	 * @param string $dst 目标文件夹
	 * @return boolean
	 */
	static function DirCopy( $src , $dst ) {
	    $dir = opendir($src);
	    @mkdir($dst);
	    while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' ) && $file!= ".svn") {
	            if ( is_dir($src . '/' . $file) ) {
	                self::DirCopy($src . '/' . $file,$dst . '/' . $file);
	            }
	            else {
	                @copy($src . '/' . $file,$dst . '/' . $file);
	            }
	        }
	    }
	    closedir($dir);
	    return true;
	}
	
	/**
	 * 
	 * 检测目录内是否包含不被允许的后缀文件
	 * @param string $DirPath 目录
	 * @param string $NoneAllowedSuffixFile 不允许后缀 (以小写逗号隔开)
	 * @return 全部检测通过返回true,否则返回错误数组(包含文件名与后缀)
	 */
	
	static function NoneAllowedSuffixFile( $DirPath , $NoneAllowedSuffixFile ) {
		if( $DirPath == '' || $NoneAllowedSuffixFile == '' || ! is_string( $NoneAllowedSuffixFile ) ){
			return false;
		}
		if(is_dir($DirPath)){
	     	if ($dh = opendir($DirPath)) 
			{
	        	while (($file = readdir($dh)) !== false)
				{
	     			if((is_dir($DirPath."/".$file)) && $file!="." && $file!=".." && $file != ".svn")
					{
	     				self::NoneAllowedSuffixFile($DirPath."/".$file."/",$NoneAllowedSuffixFile);
	     			}
					else
					{
	         			if($file!="." && $file!=".." && $file != ".svn")
						{
							$NoneSuffixFile = explode( ',', strtolower( $NoneAllowedSuffixFile ) );
							$extension      = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
							if(in_array($extension, $NoneSuffixFile)){
								self::$getNoneAllowedSuffixFile[] = array(
									'file'   => $file,
									'suffix' => $extension
								);
							}
	      				}
	     			}
	        	}
	        	closedir($dh);
	     	}
   		}
	}
	
	/**
	 * 
	 * 获取当前服务器允许上传的最大限制
	 */
	static function getApachePostMaxValue() {
		return ini_get('post_max_size');
	}
}
?>