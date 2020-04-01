<?php

require __DIR__ . '/../vendor/autoload.php';

// 注册根目录
define('ROOT_PATH', __DIR__.'/../');

// 实例化容器
$app = new \Illuminate\Container\Container;

// 将服务容器实例添加为静态属性
Illuminate\Container\Container::setInstance($app);
// 这样就可以通过 Container::getInstance() 获取到$app

// 注册事件服务提供者
(new \Illuminate\Events\EventServiceProvider($app))->register();

// 注册路由服务提供者
(new \Illuminate\Routing\RoutingServiceProvider($app))->register();


// 启动Eloquent ORM模块并进行相关配置
$manager = new \Illuminate\Database\Capsule\Manager();
$connection = require ROOT_PATH.'config/database.php';
$manager->addConnection($connection); // 增加连接
$manager->bootEloquent();


// 将config名称与fluent类的实例进行绑定
$app->instance('config', new \Illuminate\Support\Fluent());
// 配置编译文件存储路径和视图模板文件存储路径
$app['config']['view.compiled'] = ROOT_PATH. "storage/framework/views/";
$app['config']['view.paths'] = [ROOT_PATH."resources/views"];
// 注册视图服务提供者
with(new \Illuminate\View\ViewServiceProvider($app))->register();
// 注册文件服务提供者
with(new \Illuminate\Filesystem\FilesystemServiceProvider($app))->register();

// 加载路由
require ROOT_PATH. 'app/Http/routes.php';

// 实例化请求
$request = \Illuminate\Http\Request::createFromGlobals();
// 分发处理请求
$response = $app['router']->dispatch($request);
// 返回请求响应
$response->send();