<?php
/**
 * TOP API: taobao.athena.item.knowledge.type.get request
 * 
 * @author auto create
 * @since 1.0, 2014-11-18 16:52:05
 */
class AthenaItemKnowledgeTypeGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.athena.item.knowledge.type.get";
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
