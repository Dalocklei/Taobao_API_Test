<?php
header("Content-type: text/html; charset=utf-8");
set_time_limit(100);   //���ó�ʱʱ�����ƣ����̫С�Ļ�������Ϊ��ʱ��ֹͣ���У�ע���Ա�����api�Ƚ���������Ҫ���ýϳ���ʱ������
include "TopSdk.php";
//������SDK��ѹ��top���TopClient.php��8��$gatewayUrl��ֵ��Ϊɳ���ַ:http://gw.api.tbsandbox.com/router/rest,
//��ʽ����ʱ��Ҫ���õ�ַ����Ϊ:http://gw.api.taobao.com/router/rest
 
//ʵ����TopClient��
$c = new TopClient;
$c->appkey = "1023051402";
$c->secretKey = "sandbox3c96c15315b1776cbcfd90108";
$sessionkey= "6100426a11d634f1e707b10c1cd797ebba18eb452f5a0023643570735";   //��ɳ������ʺ�sandbox_c_1��Ȩ��õ���sessionkey
//ʵ��������API��Ӧ��Request��
$req = new UserSellerGetRequest;
$req->setFields("user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status");
//	,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,has_sub_stock,is_golden_seller,vip_info,magazine_subscribe,vertical_market,online_gaming");
 
//ִ��API���󲢴�ӡ���
$resp = $c->execute($req,$sessionkey);
echo "result:";
echo "<br />";
print_r($resp);
echo "<br />";

//�������ݿ�
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
$sqlquery = "INSERT INTO seller_info (seller_id, nick, type, status) VALUES ($user_id, '$nick', '$type', '$status')";  //ע���varchar���ͼ�����''
if (!mysql_query($sqlquery))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($db_con);

?>