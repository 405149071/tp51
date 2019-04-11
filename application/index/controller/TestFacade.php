<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Facade;
use app\common\Test;


class TestFacade extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        // 1 .正常调用
        $test = new Test();
        echo $test->hello('正常调用<br/>');
        // 2. 静态代理调用，静态方法调用，
        echo \app\facade\TestFacade::hello("静态方法调用</br>");
        // 3. 动态绑定调用 ，代理类TestFacade1空代码
        Facade::bind('app\facade\TestFacade1', 'app\common\Test');
        echo \app\facade\TestFacade1::hello('动态绑定调用');

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
