<?php 
	define('_INCLUDE_FILE_', $_SERVER["DOCUMENT_ROOT"] . '/includes/modules/PHPMailer/');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
  require _INCLUDE_FILE_ . 'src/Exception.php';
  require _INCLUDE_FILE_ . 'src/PHPMailer.php';


	if(!isset($_POST['fo']) || empty($_POST['fo'])) {
		exit();
	}
	define("_BH_HB_",1);
	//defined("_BH_HB_") or die("Direct access is not allowed !");

/* ------------------- */
/* -- Konfiguration -- */
/* ------------------- */

	// aktivert das Versenden einer HTMLmail (0|1)
	$sendHTMLmail = 1;
	
	// Pfad zur Template-Datei bei HTML-Mail.
	// Wenn das Feld Leer gelassen wird, oder die Datei nicht gefunden werden kann wird nur eine Textmail versendet.
	$htmlTemplate = _INCLUDE_FILE_ . 'templates/tpl_kontakt.php';

	// Absender-Adresse (Email-Adresse und Absender-Name)
	$arr_from = array('info@marinetech.de', 'Marinetech Edelstahlhandel GmbH & Co. KG');

	// Empfänger-Adressen (Email-Adresse und Empfänger-Name) / mehrere sind möglich
	$arr_to = array();
	$arr_to[0] = array('info@marinetech.de', 'Bewerbungsformular');
	#$arr_to[0] = array('bert@wg-werbeagentur.de', 'TEST Bewerbungsformular');

	$email_to_user = 0;		// aktiviert, ob der User eine Bestätigung seiner Anfrage erhält (0|1) 
#	$htmlUserTemplate = _INCLUDES_ . 'mod/mailer/templates/tpl_kontakt_user.php';		// Abweichendes Template für Bestätigung-Email

	// Betreffzeile - wird auch im Email-Text verwendet
  $subject = "Bewerbung Marinetech";

	// im Testmode wird nur eine Email an die unten angegebene Adresse gesendet !!!
	$testmode = 0;  										// aktiviert den Testmode des Formulars (0|1) 
	$testmail_an = 'bert@wg-werbeagentur.de';	// Empfänger der Email im Testmode

	// DEMO-Mode - Das Versenden von Emails ist deaktiviert !!!
	$demomode = 0;  										// aktiviert den DEMO-Mode des Formulars (0|1) 


/* ------------------- */

	$fo = $_POST['fo'];
	$attachments = $_FILES['fo'];
	$status = TRUE;
	
//	if(is_file(_INCLUDE_FILE_ . 'func_debug.php')) {	include(_INCLUDE_FILE_ . 'func_debug.php'); } 
//	info($fo); info($attachments,1); exit();

	// schädlichen Code entfernen
	if(is_file(_INCLUDE_FILE_ . 'func_validate.php')) {	include(_INCLUDE_FILE_ . 'func_validate.php'); } 
	else { die('Es ist ein Fehler aufgetreten. Bitte informieren Sie den Administrator der Website.'); }
	

	// Textfield
	if(isset($fo['Bereich'])) { $fo['Bereich'] = fx_validateOneLine($fo['Bereich'], 128); }
	if(isset($fo['Vorname'])) { $fo['Vorname'] = fx_validateOneLine($fo['Vorname'], 64); }
	if(isset($fo['Name'])) { $fo['Name'] = fx_validateOneLine($fo['Name'], 64); }
	if(isset($fo['Strasse'])) { $fo['Strasse'] = fx_validateOneLine($fo['Strasse'], 64); }
	if(isset($fo['PLZ'])) { $fo['PLZ'] = fx_validateOneLine($fo['PLZ'], 8); }
	if(isset($fo['Ort'])) { $fo['Ort'] = fx_validateOneLine($fo['Ort'], 64); }
	if(isset($fo['p_Tel'])) { $fo['p_Tel'] = fx_validateOneLine($fo['p_Tel'], 20); }
	if(isset($fo['p_Mobil'])) { $fo['p_Mobil'] = fx_validateOneLine($fo['p_Mobil'], 20); }
	if(isset($fo['p_eMail'])) { $fo['p_eMail'] = fx_validateOneLine($fo['p_eMail'], 128); }
	if(isset($fo['Nachricht'])) { $fo['Nachricht'] = fx_validateMultiLine($fo['Nachricht']); }

	// Upload Parameter validieren
	if(isset($attachments['name']['upl_Lichtbild'])) { $attachments['name']['upl_Lichtbild'] = fx_validateOneLine($attachments['name']['upl_Lichtbild'], 128); }
	if(isset($attachments['name']['upl_Anschreiben'])) { $attachments['name']['upl_Anschreiben'] = fx_validateOneLine($attachments['name']['upl_Anschreiben'], 128); }
	if(isset($attachments['name']['upl_Lebenslauf'])) { $attachments['name']['upl_Lebenslauf'] = fx_validateOneLine($attachments['name']['upl_Lebenslauf'], 128); }
	if(isset($attachments['name']['upl_Zeugnisse'])) { $attachments['name']['upl_Zeugnisse'] = fx_validateOneLine($attachments['name']['upl_Zeugnisse'], 128); }
	if(isset($attachments['tmp_name']['upl_Lichtbild'])) { $attachments['tmp_name']['upl_Lichtbild'] = fx_validateOneLine($attachments['tmp_name']['upl_Lichtbild'], 128); }
	if(isset($attachments['tmp_name']['upl_Anschreiben'])) { $attachments['tmp_name']['upl_Anschreiben'] = fx_validateOneLine($attachments['tmp_name']['upl_Anschreiben'], 128); }
	if(isset($attachments['tmp_name']['upl_Lebenslauf'])) { $attachments['tmp_name']['upl_Lebenslauf'] = fx_validateOneLine($attachments['tmp_name']['upl_Lebenslauf'], 128); }
	if(isset($attachments['tmp_name']['upl_Zeugnisse'])) { $attachments['tmp_name']['upl_Zeugnisse'] = fx_validateOneLine($attachments['tmp_name']['upl_Zeugnisse'], 128); }
	if(isset($attachments['size']['upl_Lichtbild'])) { $attachments['size']['upl_Lichtbild'] = fx_validateOneLine($attachments['size']['upl_Lichtbild'], 32); }
	if(isset($attachments['size']['upl_Anschreiben'])) { $attachments['size']['upl_Anschreiben'] = fx_validateOneLine($attachments['size']['upl_Anschreiben'], 32); }
	if(isset($attachments['size']['upl_Lebenslauf'])) { $attachments['size']['upl_Lebenslauf'] = fx_validateOneLine($attachments['size']['upl_Lebenslauf'], 32); }
	if(isset($attachments['size']['upl_Zeugnisse'])) { $attachments['size']['upl_Zeugnisse'] = fx_validateOneLine($attachments['size']['upl_Zeugnisse'], 32); }


	// Pflichtfelder prüfen
#	if(!isset($fo['Anrede']) || ($fo['Anrede'] != 'Herr' && $fo['Anrede'] != 'Frau')) { $status = FALSE; }
###	if(!isset($fo['Bereich']) || empty($fo['Bereich'])) { $status = FALSE; }
	if(!isset($fo['Vorname']) || empty($fo['Vorname'])) { $status = FALSE; }
	if(!isset($fo['Name']) || empty($fo['Name'])) { $status = FALSE; }
	if(!isset($fo['p_Tel']) || empty($fo['p_Tel'])) { $status = FALSE; }
	if(!isset($fo['p_eMail']) || empty($fo['p_eMail'])) { $status = FALSE; }
#	if(!isset($fo['agree']) || empty($fo['agree'])) { $status = FALSE; }

	// Email-Feld als Empfänger-Adresse überprüfen
	if( $email_to_user===1) {
		$valid_sender_address = false;
		if( fx_checkIfValid($fo['p_eMail']) ) { $valid_sender_address = $fo['p_eMail']; }
		else { $email_to_user = 0; }
	}

	// Spambot Falle
	if(!isset($fo['email']) || !empty($fo['email'])) { $status = FALSE; $spambot = TRUE; }
	
	// Magic-Quotes entfernen
	foreach($fo as $key => $value) { $fo[$key] = fb_unmagic($value); }


	// =========================================
	// Jetzt wird Email verschickt oder nicht:::

	if($status === TRUE) {
	
		// -- MAIL WIRD GENERIERT --
		if(!isset($subject) || empty($subject)) { $subject = "Kontakt Bewerbungsformular: " . $_SERVER["HTTP_HOST"]; }

   	$html = '<table border="0" cellpadding="2" cellspacing="0">'
     			. '<tr><td colspan="2">&nbsp;</td></tr>'
     			. '<tr><td align="right">Beruf/Ausbildung:</td><td>' . $fo['Bereich'] . '</td></tr>'
     			. '<tr><td colspan="2">&nbsp;</td></tr>'
     			. '<tr><td align="right">Vorname:</td><td>' . $fo['Vorname'] . '</td></tr>'
     			. '<tr><td align="right">Name:</td><td>' . $fo['Name'] . '</td></tr>'
     			. '<tr><td align="right">Strasse:</td><td>' . $fo['Strasse'] . '</td></tr>'
     			. '<tr><td align="right">PLZ:</td><td>' . $fo['PLZ'] . '</td></tr>'
     			. '<tr><td align="right">Ort:</td><td>' . $fo['Ort'] . '</td></tr>'
     			. '<tr><td align="right">Telefon:</td><td>' . $fo['p_Tel'] . '</td></tr>'
     			. '<tr><td align="right">Mobil:</td><td>' . $fo['p_Mobil'] . '</td></tr>'
     			. '<tr><td align="right">eMail:</td><td>' . $fo['p_eMail'] . '</td></tr>'
     			. '<tr><td colspan="2">&nbsp;<br /><b>Bewerbungstext:</b><br />' . nl2br($fo['Nachricht']) . '</td></tr>'
     			. '</table>'
     			. '<table cellpadding="0" cellspacing="5" border="0">'
     			. '<tr><td colspan="2">&nbsp;<br /><strong>Beigefügte Dokumente</strong></td></tr>'
     			. '<tr><td align="right">Lichtbild:</td><td>' . $attachments['name']['upl_Lichtbild'] . '</td></tr>'
     			. '<tr><td align="right">Anschreiben:</td><td>' . $attachments['name']['upl_Anschreiben'] . '</td></tr>'
     			. '<tr><td align="right">Lebenslauf:</td><td>' . $attachments['name']['upl_Lebenslauf'] . '</td></tr>'
     			. '<tr><td align="right">Zeugnisse:</td><td>' . $attachments['name']['upl_Zeugnisse'] . '</td></tr>'
					. '</table>';

    $plain = "\n--------------------\n"
					 . "Bewerbung: \n\n"
					 . "Beruf/Ausbildung " . $fo['Bereich'] . "\n\n"
					 . "Vorname: " . $fo['Vorname'] . "\n"
					 . "Name: " . $fo['Name'] . "\n"
					 . "Strasse: " . $fo['Strasse'] . "\n"
					 . "PLZ: " . $fo['PLZ'] . "\n"
					 . "Ort: " . $fo['Ort'] . "\n"
					 . "Telefon: " . $fo['p_Tel'] . "\n"
					 . "Mobil: " . $fo['p_Mobil'] . "\n"
					 . "eMail: " . $fo['p_eMail'] . "\n"
					 . "\n--------------------\n"
					 . "Bewerbungstext:\n" . $fo['Nachricht'] . "\n"
					 . "\n--------------------\n"
					 . "Lichtbild: " . $attachments['name']['upl_Lichtbild'] . "\n"
					 . "Anschreiben: " . $attachments['name']['upl_Anschreiben'] . "\n"
					 . "Lebenslauf: " . $attachments['name']['upl_Lebenslauf'] . "\n"
					 . "Zeugnisse: " . $attachments['name']['upl_Zeugnisse'] . "\n"
					 . "\n--------------------\n";


		if($fo["Anrede"] == 'Herr') { $anrede = "Sehr geehrter Herr " . $fo["Nachname"]; }
		else if($fo["Anrede"] == 'Frau') { $anrede = "Sehr geehrte Frau " . $fo["Nachname"]; }
		else { $anrede = "Sehr geehrter Kunde"; }

		// Je nach Einstellung wird eine HTML- oder eine reine Text-Email erstellt
		if($sendHTMLmail === 1) {
			if(is_file($htmlTemplate)) {
				include($htmlTemplate);
  	    $tpl_html = str_replace('{!++ anrede ++!}', $anrede, $tpl_html);
    	  $tpl_html = str_replace('{!++ text ++!}', $html, $tpl_html);
      	$tpl_plain = str_replace('{!++ anrede ++!}', $anrede, $tpl_plain);
      	$tpl_plain = str_replace('{!++ text ++!}', $plain, $tpl_plain);
    	}
    	else {
				$sendHTMLmail = 0;
    	}
    }
		if($sendHTMLmail === 0) {
  		$tpl_plain = $subject . "\n\nFolgende Daten wurden an uns gesendet:\n\n\n" . $plain;
  	}

		// MAIL_TO_SENDER
//		$mail_to_sender = $valid_sender_address;

    // -- MAIL-OBJEKT WIRD ERSTELLT UND MAIL VERSCHICKT --
  	$mailer = new PHPMailer(TRUE);
		try {  	
  	
  		$mailer->CharSet = "UTF-8";
  		$mailer->Subject = stripslashes($subject);
  		$mailer->setFrom('info@marinetech.de', 'Marinetech Edelstahlhandel GmbH & Co. KG');

	 		// -- ATTACHMENTS WERDEN ANGEHÄNGT --
    	if($attachments['size']['upl_Lichtbild'] > 0) {
    		$mailer->AddAttachment($attachments['tmp_name']['upl_Lichtbild'], $attachments['name']['upl_Lichtbild']);
	    }
  	  if($attachments['size']['upl_Anschreiben'] > 0) {
    		$mailer->AddAttachment($attachments['tmp_name']['upl_Anschreiben'], $attachments['name']['upl_Anschreiben']);
	    }
  	  if($attachments['size']['upl_Lebenslauf'] > 0) {
    		$mailer->AddAttachment($attachments['tmp_name']['upl_Lebenslauf'], $attachments['name']['upl_Lebenslauf']);
	    }
  	  if($attachments['size']['upl_Zeugnisse'] > 0) {
    		$mailer->AddAttachment($attachments['tmp_name']['upl_Zeugnisse'], $attachments['name']['upl_Zeugnisse']);
    	}
  	
			// Je nach Einstellung wird eine HTML- oder eine reine Text-Email verschickt
			if(isset($sendHTMLmail)) {
    	  $mailer->IsHTML(true);
      	$mailer->Body = $tpl_html;
	      $mailer->AltBody = $tpl_plain;
  	  }
    	else {
      	$mailer->Body = $tpl_plain;
    	}
  	
			// Empfänger werden erstellt
			if($testmode === 1) {
				$mailer->AddAddress($testmail_an); 
			}
			else {
				foreach($arr_to as $value) { $mailer->AddAddress($value['email']); }
	  		if($email_to_user === 1 && $valid_sender_address) { $mailer->AddAddress($valid_sender_address); }
  		}

	  	// Email wird versendet
	 		if($demomode===1) {
	 			echo '<pre>';
				echo var_dump($mailer);
	 			echo '<pre>';
				//exit;
	 			$mailer_error = true;
	 		}
			elseif( $mailer->Send() ) { 
				$path = $_SERVER['HTTP_REFERER'] . '?mailer_success=true';
			} else {
				$path = $_SERVER['HTTP_REFERER'] . '?mailer_error=true';
			}

	  	// Alle Empfänger-Adressen werden aus dem Objekt gelöscht
	   	//$mailer->ClearAddresses();

  	
		} catch (Exception $e) {
    	//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$path = $_SERVER['HTTP_REFERER'] . '?mailer_error=true';
		}
		

	}
	else {

		$path = $_SERVER['HTTP_REFERER'] . '?mailer_error=true';

	}

	if($spambot) {
	
	
	}

#info($fo,1);
#if($status === TRUE) { info('Status ist OK'); } else { info('Status ist FALSCH'); }

?>

	<!DOCTYPE html>
	<html lang="de">
		<head>
			<meta http-equiv="refresh" content="0; URL=<?php echo $path; ?>" />
		</head>
		<body>
			<!-- Das Formular ist kurzzeitig deaktiviert! -->
		</body>
	</html>

