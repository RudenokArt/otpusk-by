<?php
header('Content-type: text/html; charset=utf-8');
if ($_POST['belavia_search_form_calc']) {
  $str = time().";".date('d.m.Y').";".$_POST['from'].";".$_POST['to'].";".$_POST['date_from'].";".$_POST['date_to'].";\r\n";
  $path = $_SERVER['DOCUMENT_ROOT'].'/upload/belavia_search_form_clicker_calc.csv';
  file_put_contents($path,  iconv( "UTF-8", "cp1251",  $str ), FILE_APPEND);
  print_r($_POST);
  print_r(getdate());
} 
?>