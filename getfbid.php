<html>
<head>
<meta charset="UTF-8">
<title>toutou</title>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0" bottommargin="0" bgcolor="#F9F9F9">
<center>
<table height="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="td1">&nbsp;</td>
	</tr>
	<tr>
		<td class="td2" align="center" valign="top" style="font-weight: bold; font-size: 70px; color: #616364;">toutou<br>
		<span style="font-family: '標楷體'; font-weight: normal; font-size: 24px;">偷偷</span></td>
	</tr>
	<tr>
		<td class="td3" align="center" valign="top" style="font-size: 24px; font-family: '標楷體'; font-weight: bold;">
		<form action="" method="post" id="form">
		他的動態時報網址：<br>
		<input name="link" type="text" placeholder="Facebook ID"><br>
		<a href="" style="#000; font-weight: bold; font-family: '標楷體';" onClick="form.submit();return false;">取得Facebook ID</a>
		</form><br>
		<br>
		他的Facebook ID：<br>
		<?php
			if(preg_match("/profile.php\?id=([0-9]+)/",@$_POST["link"],$match)!=0){
				$fbid=@$match[1];
			}else {
				preg_match("/facebook.com\/([A-Za-z\.]+)/",@$_POST["link"],$match);
				$fbid=@$match[1];
			}
			$text=@file_get_contents("http://graph.facebook.com/".$fbid);
			$array=json_decode($text);
			echo @$array->id;
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
