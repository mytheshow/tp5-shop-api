<?php


namespace app\api\controller\v1;


use app\api\model\User;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address
{
    public function createOrUpdateAddress(){
        $validate = new AddressNew();
        $validate->goCheck();
        //查询缓存
        $uid = TokenService::getCurrentUid();
        //查询数据表
        $user = User::get($uid);
        if(!$user){
            throw new UserException([
                'code' => 404,
                'msg' => '用户收获地址不存在',
                'errorCode' => 60001
            ]);
        }
        $userAddress = $user->address;
        // 根据规则取字段是很有必要的，防止恶意更新非客户端字段,把传过来的数据进行字段过滤
        $data = $validate->getDataByRule(input('post.'));
        //{"name":"LiDaKang","mobile":"18888888888","province":"汉东省","city":"北京市","country":"中国","detial":"中南海"}
        if (!$userAddress )
        {
            // 关联属性不存在，则新建https://www.kancloud.cn/manual/thinkphp5/142357
            $user->address()
                ->save($data);
        }
        else
        {
            // 存在则更新
//            fromArrayToModel($user->address, $data);
            // 新增的save方法和更新的save方法并不一样
            // 新增的save来自于关联关系
            // 更新的save来自于模型
            $user->address->save($data);
        }
        return new SuccessMessage();
    }
}