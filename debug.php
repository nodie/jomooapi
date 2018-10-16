<?php

include "TopSdk.php";
date_default_timezone_set('Asia/Shanghai'); 

//sandbox
// $appkey = "1024736278";
// $secret = "sandbox510a9d586739b83ce159a1887";
// $sessionKey = "6100e03ebd91e8998da14ea2408c64c58b8888360a6dac92054718218";
// $nick = "sandbox_b_01";

//安保客正式
// $appkey = "24736278";
// $secret = "fcbc17d510a9d586739b83ce159a1887";
// $sessionKey = "6101a14728795c182b4c3519d57eba66db8158e33215f032468433189";
// $nick = "";


//九牧正式
$appkey = "25040227";
$secret = "37d5fd8814b73647f07e3dd1126ff03a";
$sessionKey = "610051923ba253e48bd001a24961bfb2d1b6fdbe116d12b2191428291";

//九牧沙箱
//$appkey = "1025040227";
//$secret = "sandbox814b73647f07e3dd1126ff03a";
//$sessionKey = "6100021aec7265282839f8f81ece010868063a4fb32ce952054718218";



 /*
* @沙盒测试@
 * 查询任务类工单信息 按时间查询
 * 7.3.2.3	tmall.servicecenter.tasks.search
 http://open.taobao.com/docs/api.htm?apiId=11122
 */
$time = strtotime("2018-09-30 12:00:00").'000';
// $time = time().'000';
$starttime = $time-(1000*14*60);
// echo $starttime." -> ".$time."\n";

$time = strval($time);
$starttime = strval($starttime);

$c = new TopClient;
$gatewayUrl = "http://gw.api.taobao.com/router/rest";
//$gatewayUrl = "http://gw.api.tbsandbox.com/router/rest";
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new TmallServicecenterTasksSearchRequest;
$req->setStart($starttime);
$req->setEnd($time);
$resp = $c->execute($req, $sessionKey);
print_r($resp);
exit;




?>