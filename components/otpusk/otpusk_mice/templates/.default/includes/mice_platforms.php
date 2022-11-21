<?php 
$arResult->eco_mice_list = $arResult->ecoMiceList();
$arResult->platform_list = $arResult->platformList();
$arResult->city_mice_arr = [];
$arResult->medical_mice_arr =[];
foreach ($arResult->platform_list as $key => $value) {
  if ($value['PROPERTY_MICE_VALUE'] == 'MICE_CITY') {
    array_push($arResult->city_mice_arr, $value);
  } elseif ($value['PROPERTY_MICE_VALUE'] == 'MICE_MEDICAL') {
    array_push($arResult->medical_mice_arr, $value);
  }
}

?>
<div class="row">
  <div class="col h5 text-center">
    Предлагаем рассмотреть возможные локации лучших объектов страны:
  </div>
</div>
<div class="row">
  <div class="col h5 text-center">
    ОТЕЛИ (sity-mice)
  </div>
</div>
<div class="row mice_locations-list">
  <?php foreach ($arResult->city_mice_arr as $key => $value): ?>
    <a href="/oteli/<?php echo $value['CODE'];?>/" 
      class="col-lg-4 col-md-4 col-sm-6 col-12 mice_locations-item border">
      <div class="mice_locations-item_image" style="background-image: url(<?php echo CFile::GetFileArray($value['PREVIEW_PICTURE'])['SRC'];?>);"></div>
      <div class="h5 text-center mice_locations-item_text">
        <?php echo $value['NAME']; ?>
      </div>
    </a>
  <?php endforeach ?>
</div>

<div class="row">
  <div class="col h5 text-center">
    НАЦИОНАЛЬНЫЕ ПАРКИ БЕЛАРУСИ (eco-mice)
  </div>
</div>
<div class="row mice_locations-list">
  <?php foreach ($arResult->eco_mice_list as $key => $value): ?>
    <a href="/sanatorii/<?php echo $value['CODE'];?>/"
      class="col-lg-4 col-md-4 col-sm-6 col-12 mice_locations-item border">
      <div class="mice_locations-item_image" style="background-image: url(<?php echo CFile::GetFileArray($value['PREVIEW_PICTURE'])['SRC'];?>);"></div>
      <div class="h5 text-center mice_locations-item_text">
        <?php echo $value['NAME']; ?>
      </div>
    </a>
  <?php endforeach ?>
</div>

<div class="row">
  <div class="col h5 text-center">
    САНАТОРНО-КУРОРТНЫЕ УЧРЕЖДЕНИЯ (medical-mice)
  </div>
</div>
<div class="row mice_locations-list">
  <?php foreach ($arResult->medical_mice_arr as $key => $value): ?>
    <a href="/sanatorii/<?php echo $value['CODE'];?>/"
      class="col-lg-4 col-md-4 col-sm-6 col-12 mice_locations-item border">
      <div class="mice_locations-item_image" style="background-image: url(<?php echo CFile::GetFileArray($value['PREVIEW_PICTURE'])['SRC'];?>);"></div>
      <div class="h5 text-center mice_locations-item_text">
        <?php echo $value['NAME']; ?>
      </div>
    </a>
  <?php endforeach ?>
</div>