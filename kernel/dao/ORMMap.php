<?php
define('TABLENAME_ARTICLE', 'article');
define('TABLENAME_ASK', 'ask');
define('TABLENAME_ANSWER', 'answer');
define('TABLENAME_ASKDESC', 'askdesc');
define('TABLENAME_ASKASSAY', 'askassay');
define('TABLENAME_ASKADDTO', 'askaddto');
define('TABLENAME_BUISNESS', 'buisness');
define('TABLENAME_CHANNEL', 'channel');
define('TABLENAME_CHANNELARTICLE', 'channelarticle');
define('TABLENAME_CONTACT', 'contact');
define('TABLENAME_CATEGORY', 'category');
define('TABLENAME_DEPARTMENT', 'department');
define('TABLENAME_DEPARTMENTMANAGER', 'resdepartment');
define('TABLENAME_DEVICE', 'device');
define('TABLENAME_DISEASE', 'disease');
define('TABLENAME_ZMDATA', 'zmdata');
define('TABLENAME_DOCTOR', 'doctor');
define('TABLENAME_COUNTERHISTORY', 'counterhistory');
define('TABLENAME_MARKHISTORY', 'markhistory');
define('TABLENAME_DOCTORMANAGER', 'resdoctor');
define('TABLENAME_DOCTORTODISEASE', 'doctortodisease');
define('TABLENAME_ENVIORMENT', 'environment');
define('TABLENAME_ERRORPAGE', 'errorpage');
define('TABLENAME_HONOR', 'honor');
define('TABLENAME_INSPECTION', 'inspection');
define('TABLENAME_INSPECTIONITEM', 'inspectionitem');
define('TABLENAME_INTRODUCE', 'introduce');
define('TABLENAME_LINK', 'link');
define('TABLENAME_MEDIAREPORT', 'mediareport');
define('TABLENAME_MOVIE', 'movie');
define('TABLENAME_NAVIGATION', 'navigation');
define('TABLENAME_NAVGROUP', 'navgroup');
define('TABLENAME_NEWS', 'news');
define('TABLENAME_PICMANAGER', 'picmanager');
define('TABLENAME_PIC', 'pic');
define('TABLENAME_RECOMMENDLIST', 'recommendlist');
define('TABLENAME_RECOMMENDPOSITION', 'recommendposition');
define('TABLENAME_SEO', 'seo');
define('TABLENAME_STATISTICSLOG', 'statisticslog');
define('TABLENAME_SUCCESS', 'success');
define('TABLENAME_TAG', 'tag');
define('TABLENAME_TECHNOLOGY', 'technology');
define('TABLENAME_THIRDSTAT', 'thirdstat');
define('TABLENAME_TOPIC', 'topic');
define('TABLENAME_WORKER', 'worker');
define('TABLENAME_WORKER_LOG_HISTORY', 'workerloghistory');
define('TABLENAME_WORKHISTORY', 'workhistory');
define('TABLENAME_USERVAR', 'uservar');
define('TABLENAME_USER_TOKEN', 'usertoken');
define('TABLENAME_NETWORKPIC', 'networkpic');
define('TABLENAME_RESERVATION', 'resvation');
define('TABLENAME_RESERUSER', 'reseruser');
define('TABLENAME_RESERVATIONDETAIL', 'resbookinginfo');
define('TABLENAME_RESERTEMPLATE', 'restemplate');//预约挂号医生排班模板
define('TABLENAME_RESERTEMPLATEDETAIL', 'resschedule');//预约挂号排班信息
define('TABLENAME_SPITEIP', 'spiteip');
define('TABLENAME_MOBILENAVIGATION','mobilenavigation');
define('TABLENAME_MOBILEPICMANAGER','mobilepicmanager');
define('TABLENAME_LIBRARY','library');
define('TABLENAME_COMMODITY','commodity');
define('TABLENAME_COMMODITYCART','commoditycart');
define('TABLENAME_COMMODITYCATEGORIES','commoditycategories');
define('TABLENAME_COMMODITYDESCRIPT','commoditydescript');
define('TABLENAME_COMMODITYRULE','commodityrule');
define('TABLENAME_COMMODITYADDSCORELOG','commodityaddscorelog');
define('TABLENAME_COMMODITYSCOREREDUCE','commodityscorereduce');
define('TABLENAME_MEMBER','member');
define('TABLENAME_DRAW','draw');
define('TABLENAME_DRAWLOG','drawlog');
define('TABLENAME_DRAWPRIZE','drawprize');
define('TABLENAME_DRAWWINLOG','drawwinlog');
define('TABLENAME_PRIZEOWN','prizeown');
define('TABLENAME_BOYIMANAGER','boyimanager');
define('TABLENAME_WEIBO','weibo');
define('TABLENAME_FEEDBACK','feedback');
define('TABLENAME_HM_TOKEN','hmtoken');
define('TABLENAME_COMMODITYLOG','commoditylog');
define('TABLENAME_COMMODITYORDER','commodityorder');
define('TABLENAME_COMMODITYKEY','commoditykey');
define('TABLENAME_PHYSICALEXAM','physicalexam');
define('TABLENAME_PATIENTCHECK','patientcheck');//检验报告单保存的数据库
define('TABLENAME_VOTE','vote');
define('TABLENAME_VOTEITEM','voteitem');
define('TABLENAME_VOTEWXSZ','votewxsz');
define('TABLENAME_VOTEWXUSER','votewxuser');
define('TABLENAME_VOTELOG','votelog');
define('TABLENAME_VOTEPRIZE','voteprize');
define('TABLENAME_VOTESTATISTICSLOG','votestatisticslog');
define('TABLENAME_INTERFACE_ASK','interface_ask');
define('TABLENAME_DOWNLOAD','download');
define('TABLENAME_PATIENTDATA','patientdata');
define('TABLENAME_CLIENT','client');
define('TABLENAME_CLIENTDATA','clientdata');
define('TABLENAME_WORKERGROUP', 'workergroup');
define('TABLENAME_CONSUMPTIONLOG', 'consumptionlog');
define('TABLENAME_RESVATIONDATA', 'resvationdata');
define('TABLENAME_SHOWSCENE', 'showscene');
define('TABLENAME_SHOWTAG', 'showtag');
define('TABLENAME_SHOWSHARE', 'showshare');
define('TABLENAME_SHOWSCENEPAGE', 'showscenepage');
define('TABLENAME_SHOWSCENEPAGESYS', 'showscenepagesys');
define('TABLENAME_SHOWUPFILE', 'showupfile');
define('TABLENAME_SHOWSYS', 'showsys');
define('TABLENAME_SHOWSCENEDATA', 'showscenedata');
define('TABLENAME_SHOWUPFILESYS', 'showupfilesys');
class ORMMap {

    /**
     * R::getAll( 'SELECT * FROM page WHERE title = :title', [':title' => 'home'] );
     * sql语句映射
     */
    static $sqlMap = Array(
        // StatisticsLogDAO selFrom()
        'selFrom' => 'SELECT `fromurl`,count(`fromurl`) as num FROM statisticslog WHERE 1=1  group by `fromurl` having count(`fromurl`)>0 order by num desc limit 10',
        // StatisticsLogDAO selTo()
        'selTo' => 'SELECT `url`,count(`url`) as num FROM statisticslog WHERE 1=1  group by `url` having count(`url`)>0 order by num desc limit 10',
        // StatisticsLogDAO distributed()
        'getOldIP' => 'select count(distinct(ip)) as count from statisticslog where visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO distributed()
        'getNewIP' => 'select distinct(ip) as ip from statisticslog where visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO distributed()
        'getIPByTime' => 'select id from statisticslog where ip = :ip and visittime < :star_time ',
        // StatisticsLogDAO trend()
        'fwnum' => 'select count(id) as count from statisticslog where visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO trend()
        'ipnum' => 'select count(distinct(ip)) as count from statisticslog where visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO trend()
        'dlnum' => 'select count(distinct(sessionid)) as count from statisticslog where visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO trend()
        'fwnumu' => 'select count(id) as count from statisticslog where url = :url and visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO trend()
        'ipnumu' => 'select count(distinct(ip)) as count from statisticslog where url = :url and visittime >= :star_time and visittime < :end_time ',
        // StatisticsLogDAO trend()
        'dlnumu' => 'select count(distinct(sessionid)) as count from statisticslog where url = :url and visittime >= :star_time and visittime < :end_time ',
        // NavigationDAO getDepartments()
        'navDepartments' => 'SELECT id,name,url FROM department ',
        // NavigationDAO getDisease()
        'navDisease' => 'SELECT department_id,name,url FROM disease ',
        // NavigationDAO getNameByUrl()
        'navNameByUrlDepartments' => 'SELECT name FROM department where url = :url ',
        // NavigationDAO getNameByUrl()
        'navNameByUrlDisease' => 'SELECT name FROM disease where url=:url ',
        // ChannelDAO delete() deleteBatch()
        'deleteChannelArticleByChannelId' => 'delete from channelarticle where channel_id = :channel_id ',
        // 案列表
        'success_relation' => 'SELECT success.*,disease.name as disease_name from success left join disease on success.disease_id = disease.id',
        // 医生表
        'doctor_relation' => 'select doctor.id,doctor.department.id,department.name as department_name from doctor left join department on doctor.department_id=department.id',
        //医生管理表（新增）
        'doctormanager_relation' => 'select resdoctor.*,resdepartment.name as department_name from resdoctor left join resdepartment on resdoctor.department_id=resdepartment.id',
        // 疾病表
        'disease_relation' => 'select disease.*,department.name as department_name from disease left join department on disease.department_id=department.id',
        // 咨询表
        'article_relation' => 'select article.*,worker.name as author,doctor.name as doctor_name,disease.name as disease_name,department.name as department_name from article left join worker on article.worker_id = worker.id left join doctor on article.doctor_id=doctor.id left join disease on article.disease_id=disease.id left join department on article.department_id=department.id',
        // 咨询表(html)
        'article_makehtml' => 'select id,subject,title,keywords,description,plushtime,updatetime,disease_id,department_id from article',
        // 技术表
        'technology_relation' => 'select technology.*,department.name as department_name from technology left join department on technology.department_id = department.id',
        // 在线问答:回复(ask、askdesc、answer->content、askassay)
        'ask_repeat' => 'select ask.*,askdesc.*,department.name as department_name,answer.id as answer_id,answer.doc_id as doctorID,answer.content as content,askassay.* from ask left join askdesc on ask.id = askdesc.ask_id left join department on department.id = ask.department_id left join answer on answer.ask_id = ask.id left join askassay on askassay.ask_id = ask.id',
        // 在线问答:列表(ask、askdesc、department、disease)
        'ask_list' => 'select askdesc.*,ask.*,department.name as department_name,disease.name as disease_name from ask left join askdesc on ask.id = askdesc.ask_id left join department on department.id = ask.department_id left join disease on disease.id = ask.disease_id',
        'reservationjoin'=>'SELECT r. * , resdoctor.name AS doctor, de.name AS department FROM resvation AS r LEFT JOIN resdoctor ON r.doctor_id = resdoctor.id LEFT JOIN resdepartment AS de ON de.id = r.department_id',
        'resercount'=>'SELECT COUNT(r.id) as num FROM reservation AS r LEFT JOIN doctormanager ON r.doctor_id = doctormanager.id LEFT JOIN departmentmanager AS de ON de.id = r.department_id',
        //'resertemp'=>'SELECT r.*,de.name as department from resertemplate as r left join departmentmanager as de on r.department_id=de.id',
        'resershow'=>'SELECT r.*, de.name as department, do.name as doctor from reservation as r LEFT JOIN departmentmanager AS de on r.department_id=de.id LEFT JOIN doctormanager AS do ON r.doctor_id = do.id',
        'commoditycate'=>'SELECT * from commoditycategories',
        'memberdetail'=>'SELECT m.*, mc.totalscore as score, mc.totalcash as cash,ml.date FROM member as m LEFT JOIN commoditylog AS mc ON m.id=mc.uid LEFT JOIN commodityaddscorelog AS ml on ml.uid=m.id',
        //条件查询数量
        'memberdetailcount'=>'SELECT COUNT(*) as num FROM member as m LEFT JOIN commodityaddscorelog AS ml on ml.uid=m.id',
        //会员积分数量
        'memberscorelogcount'=>'SELECT COUNT(*) as num FROM commodityaddscorelog as ms LEFT JOIN member AS m on ms.uid=m.id LEFT JOIN commodityrule AS st on ms.type=st.id',
        //取记录表里已存在的独特的type
        'memberdistinctlog'=>'SELECT DISTINCT ml.type, st.name from commodityaddscorelog as ml LEFT JOIN commodityrule as st on ml.type=st.id',
        //抽奖活动查询
        'drawactivity'=>'select d.*, (select count(drawprize.id) from drawprize where d.id=drawprize.drawid)  as num from draw as d',
        'drawcount'=>'select count(*)  as dm from draw',
        //抽奖活动总数查询	
        'drawactivitynum'=>'select count(*) num from draw as d LEFT JOIN drawprize as p on d.id=p.drawid',
        'winlogquery'=>'SELECT w.*, p.name as prize, p.takeway as takeway, p.img as img,m.username as username, m.telephone as telephone, d.name as draw FROM drawwinlog as w LEFT JOIN drawprize as p ON w.prize_id=p.id LEFT JOIN member as m ON w.member_id=m.id LEFT JOIN draw as d ON w.draw_id=d.id',
        'winlognum'=>'SELECT count(*) as num FROM drawwinlog as w LEFT JOIN drawprize as p ON w.prize_id=p.id LEFT JOIN member as m ON w.member_id=m.id LEFT JOIN draw as d ON w.draw_id=d.id',
        'drawname'=>'SELECT id,name FROM draw',
        'cartinfo'=>'SELECT c.*,m.username as username,co.subject as name,co.score as score, co.price as price,co.exchange as exchange,co.pic as pic FROM commoditycart as c LEFT JOIN member as m ON c.member_id=m.id LEFT JOIN commodity as co ON c.commodity_id=co.id',
        'orderdetail'=>'SELECT o.*,oc.* FROM `order` as o LEFT JOIN `ordercommodity` AS oc ON o.id=oc.order_id',
        'drawshow'=>'select d.* from draw as d',
        'summemberscore'=>'select sum(score) as total from commodityaddscorelog',
    	//搜索
    	'news_search' => 'select id,subject from news ',
    	'mediareport_search' => 'select id,subject from mediareport ',
    	'moive_search' => 'select id,subject from movie ',
    	'technology_search' => 'select id,subject from technology ',
    	'success_search' => 'select id,subject from success ',
    	'article_search' => 'select article.id,article.subject,disease.url as disease_url,department.url as department_url from article  left join disease on article.disease_id=disease.id left join department on article.department_id=department.id',
		//投票
		'common_fields_vote'=>'id,title,statdate,enddate,start_time,over_time,status,checks',
		'common_fields_voteitem'=>'id,vid,item,dcount,vcount,phone,status,addtime',
		'list_fields_voteitem'=>'id,vid,item,vcount,startpicurl1,dcount',
		'list_voteitem'=>'select id,vid,item,vcount,startpicurl1,dcount from voteitem where vid=:vid and status=1 order by :order desc limit :n,:m',
		'list_voteitem_dcount'=>'select id,vid,item,vcount,startpicurl1,dcount from voteitem where vid=:vid and status=1 order by dcount desc limit 8',
		'list_voteitem_vcount'=>'select id,vid,item,vcount,startpicurl1,intro from voteitem where vid=:vid and status=1 order by vcount desc limit 10',
        'vote_title' => 'select title from vote where id=:id ',
        'vote_title_all' => 'select id,title from vote where enddate>:enddate order by id desc',
        'voteitem_id' => 'select id,dcount from voteitem where vid=:vid and status=1 order by id asc',
        'voteitem_id_all' => 'select id from voteitem where vid=:vid order by id desc',
        'voteitem_vdcount'=>'select sum(vcount) as vcount,sum(dcount) as dcount from voteitem where vid=:vid',
		'voteitem_mingci'=>'select count(1) as mingci from voteitem where vcount >=(select vcount from voteitem where id=:id)',
        'votelog_count'=>'select count(*) from votelog where openid=:openid and tp_time >:stime and tp_time <:etime',
        'getVotes' => 'select sum(total_votes) as vcount from votestatisticslog where tj_time >= :star_time and tj_time < :end_time ',
        'getSignUpStatus' => 'select status,id from voteitem where vid=:vid and wechat_id=:openid',
		//通用字段查询
		'common_fields' => 'id,subject,description,plushtime,click_count,pic',
		'receptionlistcheck'=>'select c.*,pt.nick_name as reception_name from clientrecord as c LEFT JOIN worker as pt ON c.reception_id=pt.id where c.client_id=:client_id',	
		'workerlist'=>'select id,nick_name as user_name from worker',
		//秀场 
		'scenelist'=> 'select id,userid_int,movietype_int,musicurl_varchar,desc_varchar,scenecode_varchar,hitcount_int,scenename_varchar,scenetype_int,thumbnail_varchar,showstatus_int,musictype_int from showscene where id=:id and delete_int=:delete_int and userid_int=:userid_int',
        'scenepages' => 'select id,scenecode_varchar,sceneid_bigint,pagecurrentnum_int,content_text,properties_text from showscenepage where id=:id and userid_int=:userid_int',
        'scenepage' => 'select id,sceneid_bigint,pagecurrentnum_int,pagename_varchar from showscenepage where sceneid_bigint=:sceneid_bigint and mytypl_id=:mytypl_id and userid_int =:userid_int order by pagecurrentnum_int asc',
        'scenepage2' => 'select id,sceneid_bigint,pagecurrentnum_int,properties_text,content_text from showscenepage where sceneid_bigint=:sceneid_bigint and userid_int =:userid_int order by pagecurrentnum_int asc',
		'upfilelist'=>'select id,name_varchar,biztype_int from showtag where userid_int=:userid_int and type_int=:type_int and biztype_int=:biztype_int order by id asc',
		'syspagetpl'=>'select id,thumbsrc_varchar from showscenepagesys where tagids_int>0 and userid_int=:userid_int and tagid_int=:tagid_int order by pagecurrentnum_int desc,id desc',
		'syspageinfo'=>'select id,thumbsrc_varchar,content_text from showscenepagesys where id=:id',
		'pagetplsys'=>'select id,filethumbsrc_varchar from showupfilesys where 1=1 and filetype_int=:filetype_int order by id asc',
		'catetypelist'=>'select id,title,value,type from showcate where 1=1 and type=:type order by sort asc,id asc',
    );

    /**
     * 数据库表映射实体类
     *
     * @var unknown
     */
    static $classes = Array(
        TABLENAME_ARTICLE => 'Article',
        TABLENAME_ASK => 'Ask',
        TABLENAME_ANSWER => 'Answer',
        TABLENAME_ASKDESC => 'AskDesc',
        TABLENAME_ASKASSAY => 'AskAssay',
        TABLENAME_ASKADDTO => 'AskAddto',
        TABLENAME_BUISNESS => 'Business',
        TABLENAME_CHANNEL => 'Channel',
        TABLENAME_CHANNELARTICLE => 'ChannelArticle',
        TABLENAME_CONTACT => 'Contact',
        TABLENAME_CATEGORY => 'Category',
        TABLENAME_DEPARTMENT => 'Department',
    	TABLENAME_DEPARTMENTMANAGER => 'ResDepartment',
        TABLENAME_DEVICE => 'Device',
        TABLENAME_DISEASE => 'Disease',
        TABLENAME_DOCTOR => 'Doctor',
        TABLENAME_DOCTORTODISEASE => 'DoctorToDisease',
        TABLENAME_ENVIORMENT => 'Environment',
        TABLENAME_ERRORPAGE => 'ErrorPage',
        TABLENAME_HONOR => 'Honor',
        TABLENAME_INSPECTION => 'Inspection',
        TABLENAME_INSPECTIONITEM => 'Inspectionitem',
        TABLENAME_INTRODUCE => 'Introduce',
        TABLENAME_LINK => 'Link',
        TABLENAME_MEDIAREPORT => 'MediaReport',
        TABLENAME_MOVIE => 'Movie',
        TABLENAME_NAVIGATION => 'Navigation',
        TABLENAME_NAVGROUP => 'Navgroup',
        TABLENAME_NEWS => 'News',
        TABLENAME_PICMANAGER => 'PicManager',
        TABLENAME_PIC => 'Pic',
        TABLENAME_RECOMMENDLIST => 'RecommendList',
        TABLENAME_RECOMMENDPOSITION => 'RecommendPosition',
        TABLENAME_RESERTEMPLATEDETAIL=>'ResSchedule',
        TABLENAME_SEO => 'Seo',
        TABLENAME_STATISTICSLOG => 'StatisticsLog',
        TABLENAME_SUCCESS => 'Success',
        TABLENAME_TAG => 'Tag',
        TABLENAME_TECHNOLOGY => 'Technology',
        TABLENAME_THIRDSTAT => 'ThirdStat',
        TABLENAME_TOPIC => 'Topic',
        TABLENAME_WORKER => 'Worker',
        TABLENAME_WORKER_LOG_HISTORY => 'WorkerLogHistory',
        TABLENAME_WORKHISTORY => 'WorkHistory',
        TABLENAME_USERVAR => 'UserVar',
        TABLENAME_NETWORKPIC => 'NetworkPic',
        TABLENAME_RESERVATION => 'ResVation',
        TABLENAME_SPITEIP => 'SpiteIP',
        TABLENAME_MOBILENAVIGATION => 'MobileNavigation',
    	TABLENAME_MOBILEPICMANAGER => 'MobilePicManager',
    	TABLENAME_RESERTEMPLATE=>'ResTemplate',
    	TABLENAME_LIBRARY => 'Library',
    	TABLENAME_RESERVATIONDETAIL => 'ResBookingInfo',
        TABLENAME_COMMODITY => 'Commodity',
        TABLENAME_COMMODITYCATEGORIES => 'CommodityCategories',
        TABLENAME_COMMODITYRULE => 'CommodityRule',
		TABLENAME_COMMODITYADDSCORELOG=>'CommodityAddScoreLog',       
        TABLENAME_DRAW=>'Draw',
        TABLENAME_DRAWPRIZE=>'DrawPrize',
		TABLENAME_DRAWLOG=>'DrawLog',
        TABLENAME_COMMODITYCART=>'CommodityCart',
        TABLENAME_DOCTORMANAGER=>'ResDoctor',        
    	TABLENAME_FEEDBACK =>'Feedback',
    	TABLENAME_COMMODITYLOG =>'CommodityLog',
		TABLENAME_COMMODITYORDER =>'CommodityOrder',
		TABLENAME_COMMODITYKEY=>'CommodityKey',
        TABLENAME_PHYSICALEXAM=>'Physicalexam',
		TABLENAME_COMMODITYKEY=>'CommodityKey',
		TABLENAME_DRAWWINLOG=>'DrawWinlog',
		TABLENAME_PATIENTCHECK=>'PatientCheck',
		TABLENAME_VOTE=>'Vote',
		TABLENAME_VOTEITEM=>'VoteItem',
		TABLENAME_VOTEWXSZ=>'VoteWxsz',
		TABLENAME_VOTEWXUSER=>'VoteWxUser',
		TABLENAME_VOTELOG=>'VoteLog',
		TABLENAME_VOTEWXSZ=>'VoteWxsz',
		TABLENAME_VOTEPRIZE=>'VotePrize',
		TABLENAME_VOTESTATISTICSLOG=>'VoteStatisticsLog',
		TABLENAME_DOWNLOAD=>'Download',
		TABLENAME_PATIENTDATA=>'PatientData',
		TABLENAME_CLIENT=>'Client',
		TABLENAME_CLIENTDATA=>'ClientData',
		TABLENAME_WORKERGROUP=>'WorkerGroup',
        TABLENAME_RESVATIONDATA=>'ResVationData',
		TABLENAME_SHOWSCENE=>'ShowScene',
		TABLENAME_SHOWTAG=>'ShowTag',
		TABLENAME_SHOWSCENEPAGE=>'ShowScenePage',
		TABLENAME_SHOWSCENEPAGESYS=>'ShowScenePageSys',
		TABLENAME_SHOWUPFILE=>'ShowUpfile',
		TABLENAME_SHOWSYS=>'ShowSys',
		TABLENAME_SHOWUPFILESYS=>'ShowUpfilesys',
		TABLENAME_SHOWSHARE =>'ShowShare',
		TABLENAME_SHOWSCENEDATA=>'ShowSceneData',
    );
}