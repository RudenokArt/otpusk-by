<?php include 'pagination.php';?> <hr>
<?php foreach ($arResult->excursions_list['list'] as $key => $value): ?>
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="excursions_booking-item_slider">
        <?php foreach ($value['PICTURES'] as $key1 => $value1): ?>
          <div style="background-image: url(https://otpusk.by<?php echo $value1;?>);" class="excursions_booking-item_slider-image"></div>
        <?php endforeach ?>        
      </div>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-6 col-12">
      <b><?php echo $value['NAME']; ?></b><br>
      <i class="fa fa-hourglass" aria-hidden="true"></i>
      Продолжительность: <?php echo $value['PROPERTY_DURATION_TIME_VALUE'];?> ч. 
      <br>
      <i class="fa fa-clock-o" aria-hidden="true"></i>
      Отправление: <?php echo $value['PROPERTY_DEPARTURE_EXC_TEXT_VALUE']; ?>
      <br>
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      <?php echo $value['COUNTRY']['NAME'] ?>
      (<?php foreach ($value['TOWN'] as $key1 => $value1): ?>
        <?php echo $value1['NAME'] ?>,
      <?php endforeach ?>) <br><br>
      <a href="?detail=<?php echo $value['ID'];?>&tpm_params[id][]=<?php echo $value['PROPERTY_VETLIVA_ID_VALUE'];?>" class="btn btn-primary">
        Подробнее
      </a>
    </div>
  </div>
  <hr>
<?php endforeach ?>

<?php include 'pagination.php';?>