<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php if ($_GET['detail']): ?>
  <?php include_once 'detail.php'; ?>
<?php elseif($_GET['request']): ?>
  <?php include_once 'request.php'; ?>
<?php else: ?>
  <?php include_once 'list.php'; ?>
<?php endif ?>



