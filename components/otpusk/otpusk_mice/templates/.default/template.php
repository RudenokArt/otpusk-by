<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
</div>
</div>

<?php if ($_POST['mice_event_order']): ?>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <?php if ($_POST['captcha_pass'] != $_POST['captcha_word']): ?>        
        <div class="alert alert-danger text-center h6" role="alert">
          Неверный код с картинки!
        </div>        
      <?php else: ?>
        <div class="alert alert-success text-center h6" role="alert">
          Ваша заявка принята. После обработки данных формы, наш специалист свяжется с вами.
        </div>
      <?php endif ?>
    </div>
  </div>
<?php endif ?>
<br>
 <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <ul class="nav nav-tabs">
         <?php foreach ($arResult->tabs as $key => $value): ?>
              <li <?php if ($value['CODE'] == $arResult->currentTab): ?>
              class="nav-item active"
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
<br>
<div class="row">
 
<div class="col-lg-12 col-md-6 col-sm-12 col-12">
  <h1 class="mice_main_title">MICE ЦЕНТРКУРОРТ</h1>
</div>
<div class="col-lg-12 col-md-6 col-sm-12">
  <img
  src="<?php echo CFile::GetFileArray($arResult->tabContent['DETAIL_PICTURE'])['SRC'];?>" 
  class="mice_tab-image">
</div>
</div>
    <br>
<div class="row">
  <?php if ($arResult->tabContent['PREVIEW_PICTURE']): ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <p><?php echo $arResult->tabContent['DETAIL_TEXT']; ?></p>
    </div>
  <?php else: ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <p><?php echo $arResult->tabContent['DETAIL_TEXT']; ?></p>
    </div>
  <?php endif ?>
</div>
<br>

<?php if($_GET['tab'] == 'mice' or !$_GET['tab']): ?>
  <?php include_once 'includes/mice_pre_calc.php' ?>
<?php endif ?>
<?php if ($_GET['tab'] == 'platforms'): ?>
  <?php include_once 'includes/mice_platforms.php' ?>
<?php endif ?>
<?php if ($_GET['tab'] == 'portfolio'): ?>
  <?php include_once 'includes/mice_events.php' ?>
<?php endif ?>
<?php if ($_GET['tab'] == 'location'): ?>
  <?php include_once 'includes/mice_location.php' ?>
<?php endif ?>






