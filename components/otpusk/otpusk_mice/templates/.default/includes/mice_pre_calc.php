<?php 
$mice_pre_calc_options = [
  'Аренда зала, оборудования',
  'Кофе-брейки, ланчи во время мероприятия',
  'Размещение в отеле',
  'Авиабилеты, железнодорожные билеты',
  'Трансферы',
  'Страхование',
  'Экскурсионное обслуживание',
  'Развлекательная программа',
  'Team-building, активный отдых',
  'Дизайн, полиграфия',
  'Прочее, укажу в пожеланиях',
];
?>


<form action="" method="post">
  <div class="row pb-10">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <span class="mice-event-title">* Название и тип мероприятия:</span>          
    <input <?php if ($_POST['event_type']): ?>
    value="<?php echo $_POST['event_type'] ?>"
    <?php endif ?> type="text" name="event_type" class="form-control" required>
  </div>
</div>
<div class="row pb-10">
  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <span class="mice-event-title">Дата мероприятия:</span>          
    <input <?php if ($_POST['event_date']): ?>
    value="<?php echo $_POST['event_date'] ?>"
    <?php endif ?> type="text" name="event_date" id="event_date" class="form-control">
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <span class="mice-event-title">Количество человек:</span>          
    <input <?php if ($_POST['event_people']): ?>
    value="<?php echo $_POST['event_people'] ?>"
    <?php endif ?> type="number" name="event_people" class="form-control">
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <span class="mice-event-title">Планируемый бюджет:</span>          
    <input <?php if ($_POST['event_budget']): ?>
    value="<?php echo $_POST['event_budget'] ?>"
    <?php endif ?> type="text" name="event_budget" class="form-control">
  </div>
</div>

<div class="row pb-10">
  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <span class="mice-event-title">Место проведения:</span>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-12">
    <label>
      <input <?php if ($_POST['event_location'] == "В Беларуси"): ?>
      checked
      <?php endif ?> type="radio" class="radio-visible" name="event_location" value="В Беларуси">
      В Беларуси 
    </label><br>
    <label>
      <input <?php if ($_POST['event_location'] == "За рубежом"): ?>
      checked
      <?php endif ?> type="radio" id="event_abroad" class="radio-visible" name="event_location" value="За рубежом">
      За рубежом 
    </label>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <span class="mice-event-title">
      Укажите город<span id="event_abroad_title"> и страну</span>:
    </span>
    <input <?php if ($_POST['event_location_text']): ?>
    value="<?php echo $_POST['event_location_text'] ?>"
    <?php endif ?> type="text" name="event_location_text" class="form-control">
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 mice-event-title">
    Необходимые услуги:
  </div>
</div>

<div class="row">
  <?php foreach ($mice_pre_calc_options as $key => $value): ?>
   <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <label>
      <input name="event_options[]" value="<?php echo $value ?>" 
      <?php if (in_array($value, $_POST['event_options'])): ?>
        checked
        <?php endif ?> class="checkbox-visible" type="checkbox">
        <?php echo $value; ?>
      </label>
    </div>
  <?php endforeach ?>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 mice-event-title">
    Пожелания:
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <textarea name="event_wishes" class="form-control"><?php if ($_POST['event_wishes']): ?><?php echo $_POST['event_wishes'] ?><?php endif ?></textarea>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 mice-event-title">
    * ФИО:
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <input <?php if ($_POST['event_fio']): ?>
    value="<?php echo $_POST['event_fio'] ?>"
    <?php endif ?> type="text" name="event_fio" class="form-control" required>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <span class="mice-event-title">*тел:</span>
    <input <?php if ($_POST['event_phone']): ?>
    value="<?php echo $_POST['event_phone'] ?>"
    <?php endif ?> type="text" name="event_phone" class="form-control" required>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <span class="mice-event-title">* Email:</span>
    <input <?php if ($_POST['event_email']): ?>
    value="<?php echo $_POST['event_email'] ?>"
    <?php endif ?> type="email" name="event_email" class="form-control" required>
  </div>
</div>

<?include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass) <= 0) {
  $captchaPass = randString(10);
  COption::SetOptionString("main", "captcha_password", $captchaPass);
}
$cpt->SetCodeCrypt($captchaPass);
?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12 mice-event-title">
    * Введите код с картинки
    <input value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" 
    class="captchaSid" name="captcha_code" type="hidden">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <input type="hidden" name="captcha_pass" value="<?php echo $cpt->code;?>">
    <input class="inptext form-control" name="captcha_word" type="text" required>
    <button name="mice_event_order" value="Y" class="btn btn-primary mt-10 mb-10">
      <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
      Отправить заявку
    </button>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <img class="captchaImg" 
    src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>">
  </div>
</div>
</form>
     


<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    Нажимая на кнопку «Отправить заявку, 
    вы передаете свои персональные данные по сети Интернет, 
    подтверждаете, что ознакомились с 
    <a href="/include/docs/conf_politics.pdf">политикой конфиденциальности</a>
    и даете согласие на обработку персональных данных. 
  </div>
</div>

