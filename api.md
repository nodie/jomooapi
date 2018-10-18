URL: http://www.joom.com/demo.php

# 查询任务类工单信息
demo.php?opt=getOrderByTime
	start: '1538279160000', //开始时间
	end: '1538280000000' //结束时间

# 服务供应商通过交易主订单查询其未拉取的任务类工单
demo.php?opt=getOrderByParOrderId
	parent_biz_order_id: '209916316600222049' //Taobao主交易订单ID

# 喵师傅分配工人回传
demo.php?opt=msfReservation
	outer_id: '23232sdfsfsdfsdf34', //内部订单号
	order_ids: '108699223182504959', //天猫父订单号列表
	service_type: '3', //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
	worker_mobile: '13918817210', //预约工人手机号码
	worker_name: '杨师傅' //工人名称

# 喵师傅服务预约API 线下预约成功
demo.php?opt=msfAppointment
	outer_id: '23232sdfsfsdfsdf34', //内部订单号
	order_ids: '108699223182504959', //天猫父订单号列表
	service_type: '3', //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
	resv_time: '0', //预约时间,0:上午,1:下午,2:晚上
	resv_date: '2015-12-15', //预约日期,2015-12-15
	worker_mobile: '13918817210', //预约工人手机号码
	worker_name: '杨师傅', //工人名称
	success: '1' //1成功 0失败

# 喵师傅服务预约API 线下预约失败
demo.php?opt=msfPutUp
	outer_id: '23232sdfsfsdfsdf34', //内部订单号
	order_ids: '108699223182504959', //天猫父订单号列表
	service_type: '3', //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
	worker_mobile: '13918817210', //预约工人手机号码
	worker_name: '杨师傅', //工人名称
	fail_code: '1', //1：电话占线/无人接听/电话关机 2：未收到货 3：用户暂不需要安装 4：取消安装 5：电话号码错误
	next_resv_time: '2015-12-15', //下次预约时间
	success: '1' //1成功 0失败

# 喵师傅用 图片文件上传
demo.php?opt=msfImgUpload
	img: null, //图片文件二进制流
	picture_name: '1.jpg', //图片全称包括扩展名。目前支持 jpg jpeg png
	is_https: true //true返回Https地址

# 服务商反馈无需安装工单接口
demo.php?opt=msfNoNeedService
	updater: 'api调用者', //api调用者
	extension: '扩展字段', //扩展字段
	type: '1', //工单类型，固定值1
	buyer_id: '1234343', //买家user_id
	comments: '无需安装的原因', //无需安装的原因
	update_date: '2342343', //更新时间得long值
	workcard_id: '4324234234' //工单id

# 喵师傅核销状态查询接口
demo.php?opt=msfGetIdentifyStatus
	order_id: '193974981484107', //天猫订单号
	service_type: '3' //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3

# 天猫服务平台服务商一键求助单查询
demo.php?opt=msfGetAnomalyrecourse
	start: '324234', //开始时间
	end: '234432' //结束时间

# 天猫服务平台一键求助单服务商备注更新接口
demo.php?opt=msfUpdAnomalyrecourse
	id: '32343224', //需要更新的一键求助单id
	remark: '已跟进' //需要更新的服务商备注

# 单个结算调整单数据获取
demo.php?opt=msfGetSettleadjustmentById
	id: '0000001' //结算调整单ID

# 按时间区间获取结算调整单数据
demo.php?opt=msfGetSettleadjustmentByTime
	end_time: '2016-06-28 10:30:00', //结束时间
	start_time: '2016-06-28 10:30:00' //开始时间

# 创建结算调整单
demo.php?opt=msfCreateSettleadjustment
	cost: '10000', //调整费用，必需是正数，单位分
	description: '灯头数多了2个', //调整原因描述
	picture_urls: 'https://xxx/XXX1.png;https://xxx/XXX2.png', //调整原因图片url,最后不用加分号，最多三条
	price_factors: {
		name: '灯头数', //计价因子属性
		value: '8', //计价因子实际值
		desc: '灯头数12' //计价因子说明
	},
	type: '1', //调整单分类类型；1,配件费;2,不符单费;3,拆旧费;4,二次上门;5,胶费;6,打孔费;7,层高费;8,远程费;9,单外费;10,其他
	workcard_id: '2419002' //工单ID

# 修改结算调整单
demo.php?opt=msfUpdateSettleadjustment
	cost: '10000', //调整费用，必需是正数，单位分
	description: '灯头数多了2个', //调整原因描述
	id: '00001', //调整单ID
	picture_urls: 'https://1.png;https://2.png', //调整原因图片url,最后不用加分号，最多三条
	price_factors: {
		name: '灯头数', //计价因子属性
		value: '8', //计价因子实际值
		desc: '灯头数12' //计价因子说明
	},
	type: '1' //调整单分类类型；1,配件费;2,不符单费;3,拆旧费;4,二次上门;5,胶费;6,打孔费;7,层高费;8,远程费;9,单外费;10,其他

# 单个结算调整单取消
demo.php?opt=msfCancelSettleadjustment
	id: '2123', //结算调整单ID
	comments: '和商家协商后取消' //取消原因说明

# 服务商工人信息创建
demo.php?opt=msfUploadWorker
	address: {
		address_detail: '长清北路233号', //详细地址，街到门牌，
		address_names: ["上海","上海市","浦东新区","上钢新村"] //省/市/区/街
	},
	identity_id: '310116197505275722', //身份证
	name: '徐不群', //师傅名称
	phone: '17317166786', //师傅电话
	provider_id: '2468433189', //服务商id
	provider_name: '电子商务公司', //服务商昵称
	register_time: '2016-06-28 10:30:00', //注册日期
	service_areas: { //工人服务地址
		division_names: ["上海","上海市","浦东新区","上钢新村"] //计价因子属性
	},
	service_types: '电子门锁安装', //服务能力
	work_type: '核心工人', //工头类型中的一种：工头、核心工人、普通工人、储备工人
	photo: 'https://1.jpg', //工人照片
	id_card_pic_back: 'https://1.jpg', //身份证反面照
	id_card_pic: 'https://1.jpg', //身份证正面照
	handheld_card_pic: 'https://1.jpg' //工人手持身份证照片地址

# 物流流转信息查询
demo.php?opt=logisticsTraceSearch
	tid: '1324657987', //淘宝交易号，请勿传非淘宝交易号
	seller_nick: 'seller', //卖家昵称
	is_split: '1', //表明是否是拆单，默认值0，1表示拆单
	sub_tid: '1,2,3', //拆单子订单列表，当is_split=1时，需要传人；对应的数据是：子订单号的列表。