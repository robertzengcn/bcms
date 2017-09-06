<?php include_once './function.php';?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>博医安装向导</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/public.css" rel="stylesheet">
    <script src="dist/js/jquery-1.9.1.min.js"></script>
    <script src="../hcc/lib/layer/1.9.3/layer.js"></script>
<style>
body .demo-class .layui-layer-title{background-color: #f8f8f8;border-bottom: 1px solid #eee;border-radius: 2px 2px 0 0;color: #333;font-size: 14px;height: 42px;line-height: 42px;overflow: hidden;padding: 0 80px 0 20px;}
body .demo-class .layui-layer-btn {-moz-user-select: none;padding: 0 10px 12px;pointer-events: auto;text-align: right;}
body .demo-class .layui-layer-btn a {background-color: #f1f1f1; border: 1px solid #dedede;border-radius: 2px;color: #333;cursor: pointer;font-weight: 400;height: 28px;line-height: 28px;margin: 6px 6px 0;padding: 0 15px;text-decoration: none;}
body .demo-class .layui-layer-btn a:hover {opacity: 0.9;text-decoration: none;}
body .demo-class .layui-layer-btn a:active {opacity: 0.8;}
body .demo-class .layui-layer-btn .layui-layer-btn0 {background-color: #2e8ded;border-color: #4898d5;color: #fff;}
body .demo-class .layui-layer-btn-l {text-align: left;}
body .demo-class .layui-layer-btn-c {text-align: center;}
body .demo-class .layui-layer-dialog {min-width: 260px;}
body .demo-class .layui-layer-dialog .layui-layer-content {font-size: 14px;line-height: 24px;overflow-x: hidden;overflow-y: auto;padding: 20px;position: relative;word-break: break-all;}
</style>
</head>
<body>
<?php 
	if( install( 'index' ) === false ){
		echo "<p>你己完成博医CMS系统的安装，如果您需要重新安装，请删除或清空./install目录下的install.txt文件</p>";
		echo "<p>如果您安装过后仍旧看到此页面，请前往：<b>后台管理中心</b>〉<b>医疗资讯管理</b>〉<b>生成页面</b>，生成下当前页面！</p>";
		echo "<p>若您偿试过上述方法，访问首页仍然会跳转到此页面，请偿试下述方法：</p>";
		echo '<p>方法一：在您当前的主域名后加“/index.html”再访问，请访问<a href="'.'http://' . $_SERVER['HTTP_HOST'].'/index.html?from=install" target="_blank">'.'http://' . $_SERVER['HTTP_HOST'].'/index.html</a>查看网站首页是否显示正常</p>';
		echo "<p>方法二：更换浏览器访问您的域名，看首页是否显示正常</p>";
		echo "<p>方法三：在其他电脑上访问您的域名，看首页是否显示正常</p>";
		echo "<p>若以上方法访问首页均正常，则是您当前使用浏览器缓存所致，清除浏览器缓存后即可正常访问</p>";
		exit;
	}
?>
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner" style="background-color: darkseagreen">
    <div class="container">
        <div class="navbar-header">
            <a href="http://www.boyicms.com" target="_blank" class="navbar-brand" style="display:inline-block;width:125px;height:60px;border:none;padding:0px;">
				<img src="dist/img/logo.jpg" width="125" height="60" style="border:none;" />
			</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation" >
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://www.boyicms.com"  target="_blank">官方网站</a></li>
                <li><a href="http://www.boyicms.com/plugins/help/online/"  target="_blank">帮助</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="container">
    <div class="row">
       <div class="col-md-3">
           <ul class="list-unstyled" >
               <li class="main-li"><div><img width="100%" id="left_img_1" src="dist/img/11.png"/></div></li>
               <li class="main-li"><div><img width="100%" id="left_img_2" src="dist/img/22.png"/></div></li>
               <li class="main-li"><div><img width="100%" id="left_img_3" src="dist/img/33.png"/></div></li>
               <li class="main-li"><div><img width="100%" id="left_img_4" src="dist/img/44.png"/></div></li>
               <li class="main-li"><div><img width="100%" id="left_img_5" src="dist/img/55.png"/></div></li>
               <li class="main-li"><div><img width="100%" id="left_img_6"  src="dist/img/66.png"/></div></li>
           </ul>
       </div>
       <div class="col-md-9">
       
           <!--第一页阅读许可协议-->
           <div id="div_1">
           <div  class="panel panel-success">
               <div class="panel-heading">阅读许可协议</div>
               <div class="panel-body">
                   <textarea style="width: 100%; height: 400px"><?php echo GetAgreeMent();?></textarea>
               </div>
               <div style="text-align: center;"><label for="isAgreement"><input style="position:relative;top:2px;" type="checkbox" id="isAgreement" name="readed" /><span>&nbsp;我已经阅读并同意此协议</span></label>&nbsp;&nbsp;&nbsp;
               <input  type="submit" class="btn btn-success" id="setp1_button_next" value="下一步"/><br>&nbsp;<br>
               </div>
           </div>
           </div>
           
           <!--第二页环境配置-->
           <div id="div_2" style="display:none;">
               <div class="panel panel-success">
                   <div class="panel-heading">服务器信息</div>
                   <div class="panel-body">
                       <table class="table table-bordered" >
                           <tr style="text-align: center;"><td>参数</td><td>值</td></tr>
                           <tr style="text-align: left;"><td>服务器域名/IP地址</td><td><?php echo GetServerInfo('SERVER_NAME');?>&nbsp;<?php echo GetServerInfo('SERVER_ADDR');?></td></tr>
                           <tr style="text-align: left;"><td>服务器信息</td><td><?php echo GetServerInfo('SERVER_SOFTWARE');?></td></tr>
                           <tr style="text-align: left;"><td>PHP版本</td><td><?php echo GetPhpVersion();?><input type="hidden" value="<?php if(version_compare(PHP_VERSION,'5.3.0','<'))  echo('530'); ?>" id="php_version" /></td></tr>
                           <tr style="text-align: left;"><td>系统安装目录</td><td><?php echo GetServerInfo('DOCUMENT_ROOT');?></td></tr>
                       </table>
                   </div>

               </div>
               <div class="panel panel-success">
                   <div class="panel-heading">系统环境检测</div>
                   <div class="panel-body">
                       <span style="color: red">系统环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</span>
                       <table class="table table-bordered" >
                           <tr style="text-align: center;"><td>需开启的变量或函数</td><td>要求</td><td>实际状态及建议</td></tr>
                           <tr style="text-align: left;"><td>curl</td><td>On</td><td><?php echo GetMethodExist('curl_init','未开启可能导致远程下载等功能失效');?></td></tr>
                           <tr style="text-align: left;"><td>file_get_contents</td><td>On</td><td><?php echo GetMethodExist('file_get_contents','未开启可能导致本地文件更新或采集失败');?></td></tr>
                       	   <tr style="text-align: left;"><td>mysql</td><td>On</td><td><?php echo GetMethodExist('mysql_connect','未开启可能导致系统无法正常链接数据库');?></td></tr>
                       	   <tr style="text-align: left;"><td>pdo</td><td>On</td><td><?php echo GetMethodExist('pdo_mysql','未开启可能导致系统无法正常访问数据库');?></td></tr>
                       	   <tr style="text-align: left;"><td>GD</td><td>On</td><td><?php echo GetMethodExist('gd_info','未开启可能导致系统无法正常进行图像处理工作');?></td></tr>
                       </table>
                   </div>

               </div>
               <div class="panel panel-success">
                   <div class="panel-heading">目录权限检测</div>
                   <div class="panel-body">
                       <span style="color: red;">系统要求必须满足下列所有的目录权限全部可读写的需求才能使用，其它应用目录可安装后在管理后台检测。</span>
                       <table class="table table-bordered" >
                           <tr style="text-align: center;"><td>目录名</td><td>读取权限</td><td>写入权限</td></tr>
                           <?php 
                           		$DirAuth = GetDirAuth();
                           		foreach ( $DirAuth as $key => $value ) {
                           ?>
                           <tr style="text-align: left;">
                           	<td><?php echo $key;?></td>
                           	<td><?php echo $value['read'];?></td>
                           	<td><?php echo $value['write'];?></td>
                           </tr>
                           <?php 
                           		};
                           ?>
                       </table>
                   </div>
               </div>

               <div style="text-align: center;">
                   <input type="submit" class="btn btn-success" id="setp2_button_prev" value="上一步"/>
                   &nbsp;&nbsp;&nbsp;
                   <input type="submit" class="btn btn-success" id="setp2_button_next" value="下一步"/><br>&nbsp;<br>
               </div>
           </div>
           
        <!--第三页参数配置-->
           <div id="div_3" style="display:none;">
           
               <div class="panel panel-success">
                   <div class="panel-heading">数据库设定</div>
                   <div class="panel-body">
                   	   <form id="FORM_DB">
	                       <table class="table">
	                           <tr><td class="td-right">数据库主机：</td><td><input class="text" type="text" name="DBHOST" value="localhost" /><span class="must_red">*</span>默认为localhost</td></tr>
	                           <tr><td class="td-right">数据库名称：</td><td><input class="text" type="text" name="DBNAME" value="boyicmsV10"/><span class="must_red">*</span></td></tr>
	                           <tr><td class="td-right">数据库用户：</td><td><input class="text" type="text" name="DBUSER" value=""/><span class="must_red">*</span></td></tr>
	                           <tr><td class="td-right">数据库密码：</td><td><input class="text" type="password" name="DBPASSWORD" value=""/><span class="must_red must_red_dbpassword" style="font-size:12px;">*</span></td></tr>
	                       </table>
                       </form>
                   </div>
               </div>

               <div class="panel panel-success">
                   <div class="panel-heading">管理员初始密码</div>
                   <div class="panel-body">
                   	   <form id="FORM_AD">
	                       <table class="table">
	                           <tr><td class="td-right">　用户名：</td><td><input class="text" type="text" name="AD_USER" value="" /><span class="must_red">*&nbsp;用户名必须以字母开头</span></td></tr>
	                           <tr><td class="td-right">　　密码：</td><td><input class="text" type="password" name="AD_PASS" value="" /><span class="must_red">*&nbsp;密码不得小于6位</span></td></tr>
	                           <tr><td class="td-right">确认密码：</td><td><input class="text" type="password" name="AD_REPASS" value="" /><span class="must_red">*&nbsp;密码不得小于6位</span></td></tr>
	                       </table>
                       </form>
                   </div>
               </div>

               <div class="panel panel-success">
                   <div class="panel-heading">网站设置</div>
                   <div class="panel-body">
                   	   <form id="FORM_HS">
	                       <table class="table">
	                           <?php 
	                           		$ContactInput = GetContactInput();
	                           		foreach ( $ContactInput as $key => $value ) {
	                           ?>
	                           <tr><td class="td-right"><?php echo $value['name'];?>:</td><td><input class="text" type="text" name="<?php echo $value['flag'];?>" /></td></tr>
	                           <?php 
	                           		};
	                           ?>
	                       </table>
                       </form>
                   </div>
               </div>

               <input style="position:relative;top:2px;display:none;" type="checkbox" name="dd_checkbox"/>

               <div style="text-align: center;">
                  <input type="submit" class="btn btn-success" id="setp3_button_prev" value="上一步"/>
                   &nbsp;&nbsp;&nbsp;
                   <input type="submit" class="btn btn-success" id="setp3_button_next" value="下一步"/><br>&nbsp;<br>
               </div>
           </div>
           
           <!--第四页选择模板-->
           <div id="div_4" style="display:none;">
           <div class="panel panel-success">
               <div class="panel-heading">
               	<span>选择模板</span>
               </div>
               <div class="panel-body">
               <?php 
                  $TemplateList = GetTemplateList();
                  $index = 1;
                  foreach ( $TemplateList as $key => $value ) {
               ?>
               <div class="col-sm-3 col-md-3 template" id="<?php echo $value['id'];?>" style="width:32%;">
                   <div class="thumbnail">
                   	   <h5 style="font-size:13px;text-indent:20px;"><?php echo $value['pro_name'];?></h5>
                       <img src="<?php echo $value['cover'];?>" style="width:98%;height:150px;"  alt="<?php echo $value['pro_name'];?>" >
                       <div class="caption">
                           <p style="font-size:12px;text-indent:20px;display:block;white-space:nowrap;width:160px;overflow:hidden;text-overflow:ellipsis;" title="<?php echo $value['description'];?>"><?php echo $value['description'];?></p>
                       </div>
                   </div>
               </div>
               <?php 
               		if( $index % 3 == 0 ) {ECHO '<div style="clear:both;"></div>';}};
               ?>
               </div>
               <div id="template_div_download">
	               <div class="panel-heading"><span>正在下载模版...</span></div>
	               <div class="panel-body">
	               		<div class="progress">
	               			<div class="progress-bar progress-bar-template" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	               		</div>
						<iframe src="./download.php" style="width:100%;height:100px;display:none;" id="template_download" ></iframe>
	               </div>
               </div>
           </div>
               <div style="text-align: center;">
                   <input type="submit" class="btn btn-success" id="setp4_button_prev" value="上一步"/>
                   &nbsp;&nbsp;&nbsp;
                   <input type="submit" class="btn btn-success" id="setp4_button_next" value="下一步"/>
                   <span style="">&nbsp;&nbsp;<label for="ck1"><input name="templateSelect" id="ck1" style="position:relative;top:2px;" type="checkbox" />&nbsp;暂不需要模版</label></span>
                   <br>&nbsp;<br>
               </div>
           </div>

           <!--第五页安装进度页面-->
          <div id="div_5" style="display:none;">
              <div class="panel panel-success">
                  <div class="panel-heading">正在安装模块</div>
                  <div class="panel-body">
                      <div class="progress">
                          <div class="progress-bar progress-bar-install" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                              60%
                          </div>
                      </div>
                      <textarea class="form-control" rows="10"></textarea>
                      <br />
                      <input type="button" class="btn btn-danger" id="install_danger" onClick="location.href = '/install/index.php?setp=1';" value="重新安装" style="display:none;" />
                  </div>
              </div>
          </div>

           <!--第六页完成页面-->
            <div id="div_6" style="display:none;">
                <div class="panel panel-success">
                    <div class="panel-heading">安装完成</div>
                    <div class="panel-body">
                        <div style="text-align: center;">
                          	<p>恭喜您已经安装完成，您可以：</p>
                            <input type="button" class="btn btn-success" id="setp6_button_index" value="前往前台"/>&nbsp;&nbsp;&nbsp;
                            <input type="button" class="btn btn-success" id="setp6_button_admin" value="后台管理"/>
                        </div>
                    </div>

                </div>
            </div>

          </div>

       </div>
    </div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">提示</h4>
	      </div>
	      <div class="modal-body"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
</body>
<script src="dist/js/public.js"></script>
</html>