<?php
/**
 * Created by PhpStorm.
 * User: Yxs <250915790@qq.com>
 * Date: 2019/5/6
 * Time: 19:50
 */

namespace XsKit\PassportClient\Contracts;


interface ApiContract
{
    /**
     * 返回 使用的驱动,为空时，使用默认配置中的驱动
     * @return string|null|void
     */
    public function driver();

    /**
     * 返回 要修改的 基础 uri， 使用配置文件可以返回 void
     * @return string|void
     */
    public function baseUri();

    /**
     * 返回 查询地址 （必须）
     * @return string
     */
    public function query();

    /**
     * 返回 查询参数
     * @return array
     */
    public function param();

    /**
     * 返回 访问凭证
     * @return string
     */
    public function token();

    /**
     * 返回 请求方式
     * @return string
     */
    public function method();

    /**
     * 请求头
     * @return array
     */
    public function headers();
}