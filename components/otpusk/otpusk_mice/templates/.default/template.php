<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
</div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-12">
    <aside class="sidebar">
      <div class="sidebar-inner no-border for-static-page">
        <div class="sidebar-module">
          <ul class="static-page-menu">
            <?php foreach ($arResult->tabs as $key => $value): ?>
              <li <?php if ($value['CODE'] == $arResult->currentTab): ?>
              class="active"
              <?php $arResult->tabContent = $value; ?>
              <?php endif ?> >
              <a href="?tab=<?php echo $value['CODE'] ?>">
                <?php echo $value['NAME'] ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>

      </div>
    </div>
  </aside>
</div>


<div class="col-lg-8 col-md-6 col-sm-12 col-12">
  <h1 class="mice_main_title">MICE ЦЕНТРКУРОРТ</h1>
</div>
<div class="col-lg-8 col-md-6 col-sm-12">
  <img
  src="<?php echo CFile::GetFileArray($arResult->tabContent['DETAIL_PICTURE'])['SRC'];?>" 
  class="mice_tab-image">
</div>
</div>
<div class="row">
  <?php if ($arResult->tabContent['PREVIEW_PICTURE']): ?>
    <div class="col-lg-4 hidden-md hidden-sm hidden-xs">
      <img
      src="<?php echo CFile::GetFileArray($arResult->tabContent['PREVIEW_PICTURE'])['SRC'];?>" 
      class="mice_tab-image">
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12">
      <p><?php echo $arResult->tabContent['DETAIL_TEXT']; ?></p>
    </div>
  <?php else: ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <p><?php echo $arResult->tabContent['DETAIL_TEXT']; ?></p>
    </div>

  <?php endif ?>
</div>

<?php if($_GET['tab'] == 'mice' or !$_GET['tab']): ?>
  <?php include_once 'includes/mice_pre_calc.php' ?>
<?php endif ?>
<?php if ($_GET['tab'] == 'platforms'): ?>
  <?php include_once 'includes/mice_platforms.php' ?>
<?php endif ?>
<?php if ($_GET['tab'] == 'portfolio'): ?>
  <?php include_once 'includes/mice_events.php' ?>
<?php endif ?>






