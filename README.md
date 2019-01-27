laravel-admin extension
======

## 前提
首先要正确安装 laravel-admin ,参考官网：https://laravel-admin.org/docs/zh/installation

## 简介
这个扩展用来基于 laravel-admin 快速搭建一个问题与答案系统，用于试卷或者问卷的快速制作与管理。
同时含有用户提交答题的 api，这可以很方便前端人员开发。

## 后台功能截图
试卷列表
![Image text](https://raw.githubusercontent.com/xdli-ch/img-folder/master/1.png)
编辑试卷
![Image text](https://raw.githubusercontent.com/xdli-ch/img-folder/master/3.png)
用户答题
![Image text](https://raw.githubusercontent.com/xdli-ch/img-folder/master/4.png)

## api路由截图
![Image text](https://raw.githubusercontent.com/xdli-ch/img-folder/master/api.png)

## 安装

1>  
```php
composer require xdli/q_and_a;
```

2>
```php  
php artisan vendor:publish --provider="Xdli\Q_And_A\Q_And_AServiceProvider";
```

3> 
```php 
php artisan q_and_a:install;
```

4> 
```php 
php artisan migrate;
```  
说明：该命令创建 试卷表q_a_paper 、问题答案表 q_a_question、用户答题记录表 q_a_user_trains

## 注意
关于后台页面中的【添加试卷】和【编辑试卷】都是自定义的视图view文件,由命令 
php artisan vendor:publish --provider="Xdli\Q_And_A\Q_And_AServiceProvider" 生成，
对应的 视图xxx.blade.php 文件 参考：resources/view/vendor/q_and_a目录中。
对应的 js 和 css 参考：public/vendor/q_and_a目录中。
如果有需要，可以自己更改上述文件

xxx.blade.php 中用到了 laravel-admin 自带的 Bootstrap3 的 标签tabs组件。如果你的 laravel-admin 已经使用了Bootstrap4，请更改 resources/view/vendor/q_and_a/xxx.blade.php 
文件中的标签tabs组件相应代码。

## 访问
### web
**【试卷列表】**： /admin/q_and_a  
**【创建试卷】**： /admin/q_and_a/create  
**【用户答题】**： /admin/user_qa

### api
**【获取试卷类别】**：/q_and_a/papers/type  get请求  
**【获取试卷等级】**：/q_and_a/level  get请求  
**【筛选查询试卷】**：/q_and_a/search  get请求  
>传参:  
type //试卷类别   <可选>  
train_level //试卷等级 <可选>  
title //试卷标题 <可选，支持模糊匹配>`
  
**【获取试卷详情】**：/q_and_a/paper/(paper_id) get请求   
>说明: 如果参数paper_id 为空的话，默认返回试卷库中的status为1的第一张试卷`  

**【用户提交答卷(交卷)】**: /q_and_a/save_train  post请求  
>传参:  
paper_id   //试卷 id  
all_use_time   //用时 s  
answers  //答案  格式：answers = '{"question_id":"value","question_id":"value"}' ，即： json字符串格式  
例如：'{"78":"a","79":"c","80":"c"}'
`



