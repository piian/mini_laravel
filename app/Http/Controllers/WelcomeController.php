<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Container\Container;

class WelcomeController
{
    public function index()
    {
        $user = User::first();
        // 获取服务容器实例
        $app = Container::getInstance();
        // 获取view的实例对象，即视图创建工厂类
        $view = $app->make('view');
        // 创建视图
        return $view->make('welcome')->with('user', $user);
        return $user;
        return 'welcome';
    }
}