<?php
header("Content-type: text/html; charset=utf-8");
set_time_limit(100);   //设置超时时间限制，如果太小的话容易因为超时而停止运行，注意淘宝测试api比较慢，所以要设置较长的时间限制
include "TopSdk.php";
//将下载SDK解压后top里的TopClient.php第8行$gatewayUrl的值改为沙箱地址:http://gw.api.tbsandbox.com/router/rest,
//正式环境时需要将该地址设置为:http://gw.api.taobao.com/router/rest
 
//实例化TopClient类
$c = new TopClient;
$c->appkey = "1023051402";
$c->secretKey = "sandbox3c96c15315b1776cbcfd90108";
$sessionkey= "6100426a11d634f1e707b10c1cd797ebba18eb452f5a0023643570735";   //如沙箱测试帐号sandbox_c_1授权后得到的sessionkey
//实例化具体API对应的Request类
$req = new UserSellerGetRequest;
$req->setFields("user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status");
//	,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,has_sub_stock,is_golden_seller,vip_info,magazine_subscribe,vertical_market,online_gaming");
 
//执行API请求并打印结果
$resp = $c->execute($req,$sessionkey);
echo "result:";
echo "<br />";
print_r($resp);
echo "<br />";

//连接数据库
$db_con = mysql_connect("localhost", "root", "");
if( !$db_con )
{
	die('could not connect'. mysql_error());
}
mysql_select_db("taobao", $db_con);
$user_id = $resp->user->user_id;
$nick = $resp->user->nick;
$type = $resp->user->type;
$status = $resp->user->status;
$sqlquery = "INSERT INTO seller_info (seller_id, nick, type, status) VALUES ($user_id, '$nick', '$type', '$status')";  //注意对varchar类型加引号''
if (!mysql_query($sqlquery))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($db_con);

?>