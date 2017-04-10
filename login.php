<html>
<head>
<meta charset="UTF-8">
<title>toutou</title>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0" bottommargin="0" bgcolor="#F9F9F9">
<?php
//ini_set('display_errors',1);
require 'function/facebook-php-sdk-v4/src/Facebook/autoload.php';
require("function/SQL-function/sql.php");
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
	if ($islogin){
		header("Location: post.php");
	}
} catch (FacebookRequestException $ex){
	consolelog($ex);
} catch (Exception $ex) {
	consolelog($ex);
}
?>
<center>
<table height="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="td1">&nbsp;</td>
	</tr>
	<tr>
		<td class="td2" colspan="2" align="center" valign="top" style="font-weight: bold; font-size: 70px; color: #616364;">toutou<br>
		<span style="font-family: '標楷體'; font-weight: normal; font-size: 24px;">偷偷</span></td>
	</tr>
	<tr>
		<td class="td3" colspan="2" align="center" valign="top" style="font-size: 24px; font-family: '標楷體'; font-weight: bold;">舆朋友連接需要透過一點現代方式<br>
是否同意我們toutou獲得您臉書上的資訊<br>
		<br>
		<br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" valign="top"><a href="../login" target="_blank" style="text-decoration: none; font-size: 24px; font-weight: bold; color: #000;">是</a></td>
			<td align="center" valign="top"><a href="./" style="text-decoration: none; font-size: 24px; font-weight: bold; color: #000;">否</a></td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
		<td class="td4"></td>
	</tr>
</table>
<br>
<hr>
開發： 
<!-- Facebook Badge START --><a href="https://www.facebook.com/people/Huang-Xuanyu/100005870494945" title="Huang Xuanyu" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Huang Xuanyu</a><br /><a href="https://www.facebook.com/people/Huang-Xuanyu/100005870494945" title="Huang Xuanyu" target="_TOP"><img class="img" src="https://badge.facebook.com/badge/100005870494945.162.30088521.png" style="border: 0px;" alt="" /></a><br /><!-- <a href="https://www.facebook.com/badges/" title="Make your own badge!" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" target="_TOP">Create Your Badge</a>Facebook Badge END -->
</center>
</body>
</html>
