<?php
  if ( ! defined('BASEPATH')) exit('No direct script accessallowed');
  if ( ! function_exists('formateur_helper')) {
    function formateur_helper($text) {
      $rep=strrev(wordwrap(strrev($n), 3, ' ', true));
      return $rep;
    }
  }
?>
