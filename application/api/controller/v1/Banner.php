<?php
namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;


class Banner {
    public function  getBanner($id){
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $res = BannerModel::getBannerByID($id);
        return $res;
    }
}