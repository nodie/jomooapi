<?php

include "TopSdk.php";
date_default_timezone_set('Asia/Shanghai');

//九牧正式
$appkey = "25040227";
$secret = "37d5fd8814b73647f07e3dd1126ff03a";
$sessionKey = "610051923ba253e48bd001a24961bfb2d1b6fdbe116d12b2191428291";

//安保客正式
//$appkey = "24736278";
//$secret = "fcbc17d510a9d586739b83ce159a1887";
//$sessionKey = "6201b08fca6dd307ZZ53208608bc288444605bfbf8190f62468433189";

$opt = $_REQUEST['opt'];
$jsonStr = jsonStr(); //获取参数

write_log($jsonStr); //记录日志

$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;

switch($opt){
    //查询任务类工单信息 按时间查询 [ tmall.servicecenter.tasks.search ]
    //http://open.taobao.com/api.htm?docId=11122&docType=2
    case "getOrderByTime":
        $time = strval($jsonStr['end']);
        $starttime = strval($jsonStr['start']);

        $req = new TmallServicecenterTasksSearchRequest;
        $req->setStart($starttime);
        $req->setEnd($time);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //服务供应商通过交易主订单查询其未拉取的任务类工单 [ tmall.servicecenter.task.get ]
    //
    case "getOrderByParOrderId":
        $req = new TmallServicecenterTaskGetRequest;

        $parent_biz_order_id = $jsonStr['parent_biz_order_id'];
        $req->setParentBizOrderId($parent_biz_order_id);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //喵师傅分配工人回传 [ tmall.msf.reservation ]
    //喵师傅分配工人回传 [工单获取后8小时内回传工人信息给天猫] 此时需要传值 success = 2
    //
    case "msfReservation":
        $req = new TmallMsfReservationRequest;
        $reserv_info = new ReservationDTO;

        $reserv_info->outer_id = $jsonStr['outer_id']; //内部订单号
        $reserv_info->order_ids = $jsonStr['order_ids']; //天猫父订单号列表
        $reserv_info->service_type = $jsonStr['service_type']; //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
        $reserv_info->worker_mobile = $jsonStr['worker_mobile']; //预约工人手机号码
        $reserv_info->worker_name = $jsonStr['worker_name']; //工人名称
        $reserv_info->success = "2"; //1成功 0失败
        $req->setReservInfo(json_encode($reserv_info));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //喵师傅预约回传 [ tmall.msf.reservation ]
    //喵师傅服务预约API 线下预约成功 success = 1 ，且 resv_time [预约时间] 及 resv_date [预约日期] 需要有值
    //
    case "msfAppointment":
        $req = new TmallMsfReservationRequest;
        $reserv_info = new ReservationDTO;
        $reserv_info->outer_id = $jsonStr['outer_id']; //内部订单号
        $reserv_info->order_ids = $jsonStr['order_ids']; //天猫父订单号列表
        $reserv_info->service_type = $jsonStr['service_type']; //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
        $reserv_info->resv_time = $jsonStr['resv_time']; //预约时间,0:上午,1:下午,2:晚上
        $reserv_info->resv_date = $jsonStr['resv_date']; //预约日期,2015-12-15
        $reserv_info->worker_mobile = $jsonStr['worker_mobile']; //预约工人手机号码
        $reserv_info->worker_name = $jsonStr['worker_name']; //工人名称
        $reserv_info->success = $jsonStr['success']; //1成功 0失败
        $req->setReservInfo(json_encode($reserv_info));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //*** 确认success = 0 还是 2  ！！！
    //喵师傅工单挂起回传 [ tmall.msf.reservation ]
    //喵师傅服务预约API 线下预约失败 success = 2 ，且 next_resv_time [下次预约时间] 需要有值
    //
    case "msfPutUp":
        $req = new TmallMsfReservationRequest;
        $reserv_info = new ReservationDTO;
        $reserv_info->outer_id = $jsonStr['outer_id']; //内部订单号
        $reserv_info->order_ids = $jsonStr['order_ids']; //天猫父订单号列表
        $reserv_info->service_type = $jsonStr['service_type']; //服务类型，0 家装的送货上门并安装 1 单向安装 2 建材的送货上门 3 建材的安装。统一为3
        $reserv_info->worker_mobile = $jsonStr['worker_mobile']; //预约工人手机号码
        $reserv_info->worker_name = $jsonStr['worker_name']; //工人名称
        $reserv_info->fail_code = $jsonStr['fail_code']; //1：电话占线/无人接听/电话关机 2：未收到货 3：用户暂不需要安装 4：取消安装 5：电话号码错误
        $reserv_info->next_resv_time = $jsonStr['next_resv_time']; //下次预约时间
        $reserv_info->success = $jsonStr['success']; //1成功 0失败
        $req->setReservInfo(json_encode($reserv_info));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //喵师傅用 图片文件上传 [ tmall.servicecenter.picture.upload ]
    //
    case "msfImgUpload":
        $imgLocation = $jsonStr['img'];
        $picture_name = $jsonStr['picture_name'];
        $is_https = $jsonStr['is_https'];

        $req = new TmallServicecenterPictureUploadRequest;
        //附件上传的机制参见PHP CURL文档，在文件路径前加@符号即可
        $req->setImg("@" . $imgLocation);
        $req->setPictureName($picture_name);
        $req->setIsHttps($is_https);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //服务商反馈无需安装工单接口 [ tmall.servicecenter.task.feedbacknoneedservice ]
    //
    case "msfNoNeedService":
        $req = new TmallServicecenterTaskFeedbacknoneedserviceRequest;
        $param = new SuspendServiceDo;
        $param->updater = $jsonStr['updater'];
        $param->extension = $jsonStr['extension'];
        $param->type = $jsonStr['type'];
        $param->buyer_id = $jsonStr['buyer_id'];
        $param->comments = $jsonStr['comments'];
        $param->update_date = $jsonStr['update_date'];
        $param->workcard_id = $jsonStr['workcard_id'];
        $req->setParam(json_encode($param));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //喵师傅核销状态查询接口 [ tmall.msf.identify.status.query ]
    //
    case "msfGetIdentifyStatus":
        $req = new TmallMsfIdentifyStatusQueryRequest;
        $req->setOrderId($jsonStr['order_id']);
        $req->setServiceType($jsonStr['service_type']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //天猫服务平台服务商一键求助单查询 [ tmall.servicecenter.anomalyrecourse.search ]
    //
    case "msfGetAnomalyrecourse":
        $req = new TmallServicecenterAnomalyrecourseSearchRequest;
        $req->setStart($jsonStr['start']);
        $req->setEnd($jsonStr['end']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //天猫服务平台一键求助单服务商备注更新接口 [ tmall.servicecenter.anomalyrecourse.remark.update ]
    //
    case "msfUpdAnomalyrecourse":
        $req = new TmallServicecenterAnomalyrecourseRemarkUpdateRequest;
        $req->setId($jsonStr['id']);
        $req->setRemark($jsonStr['remark']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //单个结算调整单数据获取 [ tmall.servicecenter.settleAdjustment.get ]
    //
    case "msfGetSettleadjustmentById":
        $req = new TmallServiceSettleadjustmentGetRequest;
        $req->setId($jsonStr['id']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //按时间区间获取结算调整单数据 [ tmall.servicecenter.settleAdjustment.search ]
    //
    case "msfGetSettleadjustmentByTime":
        $req = new TmallServiceSettleadjustmentSearchRequest;
        $req->setEndTime($jsonStr['end_time']);
        $req->setStartTime($jsonStr['start_time']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //创建结算调整单 [ tmall.servicecenter.settleAdjustment.request ]
    //
    case "msfCreateSettleadjustment":
        $gatewayUrl = "https://eco.taobao.com/router/rest";
        $c->setGatewayUrl($gatewayUrl);

        $req = new TmallServiceSettleadjustmentRequestRequest;
        $param_settle_adjustment_request = new SettleAdjustmentRequest;
        $param_settle_adjustment_request->cost = $jsonStr['cost'];
        $param_settle_adjustment_request->description = $jsonStr['description'];
        $param_settle_adjustment_request->picture_urls = $jsonStr['picture_urls'];
        $price_factors = new SettlementPriceFactor;
        $price_factors->name = $jsonStr['price_factors']['name'];
        $price_factors->value = $jsonStr['price_factors']['value'];
        $price_factors->desc = $jsonStr['price_factors']['desc'];
        $param_settle_adjustment_request->price_factors = $price_factors;
        $param_settle_adjustment_request->type = $jsonStr['type'];
        $param_settle_adjustment_request->workcard_id = $jsonStr['workcard_id'];
        $req->setParamSettleAdjustmentRequest(json_encode($param_settle_adjustment_request));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //修改结算调整单 [ tmall.service.settleadjustment.modify ]
    //
    case "msfUpdateSettleadjustment":
        $gatewayUrl = "https://eco.taobao.com/router/rest";
        $c->setGatewayUrl($gatewayUrl);

        $req = new TmallServiceSettleadjustmentModifyRequest;
        $param_settle_adjustment_request = new SettleAdjustmentRequest;
        $param_settle_adjustment_request->cost = $jsonStr['cost'];
        $param_settle_adjustment_request->description = $jsonStr['description'];
        $param_settle_adjustment_request->id = $jsonStr['id'];
        $param_settle_adjustment_request->picture_urls = $jsonStr['picture_urls'];
        $price_factors = new SettlementPriceFactor;
        $price_factors->name = $jsonStr['price_factors']['name'];
        $price_factors->value = $jsonStr['price_factors']['value'];
        $price_factors->desc = $jsonStr['price_factors']['desc'];
        $param_settle_adjustment_request->PriceFactors = $price_factors;
        $param_settle_adjustment_request->type = $jsonStr['type'];
        $req->setParamSettleAdjustmentRequest(json_encode($param_settle_adjustment_request));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //单个结算调整单取消 [ tmall.servicecenter.settleAdjustment.cancel ]
    //
    case "msfCancelSettleadjustment":
        $req = new TmallServiceSettleadjustmentCancelRequest;
        $req->setId($jsonStr['id']);
        $req->setComments($jsonStr['comments']);
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    //服务商工人信息创建 [ tmall.servicecenter.worker.create ]
    //
    case "msfUploadWorker":
        $req = new TmallServicecenterWorkerCreateRequest;
        $worker_dto = new WorkerDto;
        //工人居住地址
        $address = new AddressDto;
        //详细地址，街到门牌 [上南路3520弄1号502室]
        $address->address_detail=$jsonStr['address']['address_detail'];
        //省/市/区/街道 [格式：省，市，区，街道 例子：浙江省,杭州市,西湖区,蒋村街道 . 填写四级地址，若相应层级不存在，则设置为空] [上海 上海市 浦东新区 三林镇]
        $address->address_names=$jsonStr['address']['address_names'];
        // $worker_dto->Address = $address;
        $worker_dto->address = $address;
        $worker_dto->identity_id=$jsonStr['identity_id']; //身份证
        $worker_dto->name=$jsonStr['name']; //师傅名称
        $worker_dto->phone=$jsonStr['phone']; //师傅电话 - 龙木
        $worker_dto->provider_id=$jsonStr['provider_id']; //服务商id
        $worker_dto->provider_name=$jsonStr['provider_name']; //服务商昵称
        $worker_dto->register_time=$jsonStr['register_time']; //注册日期
        $service_areas = new DivisionDto; //工人服务地址
        // $service_areas->division_names="上海,上海市,浦东新区,上钢新村|上海,上海市,杨浦区,定海路街道"; //格式：省，市，区，街道 例子：浙江省,杭州市,西湖区,蒋村街道. 多个区域用|分隔
        $service_areas->division_names=$jsonStr['service_areas']['division_names'];
        $worker_dto->service_areas = $service_areas;
        $worker_dto->service_types=$jsonStr['service_types']; //服务能力 [格式：类目id,服务名. 多个服务能力用|分隔，服务类型列表见sheet1]
        $worker_dto->work_type=$jsonStr['work_type']; //工头类型中的一种：工头、核心工人、普通工人、储备工人
        $worker_dto->photo=$jsonStr['photo']; //工人照片
        $worker_dto->id_card_pic_back=$jsonStr['id_card_pic_back']; //身份证反面照
        $worker_dto->id_card_pic=$jsonStr['id_card_pic']; //身份证正面照
        $worker_dto->handheld_card_pic=$jsonStr['handheld_card_pic'];  //工人手持身份证照片地址
        $req->setWorkerDto(json_encode($worker_dto));
        $resp = $c->execute($req, $sessionKey);
        echo "<pre>";
        print_r($resp);
        break;

    default:
        break;
}


//获取参数
function jsonStr() {
    if (!isset($_GET['jsonStr'])) {
        return NULL;
    }

    $jsonStr = urldecode($_GET['jsonStr']);
    $jsonStr = preg_replace("/\\\\\"/i", '"', $jsonStr);

    return json_decode($jsonStr, true);
}

//记录日志
function write_log($data = array(), $filename = '')
{
    if (is_array($data)) {
        $data = json_encode($data);
    }

    $str = sprintf("[%s] %s:", date("Y-m-d H:i:s"), $_SERVER['HTTP_USER_AGENT']) . PHP_EOL;
    $str .= sprintf("       %s", $data) . PHP_EOL . PHP_EOL . PHP_EOL;

    if (!$filename) {
        $filename = 'sys.log';
    }

    $dir = __DIR__ . 'Log/' . date('Y/m/d/');
    mkdirs($dir);
    $logFilePath = $dir . $filename;
    if ($fp = fopen($logFilePath, 'a')) {
        fwrite($fp,  $str);
        fclose($fp);
    }
}

/**
 * @desc 创建目录
 * @param $dir
 * @param int $mode
 * @return bool
 */
function mkdirs($dir, $mode = 0755)
{
    if (is_dir($dir) || @mkdir($dir, $mode)) {
        return TRUE;
    }

    if (!mkdirs(dirname($dir), $mode)) {
        return FALSE;
    } 

    return @mkdir($dir, $mode);
}

?>
