<?php
/**
 * TOP API: taobao.jds.refund.traces.get request
 * 
 * @author auto create
 * @since 1.0, 2014-11-18 16:52:05
 */
class JdsRefundTracesGetRequest
{
	/** 
	 * 淘宝的退款编号<br /> 支持最小值为：1
	 **/
	private $refundId;
	
	private $apiParas = array();
	
	public function setRefundId($refundId)
	{
		$this->refundId = $refundId;
		$this->apiParas["refund_id"] = $refundId;
	}

	public function getRefundId()
	{
		return $this->refundId;
	}

	public function getApiMethodName()
	{
		return "taobao.jds.refund.traces.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->refundId,"refundId");
		RequestCheckUtil::checkMinValue($this->refundId,1,"refundId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
