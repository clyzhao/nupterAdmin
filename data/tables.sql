CREATE TABLE reading(
id int(10) not null primary key auto_increment comment 'id',
title char(30) not null comment '文章标题',
author char(30) not null comment '文章作者',
tag char(30) not null comment '文章标签',
editorValue text not null comment '文章内容',
img_url1 text not null comment '图片链接1',
img_url2 text not null comment '图片链接2',
img_url3 text not null comment '图片链接3',
ifReprint char(10) not null comment '是否转载',
initial_url char(50) not null comment '原文链接',
ifPush char(10) not null comment '是否推送',
ifCarousel char(10) not null comment '是否轮播'
);