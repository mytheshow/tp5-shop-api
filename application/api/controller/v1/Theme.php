<?php


namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    public function getSimpleList($ids = '')
    {

        $validate = new IDCollection();
        $validate->goCheck();
        $ids = explode(',', $ids);
        //查询多条不能使用find
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        //$result是数据集
        if ($result->isEmpty()) {
            throw new ThemeException();
        }

        return $result;
    }
    //主题详情
    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if(!$theme){
            throw new ThemeException();
        }
        //$theme是数据集最后要转换为字符串
        //为什么不在model隐藏？因为只有该路由才隐藏summary
        return $theme->hidden(['products.summary'])->toArray();
    }
}