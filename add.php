<html>
<head>
<meta charset="UTF-8">
<title>toutou</title>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0" bottommargin="0" bgcolor="#F9F9F9">
<center>
<table height="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="td1">&nbsp;</td>
	</tr>
	<tr>
		<td class="td2" align="center" valign="top" style="font-weight: bold; font-size: 70px; color: #616364;">toutou<br>
		<span style="font-family: '標楷體'; font-weight: normal; font-size: 24px;">偷偷</span></td>
	</tr>
	<tr>
		<td class="td3" align="center" valign="top" style="font-size: 24px; font-family: '標楷體'; font-weight: bold;">
<?php
//ini_set('display_errors',1);
require '../facebook-php-sdk-v4-4.0-dev/autoload.php';
require("../../function/sql.php");
require("../login/getlogininfo.php");
session_start();

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

FacebookSession::setDefaultApplication('703921369635733', '440a81d73cf1927fd88a646f92748e83');

$helper = new FacebookRedirectLoginHelper('http://pc2.tfcis.org/xiplus/fb/reminder/');
try {
	$logininfo=checkcookie();
	$session=getsession($logininfo);
	$islogin=checklogin($session);
	if (!$islogin){
		header("Location: login.php");
	}
	if(isset($_POST["toid"])){
		$array=json_decode(file_get_contents("https://graph.facebook.com/".$_POST["toid"]));
		if(!isset($array->name)){
			?>輸入的Facebook ID不正確<br><a href="" onClick="history.back();return false;">點我回上一頁修改</a><?php
			exit;
		}
		$user=(new FacebookRequest($session, 'GET', '/'.$_POST["toid"].'?fields=third_party_id,name'))->execute()->getGraphObject()->asArray();
		INSERT("xiplus_toutou","message",
			array(
				array("fromid",$logininfo["third_party_id"]),
				array("toid",$user["third_party_id"]),
				array("text",$_POST["text"]),
				array("token",md5(uniqid(rand(),true)))
			)
		);
		$exist=mfa(SELECT("xiplus_toutou","*","message",
			array(
				array("fromid",$user["third_party_id"]),
				array("toid",$logininfo["third_party_id"])
			)
		));
		if($exist){
			echo $user["name"]." ===> ".$logininfo["name"]."<br>";
			$row=SELECT("xiplus_toutou","*","message",
				array(
					array("fromid",$user["third_party_id"]),
					array("toid",$logininfo["third_party_id"])
				)
			,null,"all");
			while($temp=mfa($row)){
				$params = array(
					'access_token'=>'703921369635733|_1KgkzvSAFNtZXmJQr-GoDua_bs',
					'template'=>'[toutou] '.$user["name"].'已經收到了你toutou傳的訊息，對方也toutou傳給你一則訊息：「'.$temp["text"].'」'
				);
				$response = (new FacebookRequest($session, 'POST', '/'.$logininfo["id"].'/notifications', $params))->execute();
				INSERT("xiplus_toutou","log",array(
					array("timeauto",date("Y-m-d H:i:s")),
					array("fromid",$user["id"]),
					array("toid",$logininfo["id"]),
					array("text",$params["template"]),
					array("response",serialize($response->getGraphObject()->asArray())),
					array("token",md5(uniqid(rand(),true)))
				));
			}
			DELETE("xiplus_toutou","message",
				array(
					array("fromid",$user["third_party_id"]),
					array("toid",$logininfo["third_party_id"])
				)
			,"all");
			
			echo $user["name"]." <=== ".$logininfo["name"]."<br>";
			$to=mfa(SELECT("xiplus","*","fb",array(array("third_party_id",$user["third_party_id"]))));
			$session = new FacebookSession($to["token"]);
			$row=SELECT("xiplus_toutou","*","message",
				array(
					array("fromid",$logininfo["third_party_id"]),
					array("toid",$user["third_party_id"])
				)
			,null,"all");
			while($temp=mfa($row)){
				$params = array(
					'access_token'=>'703921369635733|_1KgkzvSAFNtZXmJQr-GoDua_bs',
					'template'=>'[toutou] '.$logininfo["name"].'已經收到了你toutou傳的訊息，對方也toutou傳給你一則訊息：「'.$temp["text"].'」'
				);
				$response = (new FacebookRequest($session, 'POST', '/'.$user["id"].'/notifications', $params))->execute();
				INSERT("xiplus_toutou","log",array(
					array("timeauto",date("Y-m-d H:i:s")),
					array("fromid",$logininfo["id"]),
					array("toid",$user["id"]),
					array("text",$params["template"]),
					array("response",serialize($response->getGraphObject()->asArray())),
					array("token",md5(uniqid(rand(),true)))
				));
			}
			DELETE("xiplus_toutou","message",
				array(
					array("fromid",$logininfo["third_party_id"]),
					array("toid",$user["third_party_id"])
				)
			,"all");
		}
	}else {
		header("Location: post.php");
		exit;
	}
} catch (FacebookRequestException $ex){
	consolelog($ex);
} catch (Exception $ex) {
	consolelog($ex);
}
header("Location: ok.php");
?>
		</td>
	</tr>
	<tr>
		<td class="td4" align="center" valign="top"></td>
	</tr>
</table>
<br>
<hr>
開發： 
<!-- Facebook Badge START --><a href="https://www.facebook.com/people/Huang-Xuanyu/100005870494945" title="Huang Xuanyu" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Huang Xuanyu</a><br /><a href="https://www.facebook.com/people/Huang-Xuanyu/100005870494945" title="Huang Xuanyu" target="_TOP"><img class="img" src="https://badge.facebook.com/badge/100005870494945.162.30088521.png" style="border: 0px;" alt="" /></a><br /><!-- <a href="https://www.facebook.com/badges/" title="Make your own badge!" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Create Your Badge</a>Facebook Badge END -->
</center>
</body>
</html>