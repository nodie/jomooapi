<?php

/**
 * 结算调整单父节点
 * @author auto create
 */
class SettleAdjustmentRequest
{
	
	/** 
	 * 调整费用，单位分
	 **/
	public $cost;
	
	/** 
	 * 调整原因描述
	 **/
	public $description;
	
	/** 
	 * 调整单ID
	 **/
	public $id;
	
	/** 
	 * 调整原因图片url,最后不用加分号，最多三条
	 **/
	public $picture_urls;
	
	/** 
	 * 计价因子，填写规则为：1、有计价因子场景：{name:计价因子名称 ,value:数量｝如示例。2、没有计价因子场景：填默认值：｛name:计价因子,value:0｝
	 **/
	public $price_factors;
	
	/** 
	 * 调整单类型：1,配件费;2,不符单费;3,拆旧费;4,二次上门;5,胶费;6,打孔费;7,层高费;8,远程费;9,单外费;10,其他
	 **/
	public $type;	
}
?>