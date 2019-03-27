<?php
namespace app\agent\controller;
use think\Controller;
use think\Config;
use app\admin\model\Agent as agentModel;
use app\admin\model\AgentCate as agentCateModel;
use app\admin\model\AgentLog as agentLogModel;
class Capital extends Controller
{   
	private $agentModel;
    private $agentCateModel;
    private $agentLogModel;
	public function _initialize()
    {
        $this->agentModel = new agentModel();
        $this->agentCateModel = new agentCateModel();
        $this->agentLogModel = new agentLogModel();
    }

    //代理信息
    public function withdraw()
    {   
        $map['id']=10000;
    	$agent=$this->agentModel->where($map)->find();
    	$this->assign('agetn',$agent);
    	return $this->fetch();
    }

   
}
