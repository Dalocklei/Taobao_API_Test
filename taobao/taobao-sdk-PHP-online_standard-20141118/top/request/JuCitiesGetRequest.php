<?php
/**
 * TOP API: taobao.ju.cities.get request
 * 
 * @author auto create
 * @since 1.0, 2014-11-18 16:52:05
 */
class JuCitiesGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.ju.cities.get";
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
