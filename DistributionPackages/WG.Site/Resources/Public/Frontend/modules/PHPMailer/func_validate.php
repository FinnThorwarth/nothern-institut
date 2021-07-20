<?php

	defined("_BH_HB_") or die("Direct access is not allowed !");

/* ---------------------------------------------------------------------------------------------------
   FUNCTIONS:
   ---------------------------------------------------------------------------------------------------
   fb_unmagic() => ENTFERNT QUOTES AUS STRINGS UND ARRAYS WENN MAGIC_QUOTES AKTIVIERT IST
   fx_validateOneline() => KONTROLLIERT EINZEILIGE EINGABEN AUF UMBRÜCHE
   fx_validateMultiline() => KONTROLLIERT MEHRZEILIGE EINGABEN AUF UMBRÜCHE UND SPEZIELLE EMAIL-HEADER
   fx_checkIfValid() => KONTROLLIERT, OB DIE VERWENDETET EMAIL-ADRESSE SYNTAKTISCH KORREKT IST
   --------------------------------------------------------------------------------------------------- */

/**
 * ----------------------------------------------------------------------
 * FUNCTION: fb_unmagic()
 * ----------------------------------------------------------------------
 * ENTFERNT QUOTES AUS STRINGS UND ARRAYS WENN MAGIC_QUOTES AKTIVIERT IST
 * ----------------------------------------------------------------------
 */

	function fb_unmagic($in) {

		if(!get_magic_quotes_gpc()) { return $in;	}

		if(is_array($in)) {
			foreach($in as $key => $value) {
				$in[$key] = fb_unmagic($value); // REKURSION
			}
			return $in;
		}

		return stripslashes($in);

	}  // END FUNCTION


/* -------------------------------------------------
   FUNCTION: fx_validateOneline()
   -------------------------------------------------
   KONTROLLIERT EINZEILIGE EINGABEN AUF UMBRÜCHE
   ------------------------------------------------- */

  function fx_validateOneLine($str, $length=false) {

		if(is_array($str)) { return false; }

	 	$str = trim($str);
    if($length) { $str = substr($str, 0, $length);  }  // EINGABE WIRD AUF $LENGTH ZEICHEN REDUZIERT

		$ctrl_str = $str;
		$str = preg_replace("/(%0A|%0D|\\n+|\\r+)/i", "", $str); // unerlaubte Zeichen entfernen
		if( $str === $ctrl_str ) { return $str; } 

		return false;

  }  // END FUNCTION


/* -------------------------------------------------------------------------------------------------
   FUNCTION: fx_validateMultiline()
   -------------------------------------------------------------------------------------------------
   KONTROLLIERT MEHRZEILIGE EINGABEN AUF UMBR†CHE MIT FOLGENDEN EMAIL-HEADER TYPISCHEN ZEICHENKETTEN
   ------------------------------------------------------------------------------------------------- */

  function fx_validateMultiLine($str, $length=false) {

		if(is_array($str)) { return false; }

		$str = trim($str);
		if($length) { $str = substr($str, 0, $length); } // EINGABE WIRD AUF $LENGTH ZEICHEN REDUZIERT

		$ctrl_str = $str;
		$regex = "/(%0A|%0D|\\n+|\\r+)(content-type:|to:|cc:|bcc:)/i";  // unerlaubte Zeichenketten entfernen
		$str = preg_replace($regex, "", $str);
		if( $str === $ctrl_str ) { return $str; } 

	  return false;

  }  // END FUNCTION


/* ----------------------------------------------------------------------
   FUNCTION: fx_checkIfValid()
   ----------------------------------------------------------------------
   KONTROLLIERT, OB DIE VERWENDETET EMAIL-ADRESSE SYNTAKTISCH KORREKT IST
   ---------------------------------------------------------------------- */


	function fx_checkIfValid($str) {
		return ( filter_var( $str, FILTER_VALIDATE_EMAIL ) !== false )? true : false;
	}

?>