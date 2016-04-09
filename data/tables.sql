CREATE TABLE adminUser(
id int(16) not null primary key auto_increment comment '评论ID',
account  varchar(30) not null comment '用户账户',
passwd   varchar(30) not null comment '用户密码',
nickName varchar(30) not null comment '用户昵称',
img_url varchar(500) not null DEFAULT "http://q.qlogo.cn/qqapp/1104971762/8330FCB7D8A21842F8008A13D163394B/100" comment '用户头像',
createTime varchar(30) not null comment '评论时间',
updateTime varchar(30) not null comment '更新时间'
);

CREATE TABLE reading(
id int(10) not null primary key auto_increment comment 'id',
title varchar(30) not null comment '文章标题',
author varchar(30) not null comment '文章作者',
author_img varchar(200) not null comment '作者头像',
tag varchar(30) not null comment '文章标签',
des varchar(150) not null comment '文章描述',
editorValue varchar(5000) not null comment '文章内容',
img_url1 varchar(500) not null comment '图片链接1',
img_url2 varchar(500) not null comment '图片链接2',
img_url3 varchar(500) not null comment '图片链接3',
img_num  int(2) not null comment '图片数量',
isReprint int(1) not null comment '是否转载',
initial_url varchar(500) not null comment '原文链接',
isPush int(1) not null comment '是否推送',
createTime char(30) not null comment '创建时间'
);

CREATE TABLE carousels(
id int(10) not null primary key auto_increment comment 'id',
title char(30) not null comment '标题',
author char(30) not null comment '作者',
author_img varchar(200) not null comment '作者头像',
tag char(30) not null comment '标签',
des varchar(150) not null comment '描述',
editorValue varchar(5000) not null comment '内容',
img_url1 varchar(500) not null comment "轮播图",
isReprint int(1) not null comment '是否转载',
initial_url char(50) not null comment '原文链接',
isPush int(1) not null comment '是否推送',
createTime char(30) not null comment '创建时间'
);