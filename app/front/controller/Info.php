<?php
/*
开奖结果比兑用户投注,根据开奖赔率赔付用户
*/
namespace app\front\controller;
use think\Controller;
use think\Config;
use think\Session;
use think\Db;
use app\admin\model\Game as gameModel;
use app\front\model\UserBid as userBidModel;

class Info extends Site
{  
    
    public function check()
    {   
    	//幸运百家乐
    	$code= $this->request->has('code') ? $this->request->param('code'):'';
    	if($code=='xybjl'){
    	    $id=Db::name('game_xybjl')->where('period','thisTimes')->value('id');
    	    $prior_id=$id-1;
    	    //设置赔率
    	    $x=array();
    	    $x[1]=number_format(2.23+rand(50,99)/10000,4,'.','');  //<2.24;
    	    $x[2]=number_format(2.17+rand(50,99)/10000,4,'.',''); //<2.18;
    	    $x[3]=number_format(10.45+rand(200,450)/10000,4,'.','');; //<10.50;
    	    Db::name('game_xybjl')->where('id',$prior_id)->setField('bidrate',json_encode($x));
    	    $row=Db::name('game_xybjl')->where('id',$prior_id)->find();
            $result=$row['result'];
    	    $num=$result=='PLAYER'?2:(($result=='BANKER')?1:3);

    	    $userBidModel=new userBidModel();
            
            $map['game_number']=$row['id'];//期号
            $map['game_id']=1;//幸运百家乐的ID
            $data=collection($userBidModel->where($map)->select())->toArray();//所有投注此游戏的用户数据
            

            foreach($data as $v){
            	$prizeinfo=array();
                $bidinfo=json_decode($v['bidinfo'],true);
                $gid=$v['game_id'];
                $oid=$v['game_number'];
                $uid=$v['user_id'];
                foreach($bidinfo as $k=>$w){
                    if('f'.$num==$k){
                    	$win_coin=floor($w*$x[$num]);
                    	$this->userModel->where('uid',$uid)->setInc('coin',$win_coin);
                    	$game=get_game($gid);
                    	$coin=$this->userModel->where('uid',$uid)->value('coin');
                    	adduserlog($uid,$game['name'].'第'.$oid.'期,中奖'.$win_coin.'金币',$win_coin,0,$coin,'hit');//hit类型:游戏中奖
                    	$prizeinfo[$k]=$win_coin;
                    }else{
                    	$prizeinfo[$k]=0;
                    }

                }
                $bid=$v['id'];
                $userBidModel->where('id',$bid)->setField('prizeinfo',json_encode($prizeinfo));
            }

    	}
    }

}