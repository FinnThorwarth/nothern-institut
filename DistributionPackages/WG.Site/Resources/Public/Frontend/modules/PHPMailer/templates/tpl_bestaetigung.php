﻿<?php

	$tpl_html = '
<html>
<head>
<title>Ihre Bewerbung an Marinetech Edelstahlhandel GmbH & Co. KG</title>
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
    <th style="padding:15px;background-color:#002640"><img src="http://relaunch.marinetech.de/includes/images/marinetech_logo.svg" width="150" style="width:150px;height:auto"></th>
  </tr>
  <tr>
    <td align="right" style="padding:15px 20px; text-align:right; color:#949dae">
			Gesendet am: ' . date("d.m.Y - H:i") . ' Uhr
		</td>
  </tr>
  <tr>
    <td style="padding:0 20px">
      <br>
      <br><b>Ihre Bewerbung an Marinetech Edelstahlhandel GmbH & Co. KG</b><br><br>
 			<br>Vielen Dank für Ihre Bewerbung als:<br>
 			<br><b>{!++ titel ++!}</b>
      <br>
      <br>
      <br>Ihre Unterlagen sind bei uns eingegangen und werden geprüft.
      <br>Folgende Daten haben Sie an uns gesendet:<br>
      <br>
      {!++ text ++!}
      <br>
		</td>
  </tr>
</table>
</body>
</html>
	';

	$tpl_plain = 'Ihre Bewerbung an Marinetech Edelstahlhandel GmbH & Co. KG

Vielen Dank für Ihre Bewerbung!
Folgende Daten haben Sie an uns gesendet:

{!++ text ++!}

';

?>
