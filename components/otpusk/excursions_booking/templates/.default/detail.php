
<?php $value = $arResult->excursions_list['list'][0]; ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 h3">
    <?php echo $value['NAME']; ?> <br>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div class="excursions_booking-detail_slider">
      <?php foreach ($value['PICTURES'] as $key1 => $value1): ?>
        <div style="background-image: url(https://otpusk.by<?php echo $value1;?>);" class="excursions_booking-detail_slider-image"></div>
      <?php endforeach ?>        
    </div>
  </div>
  <div class="col-lg-4 col-md-12 col-sm-12 col-12">
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
    <div class="р5">
      Заявка на экскурсию: 
    </div>
    <div>
      <a href="?request=<?php echo $value['ID'];?>" class="btn btn-primary">
        Отправить заявку
      </a>
    </div>
    <div>
      <br>
      <!-- Кнопка перехода на страницу результатов поиска для онлайн бронирования. -->
      <!-- <a href="/otdykh-v-belarusi/tury-i-ekskursii/searchresult.php?tpm_params[id][]=<?php // echo $value['PROPERTY_VETLIVA_ID_VALUE'];?>"
        class="btn btn-primary">
        Бронировать онлайн
      </a> -->
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="border">
      <div class="h4 text-center">
        Онлайн бронирование
      </div>
      <hr> 
      <div id="search-result-iframe-block-296"><span>Идет загрузка результатов поиска...</span></div>
      <script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
      <script>
        Travelsoft.init({
          searchResult: {
            insertion_id: "search-result-iframe-block-296",
            type: "excursions",
            numberPerPage: 10,
            citizen_price: "",
            currency: "BYN",
            agent: "5700",
            hash: "80f5c77cb4c77a3e68818c98cbbba1a9",
            lang: "ru"
          }
        });
      </script>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <br>
    <?php echo $value['PROPERTY_HD_DESC_VALUE']['TEXT']; ?>
  </div>
</div>
<hr>

