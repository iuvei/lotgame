<?php
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------


namespace app\admin\model;

use \think\Model;
class Prize extends Model
{
	public function cate()
    {
        //关联分类表
        return $this->belongsTo('PrizeCate');
    }

    public function remark()
    {
        //关联user_remark表
        return $this->belongsTo('UserRemark','prize_id');
    }

    public function exchange()
    {
        //关联user_exchange表
        return $this->belongsTo('UserExchange','prize_id');
    }


}
