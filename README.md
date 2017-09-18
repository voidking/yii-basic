# yii-basic
《yii框架实战》教程源码   

《yii框架实战》教程地址：http://www.voidking.com/2017/05/18/deve-yii-in-action/

# 安装
## 源码
`git clone https://github.com/voidking/yii-basic.git basic`

## 数据库
利用navicat等工具连接到本地mysql数据库，创建数据库basic，字符集选择`utf8 -- UTF-8 Unicode`，排序规则选择`utf8_general_ci`。然后导入basic.sql文件。

# 测试url
## 安装成功
http://localhost/basic/web/index.php 

## helloworld
http://localhost/basic/web/index.php?r=site/say&message=helloworld

## 路由控制
该URL，如果变形成 http://localhost/basic/web/index.php/site/say?message=helloworld ，是不是好看很多？

该URL，如果变形成 http://localhost/basic/web/site/say?message=helloworld ，是不是更好看？

该URL，如果变形成 http://localhost/basic/web/say?message=helloworld ，是不是更好看？

该URL，如果变形成 http://localhost/basic/web/say/helloworld ，是不是更好看？

## 模板渲染
http://localhost/basic/web/site/template

## 增删改查
1、添加：http://localhost/basic/web/project/add?title=voidking-title&content=voidking-content   

2、修改：http://localhost/basic/web/project/edit?id=1&title=voidking-title&content=voidking-content   

3、查找全部：http://localhost/basic/web/project/list   

4、查找一页：http://localhost/basic/web/project/page?pageSize=10&pageNum=1   

5、查找一条：http://localhost/basic/web/project/find?id=1   

6、删除：http://localhost/basic/web/project/delete?id=1   

## 验证码
获取验证码：http://localhost/basic/web/util/captcha/getcode   

验证验证码：http://localhost/basic/web/util/captcha/check?code=f7nh

验证码测试：http://localhost/basic/web/util/captcha/index

# 线上部署

## 404
线上部署时，发现除了首页，其他页面都是404。此时，就需要修改apache或者nginx的配置。   

### 推荐使用的 Apache 配置
在 Apache 的 httpd.conf 文件或在一个虚拟主机配置文件中使用如下配置。 注意，你应该将 path/to/basic/web 替换为实际的 basic/web 目录。  

设置文档根目录为 "basic/web"
```
<Directory "path/to/basic/web">
    # 开启 mod_rewrite 用于美化 URL 功能的支持（译注：对应 pretty URL 选项）
    RewriteEngine on
    # 如果请求的是真实存在的文件或目录，直接访问
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # 如果请求的不是真实文件或目录，分发请求至 index.php
    RewriteRule . index.php

    # ...其它设置...
</Directory>
```

### 推荐使用的 Nginx 配置

为了使用 Nginx，你应该已经将 PHP 安装为 FPM SAPI 了。 你可以使用如下 Nginx 配置，将 path/to/basic/web 替换为实际的 basic/web 目录， mysite.local 替换为实际的主机名以提供服务。
```
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name mysite.local;
    root        /path/to/basic/web;
    index       index.php;

    access_log  /path/to/basic/log/access.log;
    error_log   /path/to/basic/log/error.log;

    location / {
        # Redirect everything that isn't a real file to index.php
        try_files $uri $uri/ /index.php$is_args$args;
    }

    # uncomment to avoid processing of calls to non-existing static files by Yii
    #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
    #    try_files $uri =404;
    #}
    #error_page 404 /404.html;

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass 127.0.0.1:9000;
        #fastcgi_pass unix:/var/run/php5-fpm.sock;
        try_files $uri =404;
    }

    location ~* /\. {
        deny all;
    }
}
```

使用该配置时，你还应该在 php.ini 文件中设置 cgi.fix_pathinfo=0 ， 能避免掉很多不必要的 stat() 系统调用。  

还要注意当运行一个 HTTPS 服务器时，需要添加 fastcgi_param HTTPS on; 一行， 这样 Yii 才能正确地判断连接是否安全。  

## Database Exception
使用数据库时，报错：
```
Database Exception – yii\db\Exception

SQLSTATE[HY000] [2002] No such file or directory

Caused by: PDOException

SQLSTATE[HY000] [2002] No such file or directory

in /var/www/html/basic/vendor/yiisoft/yii2/db/Connection.php at line 630
```

这个是由于默认将PHP.ini中的以下三项留空导致的，YII2所需的PDO组建无法找到mysql.sock(或mysqld.sock)文件地址。
```
mysql.default_socket = 
pdo_mysql.default_socket =
mysqli.default_socket =
```

解决办法：
1、找到sock文件位置
`ps aux | grep mysql`

2、编辑php.ini（默认位置/etc/php.ini）

```
mysql.default_socket = /usr/local/mysql/data/mysql.sock
pdo_mysql.default_socket = /usr/local/mysql/data/mysql.sock
mysqli.default_socket = /usr/local/mysql/data/mysql.sock
```

3、重启apache
`systemctl restart httpd`

# 书签
[安装 Yii](http://www.yiichina.com/doc/guide/2.0/start-installation)






