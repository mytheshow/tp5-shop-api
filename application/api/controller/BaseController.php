<?php


namespace app\api\controller;
use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    //检查排除管理员，即只有用户自己才能调用下单接口
    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }
    //用户或者超级管理员调用
    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }
    //超级管理员调用的接口
    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }
}