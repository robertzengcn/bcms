INSERT INTO `picmanager` (`name`,`flag`,`img`,`link`,`sort`,`kind`,`text`) VALUES ('答疑列表右侧图片','askPic','picmanager/20150316092256739.jpg','',1,1,NULL),('专家团队头部图片','doctor','picmanager/20150316100055242.jpg','',1,1,NULL),('页面头部图片','topPic','picmanager/20150112134809166.jpg','',1,1,NULL);
INSERT INTO `navigation` (`subject`,`url`,`layer`,`pid`,`sort`,`cate`,`is_display`,`name`,`pic`) VALUES ('首页','index.html',0,0,1,1,1,'index','nav/20150316092545427.gif'),('医院概况','hospital/introduce.html',0,0,1,1,1,'introduce','nav/20150316092545428.gif'),('新闻动态','hospital/news/index.html',0,0,1,1,1,'news','nav/20150316092545430.gif'),('权威专家','doctor/index.html',0,0,1,1,1,'doctor','nav/20150316092545431.gif'),('成功案例','hospital/success/index.html',0,0,1,1,1,'success','nav/20150316092545432.gif'),('特色疗法','technology/index.html',0,0,1,1,1,'technology','nav/20150316092545433.gif'),('问答系统','ask/index.html',0,0,1,1,1,'ask','nav/20150316092545434.gif'),('在线预约','reservation.html',0,0,1,1,1,'reservation','nav/20150316092545435.gif'),('联系我们','contact.html',0,0,1,1,1,'contact','nav/20150316092545436.gif');
INSERT INTO `navigation` (`subject`,`url`,`layer`,`pid`,`sort`,`cate`,`is_display`,`name`,`pic`) VALUES ('疾病导航','index.html',0,0,1,2,1,'disease','nav/20150316092545427.gif'),('首页','index.html',0,0,1,3,1,'index','nav/20150316092545427.gif');
INSERT INTO `picmanager` (`name`,`flag`,`img`,`link`,`sort`,`kind`,`text`) VALUES ('首页轮播','index','','',0,2,''),('轮播图','listPic','','',0,2,'');
INSERT INTO `picmanager` (`name`,`img`,`flag`,`link`,`sort`,`kind`)  VALUES ('弹窗1','picmanager/20150310112321306.png','special_one','http://www.qqyy.com','1','3');
INSERT INTO `picmanager` (`name`,`img`,`flag`,`link`,`sort`,`kind`)  VALUES ('商务通弹窗4','picmanager/20150310112321307.png','special_three','http://www.qqyy.com','1','6');
INSERT INTO `pic` (`pid`,`sort`,`url`,`pic`,`text`) VALUES ('21',1,'index.html','picmanager/20140902175915324.jpg','首页轮播图'),('21',2,'index.html','picmanager/20140902175915326.jpg','首页轮播图'),('21',1,'index.html','picmanager/20140902175915325.jpg','首页轮播图'),('21',1,'index.html','picmanager/20140902175915325.jpg','首页轮播图');
INSERT INTO `pic` (`pid`,`sort`,`url`,`pic`,`text`) VALUES ('22',1,'index.html','picmanager/20140902175915324.jpg','轮播图'),('22',2,'index.html','picmanager/20140902175915326.jpg','轮播图');
INSERT INTO `picmanager` (`name`,`flag`,`img`,`link`,`sort`,`kind`,`text`) VALUES ('手机LOGO', 'mobileLogo', 'picmanager/20150112134809166.png', '', '0', '1', '手机LOGO');