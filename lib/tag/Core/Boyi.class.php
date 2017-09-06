<?php
// +------------------------------------------------------------------------
// | 自定义标签库  标签名前加下划线   close是否闭合(0 或者1 默认为1,表示闭合)
// +------------------------------------------------------------------------
class Boyi extends TagLib
{
	
    protected $tags = array(
		'newslist'   => array('attr'=>'id,flag,limit,order,sort,field,keyword,key','close'=>1),                                  //新闻列表	
		'departmentlist'=>array('attr'=>'id,limit,order,sort,field,name,key,table','close'=>1),								    //科室列表
		'diseaselist'=>array('attr'=>'id,limit,order,sort,field,name,key','close'=>1),								    	//疾病列表			
        'articlelist'=> array('attr'=>'name,field,limit,order,sort,flag,department,disease,keyword,id,relation,key', 'close'=>1),//疾病文章列表
		'doctorlist' =>array('attr'=>'id,limit,order,sort,field,key,department,flag', 'close'=>1),                      //医生列表
		'topiclist' =>array('attr'=>'id,limit,order,sort,field,key,department,flag', 'close'=>1),                     //医生专题列表
		'channellist' =>array('attr'=>'id,name,flag,sign,limit,order,sort,field,keyword,noid', 'close'=>1),                //个性频道列表
		'honorlist' =>array('attr'=>'id,limit,order,sort,field', 'close'=>1),                                    //医院荣誉列表
		'environlist' =>array('attr'=>'id,limit,order,sort,field', 'close'=>1),                                   //医院环境列表
		'movielist' =>array('attr'=>'id,limit,order,sort,field,keyword,sign', 'close'=>1),                                      //医院视频列表
		'devicelist' =>array('attr'=>'id,limit,order,sort,field', 'close'=>1),                                      //医院设备
		'medialist' =>array('attr'=>'id,limit,order,sort,field,flag', 'close'=>1),                                  //媒体报道
		'technologylist' =>array('attr'=>'id,limit,order,sort,field,flag,department,name', 'close'=>1),            //特色技术
		'successlist' =>array('attr'=>'id,limit,order,sort,field,flag,department,name', 'close'=>1),               //成功案例
		'asklist' =>array('attr'=>'id,limit,order,sort,field,flag,department,name', 'close'=>1),                    //在线问答
		'navlist' =>array('attr'=>'type,limit,key,name,order,sort,level,sign', 'close'=>1),                                  //导航
		'linklist' =>array('attr'=>'limit,key,order,sort', 'close'=>1),                                                     //友情链接
		'piclist'=>array('attr'=>'limit,key,order,sort,sign,name', 'close'=>1),                                             //轮播图
		'page' =>array('attr' =>'name','close'=>0),																           //分页
		'third' => array('attr' =>'name','close'=>0),																		//第三方代码
		'carousel'=>array('attr' =>'sign,limit,order,sort','close'=>0),														//轮播插件
		'html'=>array('attr' =>'name','close'=>0),																			//调用模版下common/html文件
		'position'=>array('attr' =>'name','close'=>0),																      //位置导航
		'takeone' =>array('attr' =>'sign','close'=>1),																//通过标识获取一组中各一条最新咨询
		'connlist' =>array('attr' =>'table,limit,key,order,sort,flag,keyword','close'=>1),									//调用关连表
		'getone'=>array('attr' =>'table,id,relate','close'=>1),													//通过id获得相关的信息
    );


//-----------------------------------------------------------------------------------------------------------------------------------------------------
//[articlelist] : [field] ---显示的字段(默认空或无:  除content外所有字段)
//            [department\disease]
//                          --获取关连字段详情:关连(department[科室] disease[疾病])(默认空或无:默认获取name) 
//                          获取关连字段格式:关连表名_关连字段,例如：{boyi:articlelist department="name" /}[field:department_name /]{/boyi:articlelist}
//							如果要获取多个用逗号隔开,例如：{boyi:articlelist department="id,name" /}[field:department_name /]{/boyi:articlelist}
//			  [limit] --- 获取条数/获取数据从第n条开始,取第m条数据 , 例如：{boyi:articlelist limit="100" /}{/boyi:articlelist} 结果显示100条数据 
//                        或者 {boyi:articlelist limit="2,10" /}{/boyi:articlelist}  结果显示第2条开始，取第10条数据 即取出第3条至第12条，10条记录
//            [pagesize]   ---每页显示条数 (默认空或无：每页显示10条)
//            [page]   ---第几页 (默认空或无：第1页)
//            [order] --- 用于排序的字段(默认空或无：按id排序), 例如：{boyi:articlelist order="id" /}{/boyi:articlelist} 如果有多个用逗号隔开
//            [sort]  --- 排序方式:desc(降序)、asc(升序) (默认为空或无 ：desc), 例如：{boyi:articlelist sort="asc" /}{/boyi:articlelist} 
//		      [flag] --- 推荐位 ：1(首页头版头条), 2(首页头版列表), 3(首页疾病图文), 4(首页疾病列表),5(科室头版头条), 6(科室头版列表), 7(科室疾病图文),    //                                 8(科室疾病列表), 例如：{boyi:articlelist flag="1" /}{/boyi:articlelist}  如果有多个用逗号隔开
//            [keyword]  ---关键词, 例如：{boyi:articlelist keyword="疾病" /}{/boyi:articlelist}     多个关键字用"@"分开 搜所字段keyword、subject
//            [name]    --- 科室名称@科室名称, 例如：{boyi:articlelist name="泌尿外科@包皮" /}{/boyi:articlelist}
//            [relation] ---相关资讯列表, 例如：{boyi:articlelist relation="14" limit="10" /}{/boyi:articlelist}    //在后台有配置
//            [id]       ---疾病详情, 例如：{boyi:articlelist id="$id" /}{/boyi:articlelist}
//            [key]  --- 从1开始自增
//{boyi:articlelist  name="泌尿外科" order="id" limit="5"}
//{boyi:articlelist  name="泌尿外科" order="id" limit="1,10"}
//{boyi:articlelist name="泌尿外科@包皮" order="id" limit="5" }
//{boyi:articlelist flag="1" limit="5" }
//{boyi:articlelist  name="泌尿外科" limit="10"  }
//{boyi:articlelist  name="泌尿外科" flag="1" limit="10"  }
//{boyi:articlelist relation="14" limit="5" }
	/* {boyi:articlelist name="泌尿外科" order="id" limit="5" }
	<li>标题：[field:title|truncate:5:'' /]----id：[field:id /]-----pic：[field:pic /]----department_name：[field:department_name /]----disease_name：[field:disease_name /]</li>
	{/boyi:articlelist} */
//---------------------------------------------------------------------------------------------------------
//---疾病文章列表
//---------------------------------------------------------------------------------------------------------
    public function _articlelist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $department = isset($attr['department']) ? $attr['department'] : 'name';
     $disease = isset($attr['disease']) ? $attr['disease'] : 'name';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $keyword  = empty($attr['keyword']) ? '' : trim($attr['keyword']);
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
     $name = isset($attr['name']) ? trim($attr['name']) : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
     $relation = isset($attr['relation']) ? intval($attr['relation']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
	 $orderby  = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','department'=>'$department','disease'=>'$disease','limit'=>'$limit','orderby'=>'$orderby','name'=>'$name','relation'=>'$relation');
			\$artsql = getSql('article',\$_params);
	        \$art = new ArticleTag();
		\$_artlist = \$art->getArtList(\$artsql);
	foreach (\$_artlist as \$akey=>\$articlelist):	
            if("$department"!=''){
				if(\$articlelist->department_pic){
					\$_artlist[\$akey]->department_pic = rtrim(UPLOAD, '/') . \$articlelist->department_pic;
				}		
			}
            if("$disease"!=''){
				if(\$articlelist->disease_pic){
					\$_artlist[\$akey]->disease_pic = rtrim(UPLOAD, '/') . \$articlelist->disease_pic;
				}				
			}
            if (\$articlelist->pic&&strpos(\$articlelist->pic, NETADDRESS) === false){
                \$_artlist[\$akey]->pic = UPLOAD . \$articlelist->pic; 
			}
            if (\$articlelist->url){          
				\$_artlist[\$akey]->url = NETADDRESS . \$articlelist->url;
			}
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$articlelist);?>';
        return $str;
}	

//------------------------------------------------------------------------------------------------------------------------------------------
//[navlist] :     [type] ---  导航类型:必须top、dise、foot、custom ,1头部导航top  2疾病导航disease  3页尾导航foot  4自定义导航custom,不能同时使用
//            [limit] --- 调用栏目数, 例如：5或 1,5
//			  [name] ---  顶级导航名称 多个用@隔开
//			  [key] ---   从1开始自增
//			  [sign] ---  调用标识
//			  [level] ---  调用级别
//            [order] --- 用于排序的字段(默认空或无：按sort排序), 例如：{boyi:navlist order="id" /}{/boyi:navlist}
//            [sort]  --- 排序方式:desc(降序)、asc(升序) (默认为空或无 ：asc), 例如：{boyi:navlist sort="desc" /}{/boyi:navlist} 
//-------------------------------------------------------------------------------------------------------------------------------------------
	/* {boyi:navlist type="custom"  name="预约@健康体检" key="k"}
	<li>导航名称：[field:subject /]-----Url：[field:url /]---Id：[field:id /]------{$k}</li>
	{boyi:navson}
	<li>子名称：[children:subject /]-----Url：[children:url /]</li>
	{/boyi:navson}
	{/boyi:navlist} */
//---------------------------------------------------------------------------------------------------------
//---导航
//---------------------------------------------------------------------------------------------------------
    public function _navlist($attr, $content)
    {
		$type = isset($attr['type']) ? trim($attr['type']) : '';
		if($type == 'top'){
			$typeid = 1;
		}elseif($type == 'disease'){
			$typeid = 2;			
		}elseif($type == 'foot'){
			$typeid = 3;			
		}elseif($type == 'custom'){
			$typeid = 4;		
		}else{
			$typeid = -1;			
		}
        $order = isset($attr['order']) ? $attr['order'] : 'sort';
        $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
        $orderby = $order." ".$sort;
		$limit = isset($attr['limit']) ? intval($attr['limit']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
        $name = isset($attr['name']) ? trim($attr['name']) : '';
        $sign = isset($attr['sign']) ? trim($attr['sign']) : '';
		$table = ($typeid!=4) ? 'navigation'  : 'navgroup';
		$level = isset($attr['level']) ? intval($attr['level']) : '1';
	if( ($name || $sign) && $level==2){				//只取子级信息
        $str = <<<str
<?php
			\$_params1 = array('typeid'=>$typeid,'sql'=>'one','name'=>'$name','limit'=>'1','sign'=>'$sign');
			\$sql1 = getSql('$table',\$_params1 );
        \$navTag = new NavigationTag();
		\$_navlist = \$navTag->getNavList(\$sql1);
			\$_params2 = array('typeid'=>$typeid,'sql'=>'two','navid'=>\$_navlist[0]->id,'limit'=>'$limit');
			\$sql2 = getSql('$table',\$_params2);
		\$_navsonlist = \$navTag->getNavList(\$sql2);			
	foreach(\$_navsonlist as \$nk => \$navlist):
		if (\$navlist->pic&&strpos(\$navlist->pic, NETADDRESS) === false){
			\$_navsonlist[\$nk]->pic = UPLOAD . \$navlist->pic;			
		}
		if(\$navlist->url){
			if(!preg_match("/(\.|\/$)/i", \$navlist->url))
			\$_navsonlist[\$nk]->url =  \$navlist->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$navlist->url))
			\$_navsonlist[\$nk]->url = NETADDRESS . \$navlist->url;
		}
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$navlist,$_navsonlist,$_navlist);?>';
        return $str;		
		
	}
		
				$patterns = '/\{boyi:navson\}(.*?)\{\/boyi:navson\}/is';
		 				preg_match($patterns,$content,$matches);

		if(count($matches)>0){
        $str1 .= <<<str
<?php
			\$_params2 = array('typeid'=>$typeid,'sql'=>'two','navid'=>\$navlist->id);
			\$sql2 = getSql('$table',\$_params2);
        \$navs = new NavigationTag();
		\$_navsonlist = \$navs->getNavList(\$sql2);
	foreach(\$_navsonlist as \$nk => \$navson):
		if(\$navson->url){
			if(!preg_match("/(\.|\/$)/i", \$navson->url))
			\$_navsonlist[\$nk]->url =  \$navson->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$navson->url))
			\$_navsonlist[\$nk]->url = NETADDRESS . \$navson->url;
		}
?>
str;
        $str1 .= $matches[1];
        $str1 .= '<?php endforeach;?>';
		$str1 =  preg_replace("/\[children:(.*?)\/\]/", '{\$navson->$1}', $str1);
		$content =  preg_replace($patterns, $str1, $content);
		}
		
        $str    = <<<str
<?php
			\$_params1 = array('typeid'=>$typeid,'orderby'=>'$orderby','sql'=>'one','name'=>'$name','limit'=>'$limit','sign'=>'$sign');
			\$sql1 = getSql('$table',\$_params1 );
        \$navTag = new NavigationTag();
		\$_navlist = \$navTag->getNavList(\$sql1);
	foreach(\$_navlist as \$nkey => \$navlist):
		if (\$navlist->pic&&strpos(\$navlist->pic, NETADDRESS) === false){
			\$_navlist[\$nkey]->pic = UPLOAD . \$navlist->pic;			
		}
		if(\$navlist->url){
			if(!preg_match("/(\.|\/$)/i", \$navlist->url))
			\$_navlist[\$nkey]->url =  \$navlist->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$navlist->url))
			\$_navlist[\$nkey]->url = NETADDRESS . \$navlist->url;
		}
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$navlist,$navson);?>';
        return $str;

    }

//---------------------------------------------------------------------------------------------------------
	/* {boyi:newslist limit="10" key="k" keyword="男人"}
	<li>新闻名称：[field:subject /]-----pic：[field:pic /]---Id：[field:id /]------{$k}</li>
	{/boyi:newslist} */
//---------------------------------------------------------------------------------------------------------
//新闻列表
//---------------------------------------------------------------------------------------------------------
    public function _newslist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $keyword  = empty($attr['keyword']) ? '' : trim($attr['keyword']);
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','limit'=>'$limit','orderby'=>'$orderby');
			\$newsql = getSql('news',\$_params);
	        \$new = new NewsTag();
		\$_newlist = \$new->getNewsList(\$newsql."$page");
	foreach (\$_newlist as \$nkey=>\$newslist):	
            if (\$newslist->pic&&strpos(\$newslist->pic, NETADDRESS) === false){
                \$_newlist[\$nkey]->pic = UPLOAD . \$newslist->pic;			
			}
            \$_newlist[\$nkey]->url = NETADDRESS .'/hospital/news/'. \$newslist->id . '.html';
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$newslist);?>';
        return $str;		
    }

//---------------------------------------------------------------------------------------------------------
/* {boyi:channellist limit="10" }
	<li>自定义名称：[field:subject /]-----pic：[field:pic /]---Id：[field:id /]------{$k}</li>
{/boyi:channellist} */
//---------------------------------------------------------------------------------------------------------
//个性频道 文章列表  channel表字段   =>  channel_字段
//---------------------------------------------------------------------------------------------------------
    public function _channellist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $sign = isset($attr['sign']) ? $attr['sign'] : '';
     $keyword  = empty($attr['keyword']) ? '' : trim($attr['keyword']);
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $name = isset($attr['name']) ? trim($attr['name']) : '';
     $noid = isset($attr['noid']) ? trim($attr['noid']) : 'yes';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
	 $orderby = $order." ".$sort;
        $str = <<<str
<?php
			\$_params = array('field'=>'$field','flag'=>'$flag','sign'=>'$sign','limit'=>'$limit','orderby'=>'$orderby','name'=>'$name');
			if((\$channel->channel_id||\$channelarticle->channel_id) && $noid=='yes'){
				\$_params['channel_id'] = \$channel->channel_id ? \$channel->channel_id : \$channelarticle->channel_id;
			}
			\$chaasql = getSql('channelarticle',\$_params);
	        \$chaa = new ChannelArticleTag();
		\$_chaalist = \$chaa->getChaArtList(\$chaasql."$page");
	foreach (\$_chaalist as \$ckey=>\$channellist):	
            if (\$channellist->pic&&strpos(\$channellist->pic, NETADDRESS) === false){
                \$_chaalist[\$ckey]->pic = UPLOAD . \$channellist->pic;			
			}
			if(\$channellist->content){
				\$_chaalist[\$ckey]->content = stripslashes(\$channellist->content);
			}
            \$_chaalist[\$ckey]->url = NETADDRESS .'/'. \$channellist->channel_shortname .'/'. \$channellist->id . '.html';
            \$_chaalist[\$ckey]->purl = NETADDRESS .'/'. \$channellist->channel_shortname .'/';
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$channellist);?>';
        return $str;		
    }

//---------------------------------------------------------------------------------------------------------
	/* {boyi:doctorlist limit="10" key="k"}
	<li>医生名称：[field:name /]-----pic：[field:pic /]---Id：[field:id /]------{$k}</li>
	{/boyi:doctorlist} */
//---------------------------------------------------------------------------------------------------------
//医生列表
//---------------------------------------------------------------------------------------------------------
    public function _doctorlist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $keyword  = empty($attr['keyword']) ? '' : trim($attr['keyword']);
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
     $department  = isset($attr['department']) ? $attr['department'] : 'name';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','department'=>'$department','limit'=>'$limit','orderby'=>'$orderby');
			\$docsql = getSql('doctor',\$_params);
	        \$doc = new DoctorTag();
		\$_doclist = \$doc->getDocList(\$docsql."$page");
	foreach (\$_doclist as \$dkey=>\$doctorlist):
            if (\$doctorlist->pic&&strpos(\$doctorlist->pic, NETADDRESS) === false){
                \$_doclist[\$dkey]->pic = UPLOAD . \$doctorlist->pic;		
			}	
            if("$department"!=''){
				if(\$doctorlist->department_pic){
					\$_doclist[\$dkey]->department_pic = rtrim(UPLOAD, '/') . \$doctorlist->department_pic;
				}		
			}
            \$_doclist[\$dkey]->url = NETADDRESS .'/doctor/'. \$doctorlist->id . '.html';
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$doctorlist);?>';
        return $str;		
    }
//------------------------------------------------------------------------------------------------------------------------
//[departmentlist]:  [field] --- 显示的字段(默认空或无:  除content外所有字段)
//			     [name] ---  科室名称 多个用@隔开
//               [limit] --- 限制条数, 例如：5或 1,5
//			     [key] ---   从1开始自增
//               [order] --- 用于排序的字段(默认空或无：按sort排序), 例如：{boyi:departmentlist order="id" /}{/boyi:departmentlist}
//               [sort]  --- 排序方式:desc(降序)、asc(升序) (默认为空或无 ：asc), 例如：{boyi:departmentlist sort="desc" /}{/boyi:departmentlist} 
//--------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//---科室列表
/* {boyi:departmentlist }
	<li>科室名称：[field:name /]-----Url：[field:url /]---Id：[field:id /]------{$k}</li>
	{boyi:depson}
		<li>子科室名称：[children1:name /]-----Url：[children1:url /]</li>
		{boyi:disson}
			<li>子子科室名称：[children2:name /]-----Url：[children2:url /]</li>
		{/boyi:disson}		
	{/boyi:depson}
{/boyi:departmentlist} */
//--------------------------------------------------------------------------------------------------------
    public function _departmentlist($attr, $content)
    {
		 $field = isset($attr['field']) ? $attr['field'] : '';
		 $order = isset($attr['order']) ? $attr['order'] : 'orders';
		 $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
		 $limit = isset($attr['limit']) ? ' LIMIT '.$attr['limit'] : '';
         $name = isset($attr['name']) ? trim($attr['name']) : '';
         $table = isset($attr['table']) ? trim($attr['table']) : '';
			$i = isset($attr['key']) ? trim($attr['key']) : 'k';
			$$i = 1;
		 $orderby = $order." ".$sort;
		if($name){
			$name = str_replace('@', "','", $name);
			$where = "AND name IN('".$name."')";
		}

		if($field){
			$depf = explode(',', $field);
			$field = 'id.dep,';
			foreach($depf as $key=>$val){
				if($val!='id')
				{
					$field .= $as.'.'.$val.',';	
				}				
			}
		    $field = substr($field, 0, strlen($field) - 1);
		}else{
			$depTag = new DepartmentTag();
		    $field = $depTag->getDepFields();			
		}
			$sql = 'SELECT '.$field.' FROM department AS dep WHERE 1=1 '.$where.' ORDER BY dep.'.$orderby.$limit;
			$sql2 = 'SELECT * FROM disease WHERE 1=1 AND parent_id=0 AND department_id=".$departmentlist->id."';
			$sql3 = 'SELECT * FROM disease WHERE 1=1 AND parent_id=".$depson->id."';
			$sql4 = 'SELECT * FROM '.$table.' WHERE 1=1 AND department_id=".$departmentlist->id."';
			$sql5 = 'SELECT doctor.* FROM '.$table.' LEFT JOIN  `doctortodisease` as dd ON doctor.id = dd.doctor_id WHERE 1=1 AND dd.disease_id=".$depson->id."';
if($table){	
		 		// $patt = '/\{boyi:doctor\sk=[\'"](.+?)[\'"]\s}(.*?)\{\/boyi:doctor\}/is';//调关连表信息
		 		 $patt = '/\{boyi:doctor\}(.*?)\{\/boyi:doctor\}/is';
		 				preg_match($patt,$content,$mat);
			$ii = 'key';
			$$ii = 1;			
		if(count($mat)>0){
        $tab  = <<<str
<?php
        \$doc = new DoctorTag();
		if(\$depson->id){
			\$_doclist = \$doc->getDocList("$sql5");
		}else{
			\$_doclist = \$doc->getDocList("$sql4");			
		}
	foreach(\$_doclist as \$dkey => \$doctor):
            if (\$doctor->pic&&strpos(\$doctor->pic, NETADDRESS) === false){
                \$_doclist[\$dkey]->pic = UPLOAD . \$doctor->pic;		
			}
            \$_doclist[\$dkey]->url = NETADDRESS .'/doctor/'. \$doctor->id . '.html';
			\$ii++;
?>
str;
        $tab .= $mat[1];
        $tab .= '<?php endforeach;?>';
		$tab =  preg_replace("/\[children:(.*?)\/\]/", '{\$doctor->$1}', $tab);
		$content =  preg_replace($patt, $tab, $content);		
}
}
		 $patterns = '/\{boyi:depson\}(.*?)\{\/boyi:depson\}/is';
		 				preg_match($patterns,$content,$matches);
		if(count($matches)>0){
        $str1  = <<<str
<?php
        \$dis = new DiseaseTag();
		\$_dislist = \$dis->getDisList("$sql2");
	foreach(\$_dislist as \$diskey => \$depson):
		if(\$depson->url){
			if(!preg_match("/(\.|\/$)/i", \$depson->url))
			\$_dislist[\$diskey]->url =  \$depson->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$depson->url))
			\$_dislist[\$diskey]->url = \$_deplist[\$depkey]->url . \$depson->url;
		}
?>
str;
        $str1 .= $matches[1];
        $str1 .= '<?php endforeach;?>';
		$str1 =  preg_replace("/\[children1:(.*?)\/\]/", '{\$depson->$1}', $str1);
		$content =  preg_replace($patterns, $str1, $content);
		 $patterns2 = '/\{boyi:disson\}(.*?)\{\/boyi:disson\}/is';
		 				preg_match($patterns2,$content,$matches2);
		if(count($matches2)>0){
        $str2  = <<<str
<?php
        \$dis = new DiseaseTag();
		\$_dissonlist = \$dis->getDisList("$sql3");
	foreach(\$_dissonlist as \$dskey => \$disson):
		if(\$disson->url){
			if(!preg_match("/(\.|\/$)/i", \$disson->url))
			\$_dissonlist[\$dskey]->url =  \$disson->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$disson->url))
			\$_dissonlist[\$dskey]->url = \$_dislist[\$diskey]->url . \$disson->url;
		}
?>
str;
        $str2 .= $matches2[1];
        $str2 .= '<?php endforeach;?>';
		$str2 =  preg_replace("/\[children2:(.*?)\/\]/", '{\$disson->$1}', $str2);
		$content =  preg_replace($patterns2, $str2, $content);
		}
		}
        $str    = <<<str
<?php
        \$depTag = new DepartmentTag();
		\$_deplist = \$depTag->getDepList("$sql");
	foreach(\$_deplist as \$depkey => \$departmentlist):
		if(\$departmentlist->url){
			if(!preg_match("/(\.|\/$)/i", \$departmentlist->url))
			\$_deplist[\$depkey]->url =  \$departmentlist->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$departmentlist->url))
			\$_deplist[\$depkey]->url = NETADDRESS .'/'. \$departmentlist->url;
		}
		if (\$departmentlist->pic&&strpos(\$departmentlist->pic, NETADDRESS) === false){
			\$_deplist[\$depkey]->pic = UPLOAD . \$_deplist[\$depkey]->pic;			
		}
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$departmentlist,$depson);?>';
        return $str;		
	}
//------------------------------------------------------------------------------------------------------------------------
//[diseaselist]:  [field] --- 显示的字段(默认空或无:  除content外所有字段)
//			     [name] ---  科室名称 多个用@隔开
//               [limit] --- 限制条数, 例如：5或 1,5
//			     [key] ---   从1开始自增
//               [order] --- 用于排序的字段(默认空或无：按sort排序), 例如：{boyi:diseaselist order="id" /}{/boyi:diseaselist}
//               [sort]  --- 排序方式:desc(降序)、asc(升序) (默认为空或无 ：asc), 例如：{boyi:diseaselist sort="desc" /}{/boyi:diseaselist} 
//--------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
/* {boyi:diseaselist }
	<li>疾病名称：[field:name /]-----Url：[field:url /]---Id：[field:id /]------{$k}</li>
	{boyi:disson}
	<li>子疾病名称：[children:name /]-----Url：[children:url /]</li>
	{/boyi:disson}
{/boyi:diseaselist} */
//--------------------------------------------------------------------------------------------------------
    public function _diseaselist($attr, $content)
    {
		 $field = isset($attr['field']) ? $attr['field'] : '';
		 $order = isset($attr['order']) ? $attr['order'] : 'id';
		 $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
		 $limit = isset($attr['limit']) ? ' LIMIT '.$attr['limit'] : '';
         $name = isset($attr['name']) ? trim($attr['name']) : '';
			$i = isset($attr['key']) ? trim($attr['key']) : 'k';
			$$i = 1;
		 $orderby = $order." ".$sort;

		if($field){
			$disf = explode(',', $field);
			$field = 'id.dis,';
			foreach($disf as $key=>$val){
				if($val!='id')
				{
					$field .= $as.'.'.$val.',';	
				}				
			}
		    $field = substr($field, 0, strlen($field) - 1);
		}else{
			$disTag = new DiseaseTag();
		    $field = $disTag->getDisFields();			
		}
			$sql = 'SELECT '.$field.' FROM disease AS dis WHERE 1=1 AND dis.parent_id=0 ORDER BY dis.'.$orderby.$limit;			
			$sql2 = 'SELECT * FROM disease WHERE 1=1 AND parent_id=".$diseaselist->id." ORDER BY '.$orderby;	
		 $patterns = '/\{boyi:disson\}(.*?)\{\/boyi:disson\}/is';
		 				preg_match($patterns,$content,$matches);
		if(count($matches)>0){
        $str1  = <<<str
<?php
		\$_dissonlist = \$disTag->getDisList("$sql2");
	foreach(\$_dissonlist as \$dskey => \$disson):
		if(\$disson->url){
			if(!preg_match("/(\.|\/$)/i", \$disson->url))
			\$_dissonlist[\$dskey]->url =  \$disson->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$disson->url))
			\$_dissonlist[\$dskey]->url = NETADDRESS .'/'. \$disson->url;
		}
?>
str;
        $str1 .= $matches[1];
        $str1 .= '<?php endforeach;?>';
		$str1 =  preg_replace("/\[children:(.*?)\/\]/", '{\$disson->$1}', $str1);
		$content =  preg_replace($patterns, $str1, $content);
		}
        $str    = <<<str
<?php
        \$disTag = new DiseaseTag();
		\$_dislist = \$disTag->getDisList("$sql");
	foreach(\$_dislist as \$diskey => \$diseaselist):
		if(\$diseaselist->url){
			if(!preg_match("/(\.|\/$)/i", \$diseaselist->url))
			\$_dislist[\$diskey]->url =  \$diseaselist->url.'/';
			if(!preg_match("/http[^\s]?:\/\//i", \$diseaselist->url))
			\$_dislist[\$diskey]->url = NETADDRESS .'/'. \$diseaselist->url;
		}
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$diseaselist,$disson);?>';
        return $str;		
	}
//---------------------------------------------------------------------------------------------------------
	/* {boyi:honor field="pic"}
	<li>pic：[field:pic /]---Id：[field:id /]----</li>
	{/boyi:honor} */
//---------------------------------------------------------------------------------------------------------
//---荣誉列表
//---------------------------------------------------------------------------------------------------------
    public function _honorlist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','limit'=>'$limit','orderby'=>'$orderby');
			\$honsql = getSql('honor',\$_params);
	        \$hon = new HonorTag();
		\$_honlist = \$hon->getHonList(\$honsql."$page");
	foreach (\$_honlist as \$hkey=>\$honorlist):
            if (\$honorlist->pic&&strpos(\$honorlist->pic, NETADDRESS) === false){
                \$_honlist[\$hkey]->pic = UPLOAD . \$honorlist->pic;		
			}
            \$_honlist[\$hkey]->url = NETADDRESS .'/hospital/honor/'. \$honorlist->id . '.html';			
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($honorlist);?>';
        return $str;		
    }

//---------------------------------------------------------------------------------------------------------
	/* {boyi:environlist field="pic"}
	<li>pic：[field:pic /]---Id：[field:id /]----</li>
	{/boyi:environlist} */
//---------------------------------------------------------------------------------------------------------
//---医院环境列表
//---------------------------------------------------------------------------------------------------------
    public function _environlist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order = isset($attr['order']) ? $attr['order'] : 'id';
     $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
      $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','limit'=>'$limit','orderby'=>'$orderby');
			\$evnsql = getSql('environment',\$_params);
	        \$env = new EnvironmentTag();
		\$_envlist = \$env->getEnvList(\$evnsql."$page");
	foreach (\$_envlist as \$hkey=>\$environlist):
            if (\$environlist->pic&&strpos(\$environlist->pic, NETADDRESS) === false){
                \$_envlist[\$hkey]->pic = UPLOAD . \$environlist->pic;		
			}
            \$_envlist[\$hkey]->url = NETADDRESS .'/hospital/environment/'. \$environlist->id . '.html';			
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($environlist);?>';
        return $str;		
    }

//---------------------------------------------------------------------------------------------------------
	/* {boyi:topiclist limit="10" key="k" keyword="男人"}
	<li>专题名称：[field:subject /]-----pic：[field:pic /]---Id：[field:id /]------{$k}</li>
	{/boyi:topiclist} */
//---------------------------------------------------------------------------------------------------------
//---专题列表
//---------------------------------------------------------------------------------------------------------
    public function _topiclist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $keyword = empty($attr['keyword']) ? '' : trim($attr['keyword']);
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','limit'=>'$limit','orderby'=>'$orderby');
			\$topsql = getSql('topic',\$_params);
	        \$top = new TopicTag();
		\$_toplist = \$top->getTopList(\$topsql);
	foreach (\$_toplist as \$tkey=>\$topiclist):
            if (\$topiclist->pic&&strpos(\$topiclist->pic, NETADDRESS) === false){
                \$_toplist[\$tkey]->pic = UPLOAD . \$topiclist->pic;		
			}
            \$_toplist[\$tkey]->url = NETADDRESS .'/topic/'. \$topiclist->id . '.html';
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$topiclist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---视频列表
//--------------------------------------------------------------------------------------------------------
    public function _movielist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
     $sign = isset($attr['sign']) ? trim($attr['sign']) : '';
     $keyword = isset($attr['keyword']) ? trim($attr['keyword']) : '';
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','limit'=>'$limit','orderby'=>'$orderby','keyword'=>'$keyword','sign'=>'$sign');
			\$movsql = getSql('movie',\$_params);
	        \$mov = new MovieTag();
		\$_movlist = \$mov->getMovList(\$movsql."$page");
	foreach (\$_movlist as \$mkey=>\$movielist):
            if (\$movielist->pic&&strpos(\$movielist->pic, NETADDRESS) === false){
                \$_movlist[\$mkey]->pic = UPLOAD . \$movielist->pic;		
			}
            \$_movlist[\$mkey]->url = NETADDRESS .'/hospital/movie/'. \$movielist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($movielist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---医院设备
//--------------------------------------------------------------------------------------------------------
    public function _devicelist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','limit'=>'$limit','orderby'=>'$orderby');
			\$devsql = getSql('device',\$_params);
	        \$dev = new DeviceTag();
		\$_devlist = \$dev->getDevList(\$devsql."$page");
	foreach (\$_devlist as \$dkey=>\$devicelist):
            if (\$devicelist->pic&&strpos(\$devicelist->pic, NETADDRESS) === false){
                \$_devlist[\$dkey]->pic = UPLOAD . \$devicelist->pic;		
			}
            \$_devlist[\$dkey]->url = NETADDRESS .'/hospital/device/'. \$devicelist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($devicelist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---媒体报道
//--------------------------------------------------------------------------------------------------------
    public function _medialist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;
     $flag = isset($attr['flag']) ? $attr['flag'] : '';

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','limit'=>'$limit','orderby'=>'$orderby');
			\$medsql = getSql('mediareport',\$_params);
	        \$med = new MediaReportTag();
		\$_medlist = \$med->getMedList(\$medsql."$page");
	foreach (\$_medlist as \$mkey=>\$medialist):
            if (\$medialist->pic&&strpos(\$medialist->pic, NETADDRESS) === false){
                \$_medlist[\$mkey]->pic = UPLOAD . \$medialist->pic;		
			}
            \$_medlist[\$mkey]->url = NETADDRESS .'/hospital/media/'. \$medialist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($medialist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---特色技术
//--------------------------------------------------------------------------------------------------------
    public function _technologylist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $department  = isset($attr['department']) ? $attr['department'] : 'name';
     $name = isset($attr['name']) ? trim($attr['name']) : '';

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','department'=>'$department','limit'=>'$limit','orderby'=>'$orderby','name'=>'$name');
			\$tecsql = getSql('technology',\$_params);
	        \$tec = new TechnologyTag();
		\$_teclist = \$tec->getTecList(\$tecsql."$page");
	foreach (\$_teclist as \$tkey=>\$technologylist):
            if (\$technologylist->pic&&strpos(\$technologylist->pic, NETADDRESS) === false){
                \$_teclist[\$tkey]->pic = UPLOAD . \$technologylist->pic;		
			}
            if("$department"!=''){
				if(\$technologylist->department_pic){
					\$_teclist[\$tkey]->department_pic = rtrim(UPLOAD, '/') . \$technologylist->department_pic;
				}		
			}
            \$_teclist[\$tkey]->url = NETADDRESS .'/technology/'. \$technologylist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($technologylist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---成功案例
//--------------------------------------------------------------------------------------------------------
    public function _successlist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $department = $department = isset($attr['department']) ? $attr['department'] : 'name';
     $name = isset($attr['name']) ? trim($attr['name']) : '';

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','department'=>'$department','limit'=>'$limit','orderby'=>'$orderby','name'=>'$name');
			\$sucsql = getSql('success',\$_params);
	        \$suc = new SuccessTag();
		\$_suclist = \$suc->getSucList(\$sucsql."$page");
	foreach (\$_suclist as \$skey=>\$successlist):
            if (\$successlist->pic1&&strpos(\$successlist->pic1, NETADDRESS) === false){
                \$_suclist[\$skey]->pic1 = UPLOAD . \$successlist->pic1;		
			}
            if (\$successlist->pic2&&strpos(\$successlist->pic2, NETADDRESS) === false){
                \$_suclist[\$skey]->pic2 = UPLOAD . \$successlist->pic2;		
			}
            if("$department"!=''){
				if(\$successlist->department_pic){
					\$_suclist[\$skey]->department_pic = rtrim(UPLOAD, '/') . \$successlist->department_pic;
				}		
			}
            \$_suclist[\$skey]->url = NETADDRESS .'/hospital/success/'. \$successlist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($successlist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---在线问答
//--------------------------------------------------------------------------------------------------------
    public function _asklist($attr, $content)
    {
     $field = isset($attr['field']) ? $attr['field'] : '';
     $order  = isset($attr['order']) ? $attr['order'] : 'id';
     $sort  = isset($attr['sort']) ? $attr['sort'] : 'DESC';
     $limit = isset($attr['limit']) ? $attr['limit'] : '';
	 $page = empty($limit) ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
	 $orderby = $order." ".$sort;
     $flag = isset($attr['flag']) ? $attr['flag'] : '';
     $department  = isset($attr['department']) ? $attr['department'] : 'name';
     $name = isset($attr['name']) ? trim($attr['name']) : '';

        $str = <<<str
<?php
			\$_params = array('id'=>'$id','field'=>'$field','flag'=>'$flag','department'=>'$department','limit'=>'$limit','orderby'=>'$orderby','name'=>'$name');
			\$asksql = getSql('ask',\$_params);
	        \$as = new AskTag();
		\$_asklist = \$as->getAskList(\$asksql."$page");
	foreach (\$_asklist as \$akey=>\$asklist):
            if("$department"!=''){
				if(\$asklist->department_pic){
					\$_asklist[\$akey]->department_pic = rtrim(UPLOAD, '/') . \$asklist->department_pic;
				}		
			}
            \$_asklist[\$akey]->url = NETADDRESS .'/ask/'. \$asklist->id . '.html';
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($asklist);?>';
        return $str;		
    }
//--------------------------------------------------------------------------------------------------------
//---友情链接
//--------------------------------------------------------------------------------------------------------
/* {boyi:linklist }
	<li>链接名称：[field:name /]-----Url：[field:url /]---Id：[field:id /]------{$k}</li>
{/boyi:linklist} */
//--------------------------------------------------------------------------------------------------------
    public function _linklist($attr, $content)
    {
        $order = isset($attr['order']) ? $attr['order'] : 'sort';
        $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
        $orderby = $order." ".$sort;
		$limit = isset($attr['limit']) ? intval($attr['limit']) : '';
		//$limit = $limit ? $limit : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
        $str = <<<str
<?php
			\$_params = array('limit'=>'$limit','orderby'=>'$orderby');
			\$lsql = getSql('link',\$_params);
	        \$lin = new LinkTag();
		\$_linlist = \$lin->getLinList(\$lsql);
	foreach (\$_linlist as \$lkey=>\$linklist):
            if (\$linklist->pic&&strpos(\$linklist->pic, NETADDRESS) === false){
                \$_linlist[\$lkey]->pic = UPLOAD . \$linklist->pic;		
			}
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$linklist);?>';
        return $str;		
	}
//--------------------------------------------------------------------------------------------------------
//---轮播图
//--------------------------------------------------------------------------------------------------------
/* {boyi:pic flag="scroll"}
	<li>--pic：[field:pic /]---Id：[field:id /]------{$k}</li>
{/boyi:pic} */
//---------------------------------------------------------------------------------------------------------
    public function _piclist($attr, $content)
    {
        $order = isset($attr['order']) ? $attr['order'] : 'sort';
        $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
        $orderby = $order." ".$sort;
		$limit = isset($attr['limit']) ? intval($attr['limit']) : '';
		//$limit = $limit ? 'LIMIT '.$limit : '';
        $sign = isset($attr['sign']) ? $attr['sign'] : '';
        $name = isset($attr['name']) ? trim($attr['name']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 0;
		
        $str = <<<str
<?php
			\$_params = array('limit'=>'$limit','orderby'=>'$orderby','name'=>'$name','sign'=>'$sign');
			\$psql = getSql('pic',\$_params);
	        \$pictag = new PicTag();
		\$_piclist = \$pictag->getPicList(\$psql);
	foreach (\$_piclist as \$pkey=>\$piclist):
            if (\$piclist->pic&&strpos(\$piclist->pic, NETADDRESS) === false){
                \$_piclist[\$pkey]->pic = UPLOAD . \$piclist->pic;	
			}
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$piclist);?>';
        return $str;		
	}


	//位置导航  可以在makehtml.json 配如：list_name 、detail_name
    //{"name": "在线问答","list_name": "医患交流","detail_name": "问答详情","tag": "AskTag","key": "ask","pageSize": 10,"list_tpl": "ask/list","detail_tpl": "ask/detail"}
    public function _position($attr)
    {

		$name = isset($attr['name']) ? trim($attr['name']) : 'list';

		$str = '';
		if($name == 'list'){
		  $str = '<ol class="breadcrumb">您的位置：<li><a href="{$WEBSITE}"><i class="icon icon-home"></i> 首页</a></li><li>{$LISTNAME}</li></ol>';
		}elseif($name == 'detail'){
		  $str = '<ol class="breadcrumb">您的位置：<li><a href="{$WEBSITE}"><i class="icon icon-home"></i> 首页</a></li><li><a href="{$HTMLURL}">{$LISTNAME}</a></li><li class="active">{$DETAILNAME}</li></ol>';
		}
		
        return $str;
    }
	/**
	 * 分页
	 * 根据分页信息获取分页html
	 * @param int count 总条数
	 * @param int current 当前页
	 * @param int pageSize 每页条数
	 * @param int pageCount 总页数
	 * @param int pre 上一页
	 * @param int next 下一页
	 * @param string dir html存放文件夹
	 */
    public function _page($attr)
    {
        $name = isset($attr['name']) ? trim($attr['name']) : 'index';
		#.分页基础模版
		return $name ? getHtml($name,'page') : '';
    }	

	//轮播图
    public function _carousel($attr)
    {
        $order = isset($attr['order']) ? $attr['order'] : 'sort';
        $sort = isset($attr['sort']) ? $attr['sort'] : 'ASC';
        $_params['orderby'] = $order." ".$sort;
		$limit = isset($attr['limit']) ? intval($attr['limit']) : '';
		$_params['limit'] = $limit ? 'LIMIT '.$limit : '';
		$_params['sign'] = isset($attr['sign']) ? $attr['sign'] : '';
		if(!empty($_params['sign'])){
			$psql = getSql('pic',$_params);
			$pictag = new PicTag();
			$_piclist = $pictag->getPicList($psql);
			$id_num = 'pic_'.rand(100,999);
			$_str1 ='<div id="'.$id_num.'" class="carousel slide" data-ride="carousel">';
			$_str2 ='<ol class="carousel-indicators">';
			$_str2 .='<div class="carousel-inner">';
			$_str3 ='<div class="carousel-inner">';
			foreach($_piclist as $key=>$val){
				if($key==0){
					$_str2.= '<li data-target="#'.$id_num.'" data-slide-to="'.$key.'" class="active"></li>';
					$_str3.='<div class="item active"><a href="'.$val->url.'" target="_blank"><img src="'.UPLOAD.$val->pic.'"></a></div>';					
				}else{
					$_str2.= '<li data-target="#'.$id_num.'" data-slide-to="'.$key.'"></li>';
					$_str3.='<div class="item"><a href="'.$val->url.'" target="_blank"><img src="'.UPLOAD.$val->pic.'"></a></div>';						
				}
			}
			$_str2 .='</ol>';
			$_str3 .='</div>';
			$_str4	='<a class="left carousel-control" href="#'.$id_num.'" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a>';
			$_str4 .='<a class="right carousel-control" href="#'.$id_num.'" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>';
			$_str4 .='</div>';
			return $_str1.$_str2.$_str3.$_str4;
		}else{
			return '';
		}
	}
	//第三方代码
    public function _third($attr)
    {
		$name = isset($attr['name']) ? trim($attr['name']) : '';
		if($name){
			$data = getServiceMethod('ThirdStat','query',array('subject'=>$name));			
			return $data->data[0]->js;
		}else{
			return '';
		}
	}

	//调用模版下common/html文件
	public function _html($attr)
	{
		$name = isset($attr['name']) ? trim($attr['name']) : '';
		return $name ? getHtml($name) : '';
	}
	//通过标识获取一组中各一条最新咨询(channel)
	public function _takeone($attr)
	{
		$name = isset($attr['sign']) ? trim($attr['sign']) : '';
		
	}
//--------------------------------------------------------------------------------------------------------
//---科室首页下关连表(医生列表doctor、疾病文章article、疾病列表disease、成功案例success、在线问答ask、特色技术technology) ----/department/index.htpl
//---疾病列表下关连表(疾病文章article、成功案例success、在线问答ask) ---/disease/list.htpl
//---疾病文章下关连表(同级科室下疾病列表disease,相关疾病文章article,相关成功案例success、在线问答ask) ---/article/detail_depart.htpl
//---医生详情下关连表(疾病文章article) ---/doctor/detail.htpl
//--------------------------------------------------------------------------------------------------------
// {boyi:connlist table="doctor" }
// <li>[field:name /]----[field:title /]--[field:url /]</li>
// {/boyi:connlist}
//---------------------------------------------------------------------------------------------------------
	public function _connlist($attr, $content)
	{

		$table = isset($attr['table']) ? trim($attr['table']) : '';
		$modulekey = isset($attr['modulekey']) ? trim($attr['modulekey']) : '';
		 $order = isset($attr['order']) ? $attr['order'] : 'id';
		 $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
		 $limit = isset($attr['limit']) ? $attr['limit'] : '';
		 $page = ($table=='article' && empty($limit) && $modulekey=='disease') ? ' LIMIT '.'".($current-1)*$pageSize."'.',".$pageSize."' : '';
		 $flag = isset($attr['flag']) ? $attr['flag'] : '';
		$keyword = isset($attr['keyword']) ? trim($attr['keyword']) : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
		$orderby  = $order." ".$sort;
			$tabs = array(
				'disease' => array('as'=>'getDisList','tag'=>'DiseaseTag','url'=>"NETADDRESS . '/'. \$".$modulekey."->department_url .'/'. \$connlist->url .'/'",'isdep'=>'no','isdis'=>'no'),
				'article' => array('as'=>'getArtList','tag'=>'ArticleTag','url'=>"NETADDRESS . '/'. \$".$modulekey."->department_url .'/'. \$connlist->disease_url .'/'. \$connlist->id . '.html'",'disease'=>'url','isdep'=>'no','isdis'=>''),
				'doctor'  => array('as'=>'getDocList','tag'=>'DoctorTag','url'=>"NETADDRESS . '/doctor/'. \$connlist->id . '.html'",'isdep'=>'no','isdis'=>'no'),
				'success'=>array('as'=>'getSucList','tag'=>'SuccessTag','url'=>"NETADDRESS . '/hospital/success/'. \$connlist->id . '.html'",'isdep'=>'no','isdis'=>'no'),
				'ask'=>array('as'=>'getAskList','tag'=>'AskTag','url'=>"NETADDRESS . '/ask/' . \$connlist->id . '.html'",'isdep'=>'no','isdis'=>'no'),
				'technology'=>array('as'=>'getTecList','tag'=>'TechnologyTag','url'=>"NETADDRESS . '/technology/' . \$connlist->id . '.html'",'isdep'=>'no','isdis'=>'no'),
			);
			$tab = $tabs[$table];

				$as = $tab['as'];
				$tag = $tab['tag'];	
				$url =  $tab['url'];
				$isdep =  $tab['isdep'];              //是否连接department  
				$isdis =   $tab['isdis'];           //是否连接disease
				$dis =  empty($tab['disease']) ? '' :$tab['disease'];
				if($modulekey=="article"){
					if($table =="disease"){
						$modulekey = 'department';
						$id = '$article->department_id';
					}else{
						$modulekey = 'disease';
						$id = '$article->id';						
					}
				}elseif($modulekey=="disease"){
					if($table =="disease"){
						$modulekey="department";
						$id = '$disease->department_id';
					}else{
						$id = '$disease->id';						
					}

				}else{
						$id = '$department->id';				
				}
					$table_id = $modulekey . '_id';
        $str = <<<str
<?php
			\$_params = array('$table_id'=>$id,'limit'=>'$limit','orderby'=>'$orderby','isdep'=>'$isdep','isdis'=>'$isdis','modulekey'=>'$modulekey','flag'=>'$flag','disease'=>'$dis','keyword'=>'$keyword');
			\$connsql = getSql('$table',\$_params);
	        \$conn = new $tag();
		\$_connlist = \$conn->$as(\$connsql."$page");
	foreach (\$_connlist as \$ckey=>\$connlist):	
            if (\$connlist->pic&&strpos(\$connlist->pic, NETADDRESS) === false){
                \$_connlist[\$ckey]->pic = UPLOAD . \$connlist->pic; 
			}      
				\$_connlist[\$ckey]->url = $url;
		\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$_connlist,$ckey,$_params,$limit,$orderby,$dis,$flag);?>';
        return $str;		
	}
	public function _channlist($attr, $content)
	{
		$modulekey = isset($attr['modulekey']) ? trim($attr['modulekey']) : '';
		 $order = isset($attr['order']) ? $attr['order'] : 'id';
		 $sort = isset($attr['sort']) ? $attr['sort'] : 'DESC';
		 $limit = isset($attr['limit']) ? $attr['limit'] : '';
		$i = isset($attr['key']) ? trim($attr['key']) : 'k';
		$$i = 1;
		$orderby  = $order." ".$sort;

        $str = <<<str
<?php
			\$_params = array('limit'=>'$limit','orderby'=>'$orderby','channel_id'=>\$channel->channel_id);
			\$chaasql = getSql('$modulekey',\$_params);
	        \$chaa = new ChannelArticleTag();
		\$_chaalist = \$chaa->getChaArtList(\$chaasql);
	foreach (\$_chaalist as \$ckey=>\$channellist):	
            if (\$channellist->pic&&strpos(\$channellist->pic, NETADDRESS) === false){
                \$_chaalist[\$ckey]->pic = UPLOAD . \$channellist->pic;			
			}
            \$_chaalist[\$ckey]->url = NETADDRESS .'/'. \$channellist->channel_shortname .'/'. \$channellist->id . '.html';
            \$_chaalist[\$ckey]->purl = NETADDRESS .'/'. \$channellist->channel_shortname .'/';
			\$$i++;
?>
str;
        $str .= $content;
        $str .= '<?php endforeach;?>';
        $str .= '<?php unset($'.$i.',$channellist);?>';
        return $str;		
	}
//通过id获得相关的信息	
	public function _getone($attr, $content){
	 $table = isset($attr['table']) ? trim($attr['table']) : '';
     $id = isset($attr['id']) ? intval($attr['id']) : '';
     $relate = isset($attr['relate']) ? intval($attr['relate']) : '';
        $str = <<<str
<?php
			\$_params = array('table'=>'$table','relate'=>'$relate','id'=>'$id');
			\$onesql = getOneSql(\$_params);
	        \$one = new IntroduceService();
		\$getone = \$one->getRowTag(\$onesql);
		\$getone->pic = UPLOAD . \$getone->pic;
?>
str;
        $str .= $content;
        return $str;	 
	}
}
