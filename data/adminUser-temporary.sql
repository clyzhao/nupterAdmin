CREATE TABLE adminUser(
id int(10) not null primary key auto_increment comment 'id',
account char(20) not null comment '账户',
password char(20) not null comment '密码'
);