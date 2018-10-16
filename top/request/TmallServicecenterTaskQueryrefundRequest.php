<?php
/**
 * TOP API: tmall.servicecenter.task.queryrefund request
 * 
 * @author auto create
 * @since 1.0, 2017.01.10
 */
class TmallServicecenterTaskQueryrefundRequest
{
	/** 
	 * 工单id列表
	 **/
	private $workcardList;
	
	private $apiParas = array();
	
	public function setWorkcardList($workcardList)
	{
		$this->workcardList = $workcardList;
		$this->apiParas["workcard_list"] = $workcardList;
	}

	public function getWorkcardList()
	{
		return $this->workcardList;
	}

	public function getApiMethodName()
	{
		return "tmall.servicecenter.task.queryrefund";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->workcardList,"workcardList");
		RequestCheckUtil::checkMaxListSize($this->workcardList,20,"workcardList");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
