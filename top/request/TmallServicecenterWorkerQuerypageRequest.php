<?php
/**
 * TOP API: tmall.servicecenter.worker.querypage request
 * 
 * @author auto create
 * @since 1.0, 2017.09.01
 */
class TmallServicecenterWorkerQuerypageRequest
{
	/** 
	 * 页码
	 **/
	private $pageIndex;
	
	private $apiParas = array();
	
	public function setPageIndex($pageIndex)
	{
		$this->pageIndex = $pageIndex;
		$this->apiParas["page_index"] = $pageIndex;
	}

	public function getPageIndex()
	{
		return $this->pageIndex;
	}

	public function getApiMethodName()
	{
		return "tmall.servicecenter.worker.querypage";
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
