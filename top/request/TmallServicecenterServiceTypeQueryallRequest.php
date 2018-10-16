<?php
/**
 * TOP API: tmall.servicecenter.service.type.queryall request
 * 
 * @author auto create
 * @since 1.0, 2017.07.21
 */
class TmallServicecenterServiceTypeQueryallRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "tmall.servicecenter.service.type.queryall";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
