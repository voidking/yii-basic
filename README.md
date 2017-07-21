# yii-basic
《yii框架实战》教程源码   

《yii框架实战》教程地址：http://www.voidking.com/2017/05/18/deve-yii-in-action/

# 安装
## 源码
`git clone https://github.com/voidking/yii-basic.git basic`

## 数据库
利用navicat等工具连接到本地mysql数据库，创建数据库basic，在数据库中创建表bas_project(int id, varchar title, varchar content)。注意，编码格式选择utf8。

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






