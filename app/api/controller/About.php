<?php


namespace app\api\controller;


use app\api\model\About as About_model;

class About
{
    public function detail(){
        $About_model = new About_model();
        $data = $About_model->detail();
        if(!empty($data)){
            return ['status'=>1,'data'=>$data,'msg'=>'关于我们内容获取成功'];
        }else{
            return ['status'=>0,'data'=>[],'msg'=>'关于我们内容不存在'];
        }
    }
}