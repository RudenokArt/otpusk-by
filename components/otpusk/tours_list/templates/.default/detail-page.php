<div class="container pt-50">
	<div class="row">
		<div class="col-lg-4 col-md-6">
			<img 
			src="<?php echo CFile::GetFileArray($arResult->detail_item['DETAIL_PICTURE'])['SRC'] ?>"
			alt="<?php echo $arResult->detail_item['NAME'];?>">
		</div>
		<div class="col-lg-8 col-md-6">
			<h1><?php echo $arResult->detail_item['NAME'];?></h1>
      <div class="pt-5">
        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
        <?php foreach ($arResult->detail_item['PROPERTY_DEPARTURE_VALUE'] as $key => $value): ?>
          | <?php echo $value;?>
        <?php endforeach ?>
      </div>
      <div class="pt-5">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <?php if ($arResult->detail_item['PROPERTY_POINT_DEPARTURE_VALUE']): ?>
          <?php echo ToursList::getTownByID($arResult->detail_item['PROPERTY_POINT_DEPARTURE_VALUE'][0])['NAME'];?>
        <?php endif ?>
        ~
        <?php if ($arResult->detail_item['PROPERTY_TOWN_VALUE']): ?>
          <?php echo ToursList::getTownByID($arResult->detail_item['PROPERTY_TOWN_VALUE'][0])['NAME'];?>
        <?php endif ?>
        || ночей: <?php echo $arResult->detail_item['PROPERTY_DAYS_VALUE'];?>
        дней: <?php echo $arResult->detail_item['PROPERTY_DAYS_VALUE'] + 1; ?>
        <?php $order_tour = $arResult->detail_item;?>
      </div>
      <?php include_once 'order-button.php'; ?>
      <div class="pt-5">
        <?php echo $arResult->detail_item['PREVIEW_TEXT'];?>
      </div>
    </div>
  </div>
  <div class="row pt-50">
    <div class="col-12">
      <?php if ($arResult->detail_item['DETAIL_TEXT']): ?>
        <?php echo $arResult->detail_item['DETAIL_TEXT'];?>
      <?php else: ?>
        <?php echo $arResult->detail_item['PROPERTY_HD_DESC_VALUE']['TEXT'];?>
      <?php endif ?>
    </div>
  </div>
  <div class="row pt-50 pb-50">
    <div class="col-10 col-offset-1" id="tour_detail_page_slider">
      <?php foreach ($arResult->detail_item['PROPERTY_PICTURES_VALUE'] as $key => $value): ?>
        <?php $img = CFile::GetFileArray($value)['SRC']; ?>
        <div class="tour_detail_page_slider-item border">
            <img src="<?php echo CFile::GetFileArray($value)['SRC'];?>" alt="">
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <p class="h5">В стоимость входит:</p>
        <?php echo $arResult->detail_item['PROPERTY_PRICE_INCLUDE_VALUE']['TEXT'];?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <p class="h5">В стоимость не входит:</p>
        <?php echo $arResult->detail_item['PROPERTY_PRICE_NO_INCLUDE_VALUE']['TEXT'];?>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p class="h4">Программа тура</p>
        <div class="accordion" id="accordionExample">
          <?php foreach ($arResult->detail_item['PROPERTY_NDAYS_VALUE'] as $key => $value): ?>
            <div class="card">
              <div class="card-header" id="heading<?php echo $key;?>">
                <p class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" 
                  data-toggle="collapse" data-target="#collapse<?php echo $key;?>" 
                  aria-expanded="true" aria-controls="collapse<?php echo $key;?>">
                  <i class="fa fa-chevron-down" aria-hidden="true"></i>
                  <?php echo $arResult->detail_item['PROPERTY_NDAYS_DESCRIPTION'][$key] ?>
                </button>
              </p>
            </div>
            <div id="collapse<?php echo $key;?>" class="collapse" 
              aria-labelledby="heading<?php echo $key;?>" data-parent="#accordionExample">
              <div class="card-body">
                <?php echo $value['TEXT'];?>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>

