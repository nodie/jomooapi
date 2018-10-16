<?php
/**
 * TOP API: tmall.servicecenter.worker.query request
 * 
 * @author auto create
 * @since 1.0, 2017.07.21
 */
class TmallServicecenterWorkerQueryRequest
{
	/** 
	 * 身份证号
	 **/
	private $identityId;
	
	private $apiParas = array();
	
	public function setIdentityId($identityId)
	{
		$this->identityId = $identityId;
		$this->apiParas["identity_id"] = $identityId;
	}

	public function getIdentityId()
	{
		return $this->identityId;
	}

	public function getApiMethodName()
	{
		return "tmall.servicecenter.worker.query";
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
