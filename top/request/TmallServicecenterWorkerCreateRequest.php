<?php
/**
 * TOP API: tmall.servicecenter.worker.create request
 * 
 * @author auto create
 * @since 1.0, 2017.07.21
 */
class TmallServicecenterWorkerCreateRequest
{
	/** 
	 * 11
	 **/
	private $workerDto;
	
	private $apiParas = array();
	
	public function setWorkerDto($workerDto)
	{
		$this->workerDto = $workerDto;
		$this->apiParas["worker_dto"] = $workerDto;
	}

	public function getWorkerDto()
	{
		return $this->workerDto;
	}

	public function getApiMethodName()
	{
		return "tmall.servicecenter.worker.create";
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
