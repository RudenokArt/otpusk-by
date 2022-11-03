<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

  </div>
</div>
<div class="container">
  <div class="row pt-10">
    <div class="col-lg-10">
      <div class="h3">
        Заявка на подбор и покупку авиабилетов и железнодорожных билетов.
      </div>
      <div>
       РУП «Центркурорт» предлагает сервисный и индивидуальный подход к подбору <?php echo $arResult['prew_type']; ?>. Приобретая билеты в нашей компании, Вы получаете:
     </div>      
   </div>
   <div class="col-lg-2 mt-20 border">
     пн-пт: 9:00-18:00 <br>
     сб, вс: выходной <br>
     тел.: +375 (29) 191-39-66 <br>
   </div>
 </div>
 <div class="row">
  <div class="col-12">
    <?php if ($arResult['send_request']): ?>
      <div class="alert alert-success h6 text-center" role="alert">
        Ваша заявка принята! Мы свяжемся с вами.
      </div>
    <?php endif ?>
  </div>
</div>
<div class="row pt-10">
  <?php foreach ($arResult['advantages'] as $key => $value): ?>
    <div class="col-sm-4" style="text-align: center;">
      <img src="<?php echo CFile::GetFileArray($value['DETAIL_PICTURE'])['SRC'];?>" 
      alt="<?php echo $value['NAME'] ?>" class="air_tickets-advantages_icon">
      <span class="h6"><?php echo $value['DETAIL_TEXT']; ?></span>
    </div>
  <?php endforeach ?>
</div>
<div class="row">
  <div class="col">
    <?php echo file_get_contents('img/consultant.svg') ?>
  </div>
</div>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php if ($arResult['current_tab'] == 'air_tickets'): ?>
    active
    <?php endif ?>" aria-current="page" href="?tab=air_tickets">
    <i class="fa fa-plane" aria-hidden="true"></i>
    Авиабилеты
  </a>
</li>
<li class="nav-item">
  <a class="nav-link <?php if ($arResult['current_tab'] == 'train_tickets'): ?>
  active
  <?php endif ?>" href="?tab=train_tickets">
  <i class="fa fa-subway" aria-hidden="true"></i>
  ЖД билеты
</a>
</li>
</ul>
<form action="" method="post">
  <div class="row pt-10">
    <div class="col-sm-12 col-md-6">
      Откуда:
      <input type="text" class="form-control" name="from" required>
    </div>
    <div class="col-sm-12 col-md-6">
      Куда:
      <input type="text" class="form-control" name="to" required>
    </div>
    <div class="col-sm-6 col-md-3">
      Дата туда:
      <input type="text" class="form-control" name="date_from" id="ticket_date_from" required>
    </div>
    <div class="col-sm-6 col-md-3">
      Дата обратно:
      <input type="text" class="form-control" name="date_to" id="ticket_date_to">
    </div>
    <div class="col-sm-6 col-md-3">
      Количество пассажиров:
      <input type="text" class="form-control" name="passanger_qty" required>
    </div>
    <div class="col-sm-6 col-md-3">
      Тел:
      <input type="text" class="form-control" name="phone" required>
    </div>
    <div class="col-sm-12 col-md-6">
      ФИО:
      <input type="text" class="form-control" name="fio" required>
    </div>
    <div class="col-sm-6 col-md-3">
      Email:
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="col-sm-6 col-md-3"><br>
      <button name="ticket_send_request" value="Y" class="btn btn-primary w-100 air_tickets_send_button">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
        Отправить заявку
      </button>
    </div>
  </div>
  <div class="row">
    <div class="col">
      *Заявка будет обработана нашим менеджером в течение 24 часов.
    </div>
  </div>
  <div> 
  </div>
</form>

<div class="payment-services">
  <?php foreach ($arResult['payments'] as $key => $value): ?>
    <?php if ($value['PREVIEW_TEXT']): ?>
      <a href="<?php echo $value['PREVIEW_TEXT']; ?>">
        <div class="payment-services-item-wrapper">        
          <div style="background-image: url(<?php echo CFile::GetFileArray($value['DETAIL_PICTURE'])['SRC'];?>);"
            class="payment-services-item"></div>
          </div>
        </a>
      <?php else: ?>
        <div class="payment-services-item-wrapper">        
          <div style="background-image: url(<?php echo CFile::GetFileArray($value['DETAIL_PICTURE'])['SRC'];?>);"
            class="payment-services-item"></div>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  </div>



  <script>
    $( function() {
      $( "#ticket_date_from, #ticket_date_to" ).datepicker({
        'dateFormat': 'dd.mm.yy',
      });
    } );
  </script>
