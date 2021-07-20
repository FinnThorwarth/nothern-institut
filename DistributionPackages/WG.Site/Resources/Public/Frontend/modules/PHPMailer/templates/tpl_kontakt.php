<?php

	$tpl_html = '
<html>
<head>
<title>' . $subject . '</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
	th { padding: 0; text-align: left; }
	td { padding: 2px 5px; font-family:arial,helvetica,sans-serif; font-size:12px; line-height:15px; }
	a { color:#091F3C; text-decoration:none }
	a:hover, a:active { text-decoration:underline }
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table border="0" cellpadding="0" cellspacing="0" width="600" link="#091F3C" vlink"#091F3C">
  <tr>
    <th><img src="http://relaunch.marinetech.de/includes/images/marinetech_logo.svg" width="200" style="width:200px;height:auto"></th>
  </tr>
  <tr>
    <td align="right" style="padding:0 20px; text-align:right; color:#949dae">
			Gesendet am: ' . date("d.m.Y - H:i") . ' Uhr
		</td>
  </tr>
  <tr>
    <td style="padding:20px">
      <br>
      <br><b>' . $subject . '</b><br><br>
 			<br>Folgende Daten wurden gesendet:
      <br>
      <br>
      {!++ text ++!}
      <br>
		</td>
  </tr>
</table>
</body>
</html>
	';

	$tpl_plain = $subject . '

Folgende Daten wurden gesendet:

{!++ text ++!}

';

?>
