<?php

namespace app\api\model;

class User extends BaseModel
{
    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
    public static function getByOpenID($openid)
    {
        $user = User::where('openid', '=', $openid)->find();
        return $user;
    }
    //关联地址
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }
}
