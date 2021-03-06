<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-10-10 13:43:19
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:08:05
 */
namespace app\api\controller;

use \think\Db;

class Commission
{
    public function list(){
        $user_id = get_token();
        $matron = Db::name('matron')->field(['id'])->where('user_id',$user_id)->find();
        if(!$matron){
            msg(0,'该用户不存在');
        }
        $data = Db::name('commission_log')->field(['ordersn','commission','days','create_time'])->where('matron_id',$matron['id'])->order('id desc')->select();
        if(!$data){
            return ['status'=>0,'data'=>[]];
        }
        $total = 0;
        foreach($data as $k => $v){
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
            $total += $v['commission']; 
        }
        $total = sprintf("%01.2f", $total);
        if(explode('.',$total)[1] == '00'){
            $total = explode('.',$total)[0];
        }
        return ['status'=>1,'data'=>$data,'total'=>$total];
    }
}