<?php


/* ----------------------------------------------------
   FÜHRT DIE FUNKTION INFO() IN EINER TABELLENZEILE AUS
   ---------------------------------------------------- */

  function info2($variable, $rv=false) {
    echo '<tr><td>';
    info($variable, $rv);
    echo '</td></tr>';
  } // END FUNCTION


/* -----------------------------------------------------------------
   GIBT INFORMATIONEN ZU EINER VARIABEL AUS (ÄHNLICH WIR print_r();)
   ----------------------------------------------------------------- */

  function info($variable, $rv=false) {

    $start = "<p>\\* START INFO - VARIABLE *\\<p>";
    $end = "<p>\\* END INFO - VARIABLE *\\<p>";

    echo $start . "Typ: <i>" . gettype($variable) . "</i>";
    if($rv) { echo "<br>rekursiv = on"; }
    if(is_bool($variable)) {
      if($variable == 1) { echo "<br>Wert: <i>true</i>"; }
      else { echo "<br>Wert: <i>false</i>"; }
      echo $end; return true;
    }
    if(!empty($variable)) {
      if(is_object($variable)) { zeigeKlasse($variable); }
      elseif(is_array($variable)) {
        if($rv) { zeigeArray($variable, $rv); }
        else { zeigeArray($variable); }
      }
      else { echo "<br>Wert: <i>" . htmlentities($variable) . "</i>"; }
    } else { echo "<br>Wert: <i>empty</i>"; }
    echo $end; return true;

  } // END FUNCTION


/* ------------------------------------------------------------- */
/* GIBT DEN KOMPLETTEN INHALTS EINES ARRAYS IN EINER TABELLE AUS */
/* ------------------------------------------------------------- */

  function zeigeArray($data, $rv=false) {

    if(isset($data[0]) && is_array($data[0])) {

      $keys = $data[0];
      $keys = array_keys($keys);

      echo '<p><table border="1" cellpadding="3" cellspacing="1">';
      echo '<tr><td class="text">&nbsp;</td>';
      echo '<td class="text">' . implode("</td><td class=\"text\">",$keys) . '</td></tr>';
      for($i=0; $i<count($data); $i++) {
        echo '<tr><td valign="top" class="text">' . $i . '</td>';
        foreach($data[$i] as $value) {
          echo '<td valign="top" class="text">' . htmlentities($value) . '</td>';
        }
        echo '</tr>';
      }
      echo '</table><p>';
    }
    else if(is_array($data)) {
      echo '<p><table border="1" cellpadding="3" cellspacing="0">';
      echo '<tr><td><b>key</b></td><td><b>value</b></td></tr>';
      foreach($data as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>';
        if(is_string($value)) { echo htmlentities($value); }
        elseif(is_array($value) && $rv) { zeigeArray($value); }
        else { echo $value; }
        echo '</td></tr>';
      }
      echo '</table><p>';
    }
    else { echo print_r($var); }

  } // END FUNCTION


/* ----------------------------------------------------------------------- */
/* GIBT INFORMATIONEN (ATTRIBUTE/METHODEN) ZU DER KLASSE EINES OBJEKTS AUS */
/* ----------------------------------------------------------------------- */

  function zeigeKlasse($objekt) {

    $klasse = get_class($objekt);
    if(class_exists($klasse)) {
      echo "<br>Klasse: <i>$klasse</i>";

      $arr = get_class_vars($klasse);
      echo "<p><u>Klassen-Attribute:</u><br>";
      foreach($arr as $key => $value) {
        echo "&nbsp;&nbsp;&nbsp;<font color=\"red\">$key</font> => <font color=\"green\">$value</font><br>";
      }

      $arr = get_class_methods($klasse);
      echo "<p><u>Klassen-Methoden:</u><br>";
      foreach($arr as $key => $value) {
        echo "&nbsp;&nbsp;&nbsp;<font color=\"red\">$key</font> => <font color=\"green\">$value</font><br>";
      }

      $arr = get_object_vars($objekt);
      echo "<p><u>Objekt-Attribute:</u><br>";
      foreach($arr as $key => $value) {
        if(is_string($value)) { $value = htmlentities($value); }
        echo "&nbsp;&nbsp;&nbsp;<font color=\"red\">$key</font> => <font color=\"green\">$value</font><br>";
      }
    }
    else { echo "no class found"; }

  } // END FUNCTION


/* --------------------------------------------------------------------
   GIBT DEN INHALT EINER VARIABLE IN EINEM JAVASCRIPT ALERT FENSTER AUS
   -------------------------------------------------------------------- */

  function alert($variable="") {
    echo '<script>alert("' . $variable . '");</script>';
  } // END FUNCTION


?>